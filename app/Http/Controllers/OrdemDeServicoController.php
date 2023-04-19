<?php

namespace App\Http\Controllers;


use App\Http\Requests\ordensServicosFormRequest;
use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\ContaBancaria;
use App\Models\MeioPagamento;
use App\Models\OrdemDeServico;
use App\Models\Pagamento;
use App\Models\Profissional;
use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdemDeServicoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $ordens = OrdemDeServico::all()->paginate(10);
        $clientes = Cliente::all();
        $pagamentos = Pagamento::all();
        $profissionais = Profissional::all();
        $mensagem = $request->session()->get('mensagem');
        return view('ordens.index', compact( 'ordens','mensagem', 'clientes', 'pagamentos', 'profissionais'));
    }

    public function create()
    {
        $clientes = Cliente::all()->where('clie_del', '=', 0);
        $profissionais['data'] = Profissional::where('pro_del', '=', 0)->select('id', 'pro_name')->get();

        return view('ordens.create',
            compact('clientes'))
            ->with('profissionais', $profissionais);
    }


    public function viewOrder(Request $request)
    {
        $ordem = OrdemDeServico::find($request->id);
        $pagamentos = Pagamento::all()->where('ord_id', '=', $ordem->id);
        $contas = ContaBancaria::all();
        $clientes = Cliente::all();
        $meios = MeioPagamento::all();
        $profissionais = Profissional::all();
        $servicos = Servico::all();

        return view('ordens.vieworder',
            compact('pagamentos', 'ordem', 'contas', 'clientes', 'meios', 'profissionais', 'servicos'));
    }

    public function store(ordensServicosFormRequest $request)
    {

        $ordem = OrdemDeServico::create([
            'pro_id' => $request->input('pro_id'),
            'ser_id' => $request->input('ser_id'),
            'cli_id' => $request->input('cli_id'),
            'ord_description' => $request->ord_description,
            'ord_additional' => $request->ord_additional,
            'ord_sessions' => $request->ord_sessions,
            'ord_status' => '0',
            'ord_del' => '0',
        ]);

        $request->session()->flash('mensagem', "Ordem de serviço $ordem->id criada com sucesso!");

        return redirect()->route('ordens.pagamento',['id' => $ordem->id]);
    }

    public function pagamentos(Request $request)
    {
        $pagamentos = MeioPagamento::all();
        $ordem = OrdemDeServico::find($request->id);
        $contas = ContaBancaria::all();
        $servico = Servico::find($ordem->ser_id);

        return view('ordens.pagamento', compact('pagamentos', 'ordem', 'contas', 'servico'));
    }

    public function payment(Request $request)
    {
        $ordem = OrdemDeServico::find($request->ord_id);
        $cliente = Cliente::find($ordem->cli_id);
        $profissional = Profissional::find($ordem->pro_id);

        $payment = Pagamento::create([
            'ord_id' => $request->ord_id,
            'pag_price' => $request->pag_price,
            'clie_id' => $cliente->id,
            'pro_id' => $profissional->pro_id,
            'pag_type' => 0,
            'pag_indicator' => $request->pag_indicator,
            'mei_id' => $request->input('mei_id'),
            'pag_open' => 0,
            'con_id' => $request->input('con_id'),
        ]);


        $request->session()->flash('mensagem', "Pagamento, da ordem de serviço $request->id, criado com sucesso!");

        return redirect()->route('ordens.agendar', ['id' => $request->id]);
    }

    public function destroy(Request $request)
    {
        OrdemDeServico::where('id', '=', $request->id)->update(array('ord_del' => 1));
        $request->session()->flash('mensagem', "Ordem removida com sucesso!");
        return redirect()->route('ordens.index');
    }

    public function update(Request $request)
    {
        $ordem = OrdemDeServico::find($request->id);
        $ordem->ord_description = $request->ord_description;
        $ordem->ord_additional = $request->ord_additional;
        $ordem->ord_sessions = $request->ord_sessions;

        $pagamento = Pagamento::find($request->pag_id);
        $pagamento->pag_price = $request->pag_price;
        $pagamento->pag_indicator = $request->pag_indicator;
        $pagamento->mei_id = $request->mei_id;
        $pagamento->con_id = $request->con_id;

        $pagamento->save();
        $ordem->save();

        $request->session()->flash('mensagem', "Ordem editada com sucesso!");

        return redirect()->route('ordens.index');
    }

    public function getServicos($idprofissional)
    {
        $profissional = Profissional::find($idprofissional);
        $servicoscollection['data'] = $profissional->servicos->collect(['id' => ['id'], 'name' => ['ser_name'],
            'sessions' => ['ser_sessions']]);

        return response()->json($servicoscollection);
    }

    public function getSessions($idservico)
    {
        $servico = Servico::find($idservico);
        $servicosession = $servico->ser_sessions;

        return response()->json($servicosession);
    }

    public function getProfissionais($idordem)
    {
        $ordem = OrdemDeServico::find($idordem);
        $profissionaiscollection['data'] = $ordem->profissional
            ->collect(['id' => ['id'], 'name' => ['pro_name'], 'color' =>['pro_color']]);

        return response()->json($profissionaiscollection);
    }

    public function getClientes($idordem)
    {
        $ordem = OrdemDeServico::find($idordem);
        $clientescollection['data'] = $ordem->cliente
            ->collect(['id' => ['id'], 'name' => ['clie_name'], 'phone' => ['clie_phone']]);

        return response()->json($clientescollection);
    }

    public function agendar(Request $request)
    {
        $ordem = OrdemDeServico::find($request->id);
        $agendamentos = Agendamento::all()->where('ord_id', '=', $ordem->id);
        $sessoes = $agendamentos->count();
        $profissional = Profissional::all()->where('id', '=', $ordem->pro_id)->first();
        $cliente = Cliente::all()->where('id', '=', $ordem->cli_id)->first();

        return view('ordens.agendar', compact('profissional', 'cliente', 'ordem', 'sessoes'));
    }

    public function schedule(Request $request)
    {
        $ordem = OrdemDeServico::find($request->ordemid);
        $cliente = Cliente::find($ordem->cli_id);
        $profissional = Profissional::find($ordem->pro_id);
        $pagamento = Pagamento::where('ord_id', '=', $request->ordemid)->first();

        $agendamentosStart = Agendamento::select("*")->where('pro_id', '=', $profissional->id)
            ->whereRaw('? between start and end', [Carbon::parse($request->start)->addMinute()])->count();

        $agendamentosEnd = Agendamento::select("*")->where('pro_id', '=', $profissional->id)
            ->whereRaw('? between start and end', [Carbon::parse($request->end)->subMinute()])->count();

        if($agendamentosStart == 1 || $agendamentosEnd == 1) {
            exit;
        } elseif ($agendamentosStart == 0 && $agendamentosEnd == 0) {
            $agendamento = Agendamento::create([
                'title' => $request->title,
                'start' => Carbon::parse($request->start),
                'end' => Carbon::parse($request->end),
                'color' => $request->color,
                'description' => $request->description,
                'status' => 0,
                'del' => 0,
                'clie_id' => $cliente->id,
                'pro_id' => $profissional->id,
                'ord_id' => $ordem->id,
                'ser_id' => $request->ser_id,
                'price' => $pagamento->pag_price
            ]);

            return response()->json(true);
        } else {
            exit;
        }

    }

    public function agendamentoAdicional(Request $request)
    {
        $ordem = OrdemDeServico::find(ordemid);
        $cliente = Cliente::find($ordem->cli_id);
        $profissional = Profissional::find($ordem->pro_id);

        $agendamentosStart = Agendamento::select("*")->where('pro_id', '=', $profissional->id)
            ->whereRaw('? between start and end', [Carbon::parse($request->start)->addMinute()])->count();

        $agendamentosEnd = Agendamento::select("*")->where('pro_id', '=', $profissional->id)
            ->whereRaw('? between start and end', [Carbon::parse($request->end)->subMinute()])->count();

        if($agendamentosStart == 1 || $agendamentosEnd == 1) {
            exit;
        } elseif ($agendamentosStart == 0 && $agendamentosEnd == 0) {
            $agendamento = Agendamento::create([
                'title' => $request->title,
                'start' => Carbon::parse($request->start),
                'end' => Carbon::parse($request->end),
                'color' => $request->color,
                'description' => $request->description,
                'status' => 0,
                'del' => 0,
                'clie_id' => $cliente->id,
                'pro_id' => $profissional->id,
                'ord_id' => $ordem->id
            ]);

            return response()->json(true);
        } else {
            exit;
        }



//
//        $agendamento = Agendamento::create([
//            'title' => $request->title,
//            'start' => Carbon::parse($request->start),
//            'end' => Carbon::parse($request->end),
//            'color' => $request->color,
//            'description' => $request->description,
//            'status' => 0,
//            'del' => 0,
//            'clie_id' => $ordem->cli_id,
//            'pro_id' => $ordem->pro_id,
//            'ord_id' => $ordem->id
//        ]);
//
//        return redirect()->route('ordens.agendamentos', ['id' => $request->ordemid]);
    }

    public function cancel(Request $request)
    {
        $ordem = OrdemDeServico::find($request->id);
        $ordem->ord_status = 2;
        $ordem->save();

        $request->session()->flash('mensagem', "Ordem cancelada com sucesso!");

        return redirect()->route('ordens.index');
    }

    public function finalize(Request $request)
    {
        $ordem = OrdemDeServico::find($request->id);
        $ordem->ord_status = 1;
        $ordem->save();

        $request->session()->flash('mensagem', "Ordem encerrada com sucesso!");

        return redirect()->route('ordens.index');
    }

    public function agendamentos($idordem)
    {
        $ordem = OrdemDeServico::find($idordem);
        $agendamentos = Agendamento::all()->where('ord_id', '=', $ordem->id);
        $sessoes = $agendamentos->count();
        $profissional = Profissional::all()->where('id', '=', $ordem->pro_id)->first();
        $cliente = Cliente::all()->where('id', '=', $ordem->cli_id)->first();

        return view('ordens.agendamentos', compact('ordem',
            'agendamentos', 'profissional', 'cliente', 'sessoes'));
    }
}
