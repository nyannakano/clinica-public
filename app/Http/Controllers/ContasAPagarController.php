<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ContaBancaria;
use App\Models\MeioPagamento;
use App\Models\Movimentacao;
use App\Models\OrdemDeServico;
use App\Models\Pagamento;
use App\Models\Parcela;
use App\Models\Profissional;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContasAPagarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $pagamentos = Pagamento::all()->where('pag_type', '=', 1)->paginate(10);
        $ordens = OrdemDeServico::all();
        $clientes = Cliente::all();
        $profissionais = Profissional::all();

        $mensagem = $request->session()->get('mensagem');

        return view('pagar.index',
            compact('pagamentos', 'ordens', 'mensagem',
                'clientes', 'profissionais'));
    }

    public function viewContaAPagar($idpagamento)
    {
        $pagamento = Pagamento::find($idpagamento);
        $ordem = OrdemDeServico::find($pagamento->ord_id);
        $cliente = Cliente::find($pagamento->clie_id);
        $profissional = Profissional::find($pagamento->pro_id);
        $parcelas = Parcela::all()->where('pag_id', '=', $pagamento->id);
        $parcelascount = $parcelas->count();
        $contas = ContaBancaria::all();
        $datadehoje = Carbon::now()->toDateString();
        $movimentacoes = Movimentacao::all();

        return view('pagar.viewcontaapagar', compact('pagamento',
            'ordem', 'cliente', 'profissional', 'parcelas', 'parcelascount', 'contas', 'datadehoje', 'movimentacoes'));
    }

    public function generate($idpagamento)
    {
        $pagamento = Pagamento::find($idpagamento);
        $parcelas = Parcela::all()->where('pag_id', '=', $idpagamento);

        $quantidade = $pagamento->pag_indicator - $parcelas->count();

        if ($parcelas->count() > 0) {
            $valorparcela = $pagamento->pag_price / $pagamento->pag_indicator;
            foreach ($parcelas as $parcela) {
                $parcela->par_price = $valorparcela;
                $parcela->save();
            }
        } else {
            $valorparcela = $pagamento->pag_price / $pagamento->pag_indicator;
        }
        $i = $parcelas->count() + 1;

        for ($i; $i <= $quantidade + $parcelas->count(); $i++) {
            Parcela::create([
                'par_price' => $valorparcela,
                'par_number' => $i,
                'pag_id' => $idpagamento,
                'par_deadline' => Carbon::now()->toDate(),
                'par_type' => 1, // esse 0 é wereferente a conta a receber, em breve fará mais sentido pois terá contas a pagar também
                'par_status' => 0
            ]);
        }

        return redirect()->route('pagamentos.viewcontaapagar', ['id' => $idpagamento]);
    }

    public function update(Request $request)
    {
        $parcela = Parcela::find($request->id);
        $parcela->par_price = $request->par_price;
        $parcela->par_number = $request->par_number;
        $parcela->par_deadline = $request->par_deadline;
        $parcela->save();

        $pagamento = Pagamento::find($parcela->pag_id);
        $pagamento->con_id = $request->con_id;
        $pagamento->save();

        $request->session()->flash('mensagem', "Parcela $parcela->par_number editada com sucesso!");

        return redirect()->route('pagamentos.viewcontaapagar', ['id' => $parcela->pag_id]);
    }

    public function pay(Request $request)
    {
        $parcela = Parcela::find($request->id);
        $valorparcela = $request->par_price;
        $valoradicional = $request->par_additional;
        $valordesconto = $request->par_discount;

        $pagamento = Pagamento::find($parcela->pag_id);

        $cliente = Cliente::find($pagamento->clie_id);
        $profissional = Profissional::find($pagamento->pro_id);


        $conta = ContaBancaria::find($request->con_id);
        $contavaloratual = $conta->con_balance;


        $valortotal = ($valorparcela + $valoradicional) - $valordesconto;

        if($valorparcela < $parcela->par_price && $valorparcela > 0) {
            $this->halfpay($parcela->par_price, $valorparcela, $pagamento->id, $parcela->par_number);
        }

        if (!$cliente == null) {
            $description = "Parcela número: " . $parcela->par_number . "; Cliente: " . $cliente->clie_name;
            $clienteid = $cliente->id;
        } else {
            $description = "Parcela número: " . $parcela->par_number . "; Conta a Pagar Número: " . $pagamento->id;
            $clienteid = null;
        }

        if (!$profissional == null) {
            $profissionalid = $profissional->id;
        } else {
            $profissionalid = null;
        }

        $movimentacao = Movimentacao::create([
            'mov_description' => $description,
            'mov_type' => 1,
            'mov_value' => $valortotal,
            'mov_date' => $request->par_date,
            'clie_id' => $clienteid,
            'pro_id' => $profissionalid,
            'par_id' => $parcela->id,
            'con_id' => $conta->id,
            'mov_cancel' => 0
        ]);

        $parcela->par_status = 1;
        $parcela->save();

        $parcelas = Parcela::all()->where('pag_id', '=', $pagamento->id);
        $totaldeparcelas = $parcelas->count();
        if ($totaldeparcelas == $pagamento->pag_indicator) {
            $naorecebido = 0;
            foreach ($parcelas as $parcela) {
                if ($parcela->par_status == 0) {
                    $naorecebido += 1;
                }
            }
            if ($naorecebido == 0) {
                $pagamento->pag_open = 1;
                $pagamento->save();
            }
        }

        $request->session()->flash('mensagem', "Parcela $parcela->par_number lançada com sucesso!");

        return redirect()->route('pagamentos.viewcontaapagar', ['id' => $parcela->pag_id]);
    }

    public function destroy(Request $request)
    {
        $parcela = Parcela::find($request->id);
        $movimentacao = Movimentacao::all()->where('par_id', '=', $parcela->id)->count();

        if ($parcela->par_status == 0) {
            Parcela::destroy($parcela->id);
        } else if ($parcela->par_status == 1) {
            if ($movimentacao >= 1) {
                $mov = Movimentacao::select('id')->where('par_id', '=', $parcela->id)->first();
                Movimentacao::destroy($mov->id);
            }
            Parcela::destroy($parcela->id);
        }
        return redirect()->back();
    }

    public function cancel(Request $request)
    {
        $pagamento = Pagamento::find($request->id);
        $ordem = OrdemDeServico::find($pagamento->ord_id);
        $parcelas = Parcela::all()->where('pag_id', '=', $pagamento->id);

        if ($parcelas->count() == 0) {
            $pagamento->pag_open = 2;
            $pagamento->save();
            if (!$ordem == null) {
                $ordem->ord_status = 2;
                $ordem->save();
            }
        } else {
            foreach ($parcelas as $parcela) {
                if ($parcela->par_status == 1) {
                    $movimentacao = Movimentacao::all()->where('par_id', '=', $parcela->id)->first();
                    $movimentacao->mov_cancel = 1;
                    $movimentacao->save();
                }
                $parcela->par_status = 2;
                $parcela->save();
                $pagamento->pag_open = 2;
                $pagamento->save();
            }
            $ordem->ord_status = 2;
            $ordem->save();
        }

        return redirect()->route('pagar.index');
    }

    public function create()
    {
        $contas = ContaBancaria::all();
        $meios = MeioPagamento::all();
        $clientes = Cliente::all();
        $profissionais = Profissional::all();

        return view('pagar.create', compact('contas', 'meios', 'clientes', 'profissionais'));
    }

    public function store(Request $request)
    {
        $conta = ContaBancaria::find($request->con_id);
        $meio = MeioPagamento::find($request->mei_id);

        $pagamento = Pagamento::create([
            'pag_price' => $request->pag_price,
            'pag_indicator' => $request->pag_indicator,
            'pag_type' => 1,
            'mei_id' => $request->mei_id,
            'con_id' => $request->con_id,
            'clie_id' => $request->clie_id,
            'pro_id' => $request->pro_id,
            'pag_open' => 0
        ]);

        return redirect()->route('pagar.index');
    }

    public function filterpay($type)
    {
        $pagamentos = Pagamento::all()->where('pag_type', '=', 1)
            ->where('pag_open', '=', $type)->paginate(10);
        $ordens = OrdemDeServico::all();
        $clientes = Cliente::all();
        $profissionais = Profissional::all();


        return view('pagar.filterpay',
            compact('pagamentos', 'ordens',
                'clientes', 'profissionais'));
    }

    public function halfpay($valortotal, $valorpago, $pagamentoid, $number)
    {
        $pagamento = Pagamento::find($pagamentoid);

        $valorfinal = $valortotal - $valorpago;

        Parcela::create([
            'par_price' => $valorfinal,
            'par_number' => $number,
            'pag_id' => $pagamento->id,
            'par_deadline' => Carbon::now()->toDate(),
            'par_type' => 1, // esse 1 é referente a conta a pagar
            'par_status' => 0
        ]);
    }
}
