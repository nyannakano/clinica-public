<?php

namespace App\Http\Controllers;

use App\Http\Requests\servicosFormRequest;
use App\Models\Area;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $servicos = Servico::all()->where('ser_del', '=', 0)->paginate(10);
        $mensagem = $request->session()->get('mensagem');
        $areas = Area::all();
        return view('servicos.index', compact('servicos', 'mensagem', 'areas'));
    }

    public function create()
    {
        $areas = Area::all()->where('area_del', '=', 0);
        return view('servicos.create', compact('areas'));
    }

    public function edit()
    {
        return view('edit');
    }

    public function store(servicosFormRequest $request)
    {

        $servico = Servico::create([
            'ser_name' => $request->ser_name,
            'ser_price' => $request->ser_price,
            'area_id' => $request->input('area_id'),
            'ser_sessions' => $request->ser_sessions,
            'ser_del' => '0',
            'ser_time' => $request->ser_time,
            'ser_availability' => 1,
            'ser_image' => $this->verificaImagem($request),
        ]);
        $request->session()->flash('mensagem', "Serviço {$servico->ser_name} cadastrado com sucesso!");

        return redirect()->route('servicos.index');
    }

    public function update(Request $request)
    {
        $servico = Servico::find($request->id);
        $servico->ser_name = $request->ser_name;
        $servico->ser_price = $request->ser_price;
        $servico->area_id = $request->input('area_id');
        $servico->ser_sessions = $request->ser_sessions;
        $servico->ser_availability = $request->ser_availability;
        $servico->ser_time = $request->ser_time;
        if (!$servico->ser_image == null) {
            $servico->ser_image = $this->verificaImagem($request);
        }
        $servico->save();
        $request->session()->flash('mensagem', "Servico $servico->ser_name editado com sucesso!");

        return redirect()->route('servicos.index');
    }

    public function destroy(Request $request)
    {
        Servico::where('id', '=', $request->id)->update(array('ser_del' => 1));
        $request->session()->flash('mensagem', "Serviço removido com sucesso!");
        return redirect()->route('servicos.index');
    }

    public function verificaImagem(Request $request)
    {
        if ($request->ser_image == null) {
            return;
        }
        if (
            $request->ser_image->isValid() &&
            $request->ser_image->extension() == 'jpg' ||
            $request->ser_image->extension() == 'jpeg' ||
            $request->ser_image->extension() == 'png'
        ) {
            $path = Storage::putFile("public/serimages", $request->file("ser_image"));

            $data['ser_image'] = substr($path, 6);

            return substr($path, 6);
        }
        return null;
    }
}
