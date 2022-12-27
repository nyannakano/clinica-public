<?php

namespace App\Http\Controllers;

use App\Http\Requests\meiosPagamentoFormRequest;
use App\Models\MeioPagamento;
use Illuminate\Http\Request;

class MeiosPagamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $meios = MeioPagamento::all()->where('mei_del', '=', 0)->paginate(10);
        $mensagem = $request->session()->get('mensagem');
        return view('meios.index', compact('meios', 'mensagem'));
    }

    public function create()
    {
        return view('meios.create');
    }

    public function edit()
    {
        return view('edit');
    }

    public function store(meiosPagamentoFormRequest $request)
    {

        $meio = MeioPagamento::create([
            'mei_name' => $request->mei_name,
            'mei_indicator' => $request->mei_indicator,
            'mei_del' => '0',
        ]);
        $request->session()->flash('mensagem', "Meio de pagamento {$meio->mei_name} cadastrado com sucesso!");

        return redirect()->route('meios.index');
    }

    public function update(Request $request)
    {
        $meio = MeioPagamento::find($request->id);
        $meio->mei_name = $request->mei_name;
        $meio->mei_indicator = $request->mei_indicator;
        $meio->save();
        $request->session()->flash('mensagem', "Meio de pagamento $meio->mei_name editado com sucesso!");

        return redirect()->route('meios.index');
    }

    public function destroy(Request $request)
    {
        MeioPagamento::where('id', '=', $request->id)->update(array('mei_del' => 1));
        $request->session()->flash('mensagem', "Meio de pagamento removido com sucesso!");
        return redirect()->route('meios.index');
    }


}
