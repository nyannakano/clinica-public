<?php

namespace App\Http\Controllers;

use App\Http\Requests\agendamentosFormRequest;
use App\Models\Agendamento;
use App\Models\Area;
use App\Models\City;
use App\Models\Cliente;
use App\Models\Exception;
use App\Models\Hora;
use App\Models\Profissional;
use App\Models\Servico;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        $servicos = DB::table('servicos')->where('ser_availability', '=', 2)->get();
        $profissionais = Profissional::all();


        return view('home.index', compact('mensagem', 'servicos', 'profissionais'));
    }

    public function list()
    {
        $profissionais = Profissional::all();
        $servicos = Servico::all()->where('ser_availability', '=', 2);
        $areas = Area::all();
        $user = auth()->user()->id;
        $clientes = Cliente::all()->where('user_id', '=', $user)->first();
        if ($clientes != null) {
            $cadastrado = true;
        } else {
            $cadastrado = false;
        }

        return view('home.list', compact('servicos', 'profissionais', 'areas', 'cadastrado'));
    }

    public function serviceslist($id)
    {
        $profissional = Profissional::find($id);
        $servicos = $profissional->servicos()->where('ser_availability', '=', 2)->get();
        $user = auth()->user()->id;
        $clientes = Cliente::all()->where('user_id', '=', $user)->first();
        if ($clientes != null) {
            $cadastrado = true;
        } else {
            $cadastrado = false;
        }

        return view('home.serviceslist', compact('profissional', 'servicos', 'cadastrado'));
    }

    public function scheduling($pro_id, $ser_id)
    {
        $servico = Servico::find($ser_id);
        $profissional = Profissional::find($pro_id);
        $user = auth()->user()->id;
        $clientes = Cliente::all()->where('user_id', '=', $user)->first();
        if ($clientes != null) {
            $cadastrado = true;
        } else {
            $cadastrado = false;
        }

        return view('home.scheduling', compact('profissional', 'servico', 'cadastrado'));
    }

    public function loadEvents($pro_id, $ser_id)
    {
        $events = Agendamento::where('pro_id', '=', $pro_id)->get();

        return response()->json($events);
    }

    public function loadEventsFilter(Request $request)
    {
        $events = Agendamento::where('pro_id', '=', $request->id)->get();

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $inicio = $request->start;
        $fim = $request->end;
        $profissional = Profissional::find($request->pro_id);
        $agendamentos = Agendamento::all()->where('pro_id', '=', $profissional->id);
        $servico = Servico::find($request->ser_id);
        $user = auth()->user()->id;
        $cliente = Cliente::all()->where('user_id', '=', $user)->first();
        foreach ($agendamentos as $agendamento) {
            if ($inicio >= $agendamento->start && $inicio <= $agendamento->end) {
                return response()->json(false);
            }
            if ($fim > $agendamento->start && $fim <= $agendamento->end) {
                return response()->json(false);
            }
        };

        Agendamento::create([
            'title' => $request->title,
            'start' => Carbon::parse($inicio),
            'end' => Carbon::parse($fim),
            'description' => $request->description,
            'color' => "#FF6347",
            'status' => 0,
            'ser_id' => $servico->id,
            'clie_id' => $cliente->id,
            'auth' => 0,
            'pro_id' => $profissional->id,
            'del' => 0,
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

    public function loadBusinessHours($pro_id)
    {
        $profissional = Profissional::find($pro_id);
        $horas = Hora::all()->where('profissional_id', '=', $profissional->id);
        $events = array();
        foreach ($horas as $hora) {
            array_push($events, ([
                'daysOfWeek' => [$hora->dia_id - 1],
                'startTime' => $hora->horas_start,
                'endTime' => $hora->horas_end,
            ]));
        }

        return response()->json($events);
    }

    public function loadHorariosAtendimento($id)
    {
        $profissional = Profissional::find($id);
        $horas = Hora::all()->where('profissional_id', '=', $profissional->id);
        $events = array();
        foreach ($horas as $hora) {
            array_push($events, ([
                'daysOfWeek' => [$hora->dia_id - 1],
                'startTime' => $hora->horas_start,
                'endTime' => $hora->horas_end,
                'interval' => $hora->horas_interval,
                'returnInterval' => $hora->horas_return
            ]));
        }

        return response()->json($events);
    }

    public function loadService($id)
    {
        $service = Servico::find($id);

        return response()->json($service);
    }

    public function loadExceptionsDays($id)
    {
        $excecoes = Exception::all()->where('profissional_id', '=', $id);

        return response()->json($excecoes);
    }

    public function registerUpdate()
    {
        $city = City::find(4045);
        $user = auth()->user()->id;
        $cliente = Cliente::all()->where('user_id', '=', $user)->first();


        return view('home.registerUpdate', compact('city', 'user', 'cliente'));
    }

    public function registerUpdateSend(Request $request)
    {
        $city = City::find(4045);
        $user = auth()->user()->id;


        Cliente::create([
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
            'city_id' => $city->id,
            'user_id' => $user
        ]);

        return redirect()->route('home.index');
    }

    public function registerUpdateUpdate(Request $request)
    {
        $city = City::find(4045);
        $user = auth()->user()->id;
        $cliente = Cliente::all()->where('user_id', '=', $user)->first();

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
        $cliente->save();

        return redirect()->route('home.index');
    }

    public function getAgendamentosSolicitados()
    {
        $user = auth()->user()->id;
        $cliente = Cliente::all()->where('user_id', '=', $user)->first();
        if ($cliente != null) {
            $agendamentos = Agendamento::all()->where('clie_id', '=', $cliente->id);
            $profissionais = Profissional::all();
            $servicos = Servico::all();
        }  else {
            $agendamentos = null;
            $profissionais = Profissional::all();
            $servicos = Servico::all();
        }

        return view('home.agendamentosSolicitados', compact('agendamentos', 'profissionais', 'servicos', 'cliente'));
    }

    public function destroyAgendamento(Request $request)
    {
        Agendamento::where('id', '=', $request->id)->delete();
        return redirect()->route('home.agendamentosSolicitados');
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('home.index');
    }
}
