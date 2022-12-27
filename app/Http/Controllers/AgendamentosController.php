<?php

namespace App\Http\Controllers;

use App\Http\Requests\agendamentosFormRequest;
use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\OrdemDeServico;
use App\Models\Profissional;
use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class AgendamentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $profissionais = Profissional::all();
        $clientes = Cliente::all();
        $servicos = Servico::all();

        return view('agenda.index', compact('profissionais', 'clientes', 'servicos'));
    }

    public function filter($id)
    {
        $profissional = Profissional::find($id);
        $clientes = Cliente::all();
        $servicos = $profissional->servicos()->get();

        return view('agenda.filter', compact('profissional', 'clientes', 'servicos'));
    }

    public function loadEvents()
    {
        $events = Agendamento::all();

        return response()->json($events);
    }

    public function loadEventsFilter(Request $request)
    {
        $events = Agendamento::where('pro_id', '=', $request->id)->get();

        return response()->json($events);
    }

    public function loadEventById($id)
    {
        $event = Agendamento::find($id);

        return response()->json($event);
    }

    public function store(agendamentosFormRequest $request)
    {
        if ($request->ord_id !== null) {
            $ordem = $request->ord_id;
            $cliente = $request->clie_id;
            $profissional = $request->pro_id;
        } else {
            $ordem = null;

            if ($request->pro_id == null) {
                $profissional = null;
            } else {
                $profissional = $request->pro_id;
            }
            if ($request->clie_id == null) {
                $cliente = null;
            } else {
                $cliente = $request->clie_id;
            }
            if($request->ser_id == null) {
                $servico = null;
            } else {
                $servico = $request->ser_id;
            }
        }

        Agendamento::create([
            'id' => $request->id,
            'title' => $request->title,
            'start' => Carbon::parse($request->start),
            'end' => Carbon::parse($request->end),
            'description' => $request->description,
            'color' => $request->color,
            'status' => 0,
            'ord_id' => $ordem,
            'clie_id' => $cliente,
            'pro_id' => $profissional,
            'ser_id' => $servico,
            'price' => $request->price,
            'del' => 0
        ]);

        return response()->json(true);
    }

    public function update(Request $request)
    {
        $event = Agendamento::where('id', $request->id)->first();
        $event->fill($request->all());
        $event->save();

        return response()->json(true);
    }


    public function destroy(Request $request)
    {
        Agendamento::where('id', '=', $request->id)->delete();
        return response()->json(true);
    }

    public function deletar(Request $request)
    {
        Agendamento::where('id', '=', $request->id)->delete();

        return back();
    }

    public function confirm(Request $request)
    {
        $event = Agendamento::where('id', '=', $request->id)->first();
        if ($event->status == 0) {
            $event->status = 1;
        } else if ($event->status == 1) {
            $event->status = 0;
        }
        $event->save();

        return response()->json(true);
    }

    public function getServices($id)
    {
        $profissional = Profissional::find($id);
        $servicos = $profissional->servicos()->get();

        return response()->json($servicos);
    }

    public function getService($id)
    {
        $servico = Servico::find($id);

        return response()->json($servico);
    }

    public function approve(Request $request)
    {
        $event = Agendamento::where('id', '=', $request->id)->first();
        if ($event->auth == 0) {
            $event->auth = 1;
        } else if ($event->auth == 1) {
            $event->auth = 0;
        }
        $event->save();

        return response()->json(true);
    }

    public function requests()
    {
        $profissionais = Profissional::all();
        $clientes = Cliente::all();
        $servicos = Servico::all();
        $agendamentos = Agendamento::all()->where('auth', '=', 0);

        return view('agenda.requests', compact('profissionais', 'clientes', 'servicos', 'agendamentos'));
    }

    public function recusar($id) {
        $agendamento = Agendamento::find($id);
        $agendamento->delete();

        return redirect()->route('agenda.requests');
    }

    public function aprovar($id) {
        $agendamento = Agendamento::find($id);
        $agendamento->auth = 1;
        $agendamento->save();

        return redirect()->route('agenda.requests');
    }

    public function verify() {
        $agendamentos = Agendamento::all();
        $count = 0;
        foreach ($agendamentos as $agendamento) {
            if($agendamento->auth == 0) {
                $count++;
            }
        }

        return response()->json($count);
    }
}
