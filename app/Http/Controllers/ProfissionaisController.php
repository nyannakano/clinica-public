<?php

namespace App\Http\Controllers;

use App\Http\Requests\profissionaisFormRequest;
use App\Models\Area;
use App\Models\Dia;
use App\Models\Disponibilidade;
use App\Models\Exception;
use App\Models\Hora;
use App\Models\Profissional;
use App\Models\ProfissionalPrestaServico;
use App\Models\Servico;
use Illuminate\Http\Request;

class ProfissionaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $areas = Area::all()->where('area_del', '=', '0');
        $servicos = Servico::all();
        $profissionais = Profissional::all()->where('area_del', '=', 0)->paginate(10);

        $mensagem = $request->session()->get('mensagem');
        return view('profissionais.index', compact('profissionais', 'servicos', 'areas', 'mensagem'));
    }

    public function create()
    {
        $areas = Area::all()->where('area_del', '=', '0');
        return view('profissionais.create', compact('areas'));
    }

    public function edit()
    {
        return view('edit');
    }

    public function store(profissionaisFormRequest $request)
    {

        $profissional = Profissional::create([
            'pro_name' => $request->pro_name,
            'pro_health_plan' => $request->pro_health_plan,
            'area_id' => $request->input('area_id'),
            'pro_color' => $request->pro_color,
            'pro_del' => '0',
        ]);

        $request->session()->flash('mensagem', "Profissional {$profissional->pro_name} cadastrado com sucesso!");

        return redirect()->route('profissionais.index');
    }

    public function update(Request $request)
    {
        $profissional = Profissional::find($request->id);
        $profissional->pro_name = $request->pro_name;
        $profissional->pro_health_plan = $request->pro_health_plan;
        $profissional->pro_color = $request->pro_color;
        $profissional->area_id = $request->input('area_id');
        $profissional->save();
        $request->session()->flash('mensagem', "Profissional $profissional->pro_name editado com sucesso!");

        return redirect()->route('profissionais.index');
    }

    public function destroy(Request $request)
    {
        Profissional::where('id', '=', $request->id)->update(array('pro_del' => 1));
        $request->session()->flash('mensagem', "Profissional removido com sucesso!");
        return redirect()->route('profissionais.index');
    }

    public function acoplar(Request $request)
    {
        $profissional = Profissional::find($request->id);
        $servicosdois = $profissional->servicos()->get();
        $servicos = Servico::all();

        $mensagem = $request->session()->get('mensagem');

        return view('profissionais.acoplar', compact('profissional', 'servicos', 'mensagem', 'servicosdois'));
    }

    public function couple(Request $request)
    {
        $servico = Servico::find([$request->ser_id]);
        $profissional = Profissional::find($request->pro_id);

        $profissional->servicos()->syncWithoutDetaching($servico);
        $request->session()->flash('mensagem', "Serviço prestado adicionado com sucesso!");
        return redirect()->route('profissionais.acoplar', [ 'id' => $profissional->id ]);
    }

    public function uncouple(Request $request)
    {
        $servico = Servico::find([$request->ser_id]);
        $profissional = Profissional::find($request->pro_id);


        $profissional->servicos()->detach($servico);

        $request->session()->flash('mensagem', "Serviço prestado removido com sucesso!");
        return redirect()->route('profissionais.acoplar', [ 'id' => $profissional->id ]);
    }

    public function availability($id)
    {
        $profissional = Profissional::find($id);
        $dias = Dia::all();
        $horas = Hora::all()->where('profissional_id', '=', $profissional->id);

        return view('profissionais.availability',
            compact('profissional', 'dias', 'horas'));
    }

    public function setAvailability(Request $request)
    {
        $horas = Hora::create([
            'profissional_id' => $request->profissionalid,
            'dia_id' => $request->diaid,
            'horas_start' => $request->horas_start,
            'horas_interval' => $request->horas_interval,
            'horas_return' => $request->horas_return,
            'horas_end' => $request->horas_end,
        ])->id;

        return back();
    }

    public function updateAvailability(Request $request)
    {
        $hora = Hora::find($request->horaid);
        $hora->horas_start = $request->horas_start;
        $hora->horas_interval = $request->horas_interval;
        $hora->horas_return = $request->horas_return;
        $hora->horas_end = $request->horas_end;
        $hora->save();

        return back();

    }

    public function unsetAvailability($id)
    {
        $hora = Hora::destroy($id);
        return back();
    }

    public function exceptions($id)
    {
        $excecoes = Exception::all()->where('profissional_id','=', $id)->sortByDesc('exc_dia');
        $profissionalid = $id;

        return view('profissionais.exceptions', compact('excecoes', 'profissionalid'));
    }

    public function setExceptions(Request $request)
    {
        $profissional = Profissional::find($request->profissionalid);

        $excecao = Exception::create([
           'exc_horas_start' => $request->exc_horas_start,
           'exc_horas_end' => $request->exc_horas_end,
           'exc_dia' => $request->exc_dia,
           'profissional_id' => $profissional->id,
        ])->id;

        return redirect()->route('profissionais.excecoes', [ 'id' => $profissional->id ]);
    }

    public function destroyExceptions($id)
    {
        $exception = Exception::destroy($id);
        return back();
    }
}


