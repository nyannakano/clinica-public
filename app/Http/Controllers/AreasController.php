<?php

namespace App\Http\Controllers;

use App\Http\Requests\areasFormRequest;
use App\Models\Area;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $areas = Area::all()->where('area_del', '=', 0)->paginate(10);
        $mensagem = $request->session()->get('mensagem');
        return view('areas.index', compact('areas', 'mensagem'));
    }

    public function create()
    {
        return view('areas.create');
    }

    public function edit()
    {
        return view('edit');
    }

    public function store(areasFormRequest $request)
    {
        $area = Area::create([
            'area_name' => $request->area_name,
            'area_del' => '0',
        ]);
        $request->session()->flash('mensagem', "Área {$area->area_name} cadastrada com sucesso!");

        return redirect()->route('areas.index');
    }

    public function update(Request $request)
    {
        $area = Area::find($request->id);
        $area->area_name = $request->area_name;
        $area->save();
        $request->session()->flash('mensagem', "Área $area->area_name editada com sucesso!");

        return redirect()->route('areas.index');
    }

    public function destroy(Request $request)
    {
        Area::where('id', '=', $request->id)->update(array('area_del' => 1));
        $request->session()->flash('mensagem', "Área removida com sucesso!");
        return redirect()->route('areas.index');
    }
}
