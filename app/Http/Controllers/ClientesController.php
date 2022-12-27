<?php

namespace App\Http\Controllers;

use App\Http\Requests\clientesFormRequest;
use App\Models\City;
use App\Models\Cliente;
use App\Models\State;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $cidades = City::all();
        $clientes = Cliente::all()->where('clie_del', '=', 0)->paginate(10);
        $mensagem = $request->session()->get('mensagem');
        return view('clientes.index', compact('clientes', 'cidades', 'mensagem'));
    }

    public function create()
    {
        $estados['data'] = State::select('id', 'title')
            ->get();
        return view('clientes.create')->with('estados', $estados);
    }


    public function store(clientesFormRequest $request)
    {

        $cliente = Cliente::create([
            'clie_name' => $request->clie_name,
            'clie_email' => $request->clie_email,
            'clie_phone' => $request->clie_phone,
            'clie_bornday' => $request->clie_bornday,
            'clie_cpf' => $request->clie_cpf,
            'clie_address_street' => $request->clie_address_street,
            'clie_address_district' => $request->clie_address_district,
            'clie_address_complement' => $request->clie_address_complement,
            'clie_address_number' => $request->clie_address_number,
            'clie_address_zipcode' => $request->clie_address_zipcode,
            'city_id' => $request->input('city_id'),
            'clie_del' => '0',
        ]);
        $request->session()->flash('mensagem', "Cliente {$cliente->clie_name} cadastrado com sucesso!");

        return redirect()->route('clientes.index');
    }


    public function destroy(Request $request)
    {
        //Essa linha vai alterar o pro_del para 1, o pro_del significa se foi deletado (1) ou se não foi (0), é melhor fazer
        //assim para não perder alguma informação deletada sem querer. Na hora de exibir, é só colocar um where pro_del<>1
        //Cliente::destroy($request->id);
        Cliente::where('id', '=', $request->id)->update(array('clie_del' => 1));
        $request->session()->flash('mensagem', "cliente removida com sucesso!");
        return redirect()->route('clientes.index');
    }

    public function update(Request $request)
    {
        $cidades = City::all();
        $cliente = Cliente::find($request->id);
        $cliente->clie_name = $request->clie_name;
        $cliente->clie_email = $request->clie_email;
        $cliente->clie_phone = $request->clie_phone;
        $cliente->clie_bornday = $request->clie_bornday;
        $cliente->clie_cpf = $request->clie_cpf;
        $cliente->clie_address_street = $request->clie_address_street;
        $cliente->clie_address_district = $request->clie_address_district;
        $cliente->clie_address_complement = $request->clie_address_complement;
        $cliente->clie_address_number = $request->clie_address_number;
        $cliente->clie_address_zipcode = $request->clie_address_zipcode;
        $cliente->city_id = $request->input('city_id');
        $cliente->save();
        $request->session()->flash('mensagem', "Cliente $cliente->clie_name editado com sucesso!");

        return redirect()->route('clientes.index', compact('cidades'));
    }

    public function getCidades($idestado)
    {
        $cidades['data'] = City::select('id', 'title')
            ->where('state_id', '=', $idestado)
            ->get();

        return response()->json($cidades);
    }

    public function getCliente($id)
    {
        $cliente = Cliente::find($id);

        return response()->json($cliente);
    }
}
