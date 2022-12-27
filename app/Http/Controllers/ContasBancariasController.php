<?php

namespace App\Http\Controllers;

use App\Http\Requests\contasBancariasFormRequest;
use App\Models\Cliente;
use App\Models\ContaBancaria;
use App\Models\Movimentacao;
use App\Models\Pagamento;
use App\Models\Parcela;
use App\Models\Profissional;
use Illuminate\Http\Request;

class ContasBancariasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $contas = ContaBancaria::all()->where('con_del', '=', 0)->paginate(10);
        $movimentacoes = Movimentacao::all();
        $mensagem = $request->session()->get('mensagem');
        return view('contas.index', compact('contas', 'mensagem', 'movimentacoes'));
    }

    public function create()
    {
        return view('contas.create');
    }

    public function edit()
    {
        return view('edit');
    }

    public function store(contasBancariasFormRequest $request)
    {

        $conta = ContaBancaria::create([
            'con_name' => $request->con_name,
            'con_bank' => $request->con_bank,
            'con_balance' => $request->con_balance,
            'con_del' => '0',
        ]);
        $request->session()->flash('mensagem', "Conta Bancaria {$conta->con_name} cadastrada com sucesso!");

        return redirect()->route('contas.index');
    }

    public function update(Request $request)
    {
        $conta = ContaBancaria::find($request->id);
        $conta->con_name = $request->con_name;
        $conta->con_bank = $request->con_bank;
        $conta->con_balance = $request->con_balance;
        $conta->save();
        $request->session()->flash('mensagem', "Conta Bancaria $conta->con_name editada com sucesso!");

        return redirect()->route('contas.index');
    }

    public function destroy(Request $request)
    {
        ContaBancaria::where('id', '=', $request->id)->update(array('con_del' => 1));
        $request->session()->flash('mensagem', "Conta Bancaria removida com sucesso!");
        return redirect()->route('contas.index');
    }

    public function viewAccount($idconta)
    {
        $conta = ContaBancaria::find($idconta);
        $movimentacoes = Movimentacao::all()->where('con_id', '=', $idconta)->paginate(20);
        $clientes = Cliente::all();
        $profissionais = Profissional::all();



        return view('contas.visualizar',
            compact('conta', 'movimentacoes', 'clientes', 'profissionais'));
    }

    public function removeMov($id)
    {
        $movimentacao = Movimentacao::find($id);
        if(!$movimentacao->par_id == null){
            $parcelaid = Parcela::find($movimentacao->par_id);
            $pagamento = Pagamento::find($parcelaid->pag_id);
            $movimentacao = Movimentacao::destroy($id);
            Parcela::destroy($parcelaid->id);
            $pagamento->pag_open = 0;
            $pagamento->save();
        }
        else {
            $movimentacao = Movimentacao::destroy($id);
        }

        return redirect()->back();
    }

    public function addmov(Request $request)
    {
        $conta = ContaBancaria::find($request->id);


        $movimentacao = Movimentacao::create([
            'mov_type' => $request->mov_type,
            'mov_value' => $request->mov_value,
            'clie_id' => $request->clie_id,
            'pro_id' => $request->pro_id,
            'con_id' => $conta->id,
            'mov_date' => $request->mov_date
        ]);

        return redirect()->back();
    }
}
