<?php

use App\Http\Controllers\AgendamentosController;
use App\Http\Controllers\AreasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ContasAPagarController;
use App\Http\Controllers\ContasBancariasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeiosPagamentoController;
use App\Http\Controllers\OrdemDeServicoController;
use App\Http\Controllers\PagamentosController;
use App\Http\Controllers\ProfissionaisController;
use App\Http\Controllers\ServicosController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('home.index');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['admin'])->group(function () {



    /* Rotas para Clientes: */
    Route::get('/clientes', [ClientesController::class, 'index'])
        ->name('clientes.index');

    Route::get('/clientes/cadastro', [ClientesController::class, 'create'])
        ->name('form_cadastro_cliente');

    Route::get('/getcidades/{idestado}', [ClientesController::class, 'getCidades']);

    Route::post('/clientes/cadastro', [ClientesController::class, 'store']);

    Route::delete('/clientes/remover/{id}', [ClientesController::class, 'destroy']);

    Route::post('/clientes/editar/{id}', [ClientesController::class, 'update']);

    Route::get('/getcliente/{id}', [ClientesController::class, 'getCliente']);



    /* Rotas para Areas: */
    Route::get('/areas', [AreasController::class, 'index'])
        ->name('areas.index');

    Route::get('/areas/cadastro', [AreasController::class, 'create'])
        ->name('form_cadastro_area');

    Route::post('/areas/cadastro', [AreasController::class, 'store']);

    Route::delete('/areas/remover/{id}', [AreasController::class, 'destroy']);

    Route::post('/areas/editar/{id}', [AreasController::class, 'update']);


    /* Rotas para Serviços: */
    Route::get('/servicos', [ServicosController::class, 'index'])
        ->name('servicos.index');

    Route::get('/servicos/cadastro', [ServicosController::class, 'create'])
        ->name('form_cadastro_servico');

    Route::post('/servicos/cadastro', [ServicosController::class, 'store']);

    Route::delete('/servicos/remover/{id}', [ServicosController::class, 'destroy']);

    Route::post('/servicos/editar/{id}', [ServicosController::class, 'update']);




    /* Rotas para Profissionais: */
    Route::get('/profissionais', [ProfissionaisController::class, 'index'])
        ->name('profissionais.index');

    Route::get('/profissionais/cadastro', [ProfissionaisController::class, 'create'])
        ->name('form_cadastro_profissional');

    Route::post('/profissionais/cadastro', [ProfissionaisController::class, 'store']);

    Route::delete('/profissionais/remover/{id}', [ProfissionaisController::class, 'destroy']);

    Route::get('/profissionais/acoplar/{id}', [ProfissionaisController::class, 'acoplar'])
        ->name('profissionais.acoplar');

    Route::post('/profissionais/{pro_id}/servicos/{ser_id}', [ProfissionaisController::class, 'couple']);
    // serve para juntar o profissional com o serviço, em uma relação manyToMany n:n

    Route::delete('/profissionais/retirar/{pro_id}/servicos/{ser_id}', [ProfissionaisController::class, 'uncouple']);
    // serve para remover a junção

    Route::post('/profissionais/editar/{id}', [ProfissionaisController::class, 'update']);

    Route::get('/profissionais/disponibilidade/{id}', [ProfissionaisController::class, 'availability'])
        ->name('profissionais.disponibilidade');
    // listar a disponibilidade de agenda do profissional

    Route::post('/profissionais/disponibilidade/dia/{id}', [ProfissionaisController::class, 'setAvailability']);
    // setar os dias e horas disponiveis para agendamento por clientes

    Route::delete('/profissionais/disponibilidade/{id}', [ProfissionaisController::class, 'unsetAvailability']);
    // remover disponibilidade

    Route::put('/profissionais/disponibilidade/dia/{id}', [ProfissionaisController::class, 'updateAvailability']);
    // editar os dias e horas disponiveis para agendamento por clientes

    Route::get('/profissionais/excecoes/{id}', [ProfissionaisController::class, 'exceptions'])
        ->name('profissionais.excecoes');
    // dias exceções em que não haverá atendimento

    Route::post('/profissionais/excecoes/{id}', [ProfissionaisController::class, 'setExceptions'])
        ->name('excecoes.criar');
    // criar exceção

    Route::delete('/profissionais/excecoes/{id}', [ProfissionaisController::class, 'destroyExceptions'])
        ->name('excecoes.destroy');
    // deletar exceção


    //  Rotas para Agenda

    Route::get('/agenda', [AgendamentosController::class, 'index'])
        ->name('agenda.index');

    Route::get('/agenda/{id}', [AgendamentosController::class, 'filter'])
        ->name('agenda.filter');

    Route::get('/agenda-requests', [AgendamentosController::class, 'requests'])
        ->name('agenda.requests');

    Route::post('/agenda-approve/{id}', [AgendamentosController::class, 'aprovar'])
        ->name('agenda.aprovar');

    Route::post('/teste', [AgendamentosController::class, 'teste'])
        ->name('agenda.teste');

    Route::get('/verify', [AgendamentosController::class, 'verify'])
        ->name('verify');

    Route::get('/load-events', [AgendamentosController::class, 'loadEvents'])
        ->name('routeLoadEvents');

    Route::get('/load-eventbyid/{id}', [AgendamentosController::class, 'loadEventById'])
        ->name('routeLoadEventsById');


    Route::get('/load-events/{id}', [AgendamentosController::class, 'loadEventsFilter'])
        ->name('routeLoadEventsFilter');

    Route::put('/event-update', [AgendamentosController::class, 'update'])
        ->name('routeEventUpdate');

    Route::post('/event-confirm', [AgendamentosController::class, 'confirm'])
        ->name('routeEventConfirm');

    Route::delete('/event-delete', [AgendamentosController::class, 'destroy'])
        ->name('routeEventDelete');

    Route::delete('/agendamento-delete/{id}', [AgendamentosController::class, 'deletar'])
        ->name('agendamento.deletar');

    Route::delete('/agendamento-recusar/{id}', [AgendamentosController::class, 'recusar'])
        ->name('agendamento.recusar');

    Route::post('/event-store', [AgendamentosController::class, 'store'])
        ->name('routeEventStore');

    Route::get('/getservices/{id}', [AgendamentosController::class, 'getServices'])
        ->name('routeGetServices');

    Route::get('/getservice/{id}', [AgendamentosController::class, 'getService'])
        ->name('routeGetService');

    Route::post('/event-approve', [AgendamentosController::class, 'approve'])
        ->name('routeEventApprove');



    // Rotas para Ordens de Serviço

    Route::get('/ordens', [OrdemDeServicoController::class, 'index'])
        ->name('ordens.index');

    Route::get('/ordens/view/{id}', [OrdemDeServicoController::class, 'viewOrder'])
        ->name('ordens.vieworder');

    Route::get('/ordens/nova', [OrdemDeServicoController::class, 'create'])
        ->name('form_nova_ordem');

    Route::post('/ordens/nova', [OrdemDeServicoController::class, 'store']);

    Route::get('/getarea/{id}', [OrdemDeServicoController::class, 'getAreas']); // filtrar por área

    Route::get('/getprofissional/{id}', [OrdemDeServicoController::class, 'getProfissionais']); // filtrar por profissional

    Route::get('/getservicos/{id}', [OrdemDeServicoController::class, 'getServicos']); // filtrar por serviço

    Route::get('/getsessions/{id}', [OrdemDeServicoController::class, 'getSessions']); // filtrar sessoes

    Route::post('/ordens/cadastro', [OrdemDeServicoController::class, 'store']);

    Route::post('/ordens/encerrar/{id}', [OrdemDeServicoController::class, 'finalize']);

    Route::post('/ordens/cancelar/{id}', [OrdemDeServicoController::class, 'cancel']);


    Route::get('/ordens/pagamento/{id}', [OrdemDeServicoController::class, 'pagamentos'])->name('ordens.pagamento');

    // rotas /\ e \/ para registrar o pagamento da ordem
    Route::post('/ordens/pagamento/{id}', [OrdemDeServicoController::class, 'payment']);


    Route::delete('/ordens/remover/{id}', [OrdemDeServicoController::class, 'destroy']);

    Route::post('/ordens/view/{id}', [OrdemDeServicoController::class, 'update']);

    Route::get('/ordens/agendar/{id}', [OrdemDeServicoController::class, 'agendar'])
        ->name('ordens.agendar');
    // rota para view que vai ter as opções de agendamento a partir de uma ordem de serviço

    Route::post('/ordens/agendar', [OrdemDeServicoController::class, 'schedule'])
        ->name('ordens.schedule');
    // rota para salvar o agendamento

    Route::get('/ordens/agendamentos/{id}', [OrdemDeServicoController::class, 'agendamentos'])
        ->name('ordens.agendamentos');

    Route::post('/ordens/agendamentoadicional', [OrdemDeServicoController::class, 'agendamentoAdicional'])
        ->name('ordens.adicional');
    // rota para salvar o agendamento adicional




    // Rotas para Meios de Pagamento

    Route::get('/meios', [MeiosPagamentoController::class, 'index'])
        ->name('meios.index');

    Route::get('/meios/cadastro', [MeiosPagamentoController::class, 'create'])
        ->name('form_cadastro_meio');

    Route::post('/meios/cadastro', [MeiosPagamentoController::class, 'store']);

    Route::delete('/meios/remover/{id}', [MeiosPagamentoController::class, 'destroy']);

    Route::post('/meios/editar/{id}', [MeiosPagamentoController::class, 'update']);





    // Rotas para Contas Bancárias

    Route::get('/contas', [ContasBancariasController::class, 'index'])
        ->name('contas.index');

    Route::get('/contas/cadastro', [ContasBancariasController::class, 'create'])
        ->name('form_cadastro_conta');

    Route::post('/contas/cadastro', [ContasBancariasController::class, 'store']);

    Route::delete('/contas/remover/{id}', [ContasBancariasController::class, 'destroy']);

    Route::post('/contas/editar/{id}', [ContasBancariasController::class, 'update']);

    Route::get('/contas/{id}', [ContasBancariasController::class, 'viewAccount'])
        ->name('contas.visualizar');

    Route::post('/contas/{id}', [ContasBancariasController::class, 'addmov'])
        ->name('contas.addmov');

    Route::delete('/movimentacao/remover/{id}', [ContasBancariasController::class, 'removeMov'])
        ->name('mov.remover');





    // Rotas para Contas a Receber (Financeiro)

    Route::get('/financeiro', [PagamentosController::class, 'index'])
        ->name('pagamentos.index');

    Route::get('/financeiro/contaareceber/nova', [PagamentosController::class, 'create'])
        ->name('form_cadastro_contaareceber');

    Route::post('/financeiro/contaareceber/nova', [PagamentosController::class, 'store']);

    Route::delete('/financeiro/pagamento/remover/{id}', [PagamentosController::class, 'destroy']);

    Route::post('/financeiro/pagamento/cancelar/{id}', [PagamentosController::class, 'cancel']);

    Route::get('/financeiro/contaareceber/{id}', [PagamentosController::class, 'viewContaAReceber'])
        ->name('pagamentos.viewcontaareceber');

    Route::post('/financeiro/contaareceber/generate/{id}', [PagamentosController::class, 'generate'])
        ->name('pagamentos.generate');

    Route::post('/financeiro/contaareceber/editar/{id}', [PagamentosController::class, 'update']);

    Route::post('/financeiro/contaareceber/receber/{id}', [PagamentosController::class, 'receive']);

    Route::get('/financeiro/contaareceber/filter/{type}', [PagamentosController::class, 'filter'])
        ->name('pagamentos.filter');

    Route::get('/financeiro/contaareceber/filter/client/{id}', [PagamentosController::class, 'filterClient'])
        ->name('pagamentos.filterclient');



    // Rotas para Contas a Pagar (Financeiro)

    Route::get('/contaapagar', [ContasAPagarController::class, 'index'])
        ->name('pagar.index');

    Route::get('/contaapagar/nova', [ContasAPagarController::class, 'create'])
        ->name('form_cadastro_contaapagar');

    Route::post('/contaapagar/nova', [ContasAPagarController::class, 'store']);

    Route::delete('/contaapagar/pagar/remover/{id}', [ContasAPagarController::class, 'destroy']);

    Route::post('/contaapagar/pagar/cancelar/{id}', [ContasAPagarController::class, 'cancel']);

    Route::get('/contaapagar/{id}', [ContasAPagarController::class, 'viewContaAPagar'])
        ->name('pagamentos.viewcontaapagar');

    Route::post('/contaapagar/generate/{id}', [ContasAPagarController::class, 'generate'])
        ->name('pagar.generate');

    Route::post('/contaapagar/editar/{id}', [ContasAPagarController::class, 'update']);

    Route::post('/contaapagar/pagar/{id}', [ContasAPagarController::class, 'pay']);

    Route::get('/financeiro/contaapagar/filter/{type}', [ContasAPagarController::class, 'filterpay'])
        ->name('pagar.filterpay');
});


// Rotas para as telas do sistema de clientes

Route::get('/home', [HomeController::class, 'index'])
    ->name('home.index');

Route::get('/logout', [HomeController::class, 'logout'])
    ->name('home.logout');

Route::get('/home/agendar', [HomeController::class, 'list'])
    ->name('home.agendar')->middleware('auth');

Route::get('/home/agendar/{pro_id}', [HomeController::class, 'serviceslist'])
    ->name('home.servicos')->middleware('auth');

Route::get('/home/agendar/{pro_id}/{ser_id}', [HomeController::class, 'scheduling'])
    ->name('home.scheduling')->middleware('auth');

Route::get('/home/cadastro', [HomeController::class, 'registerUpdate'])
    ->name('home.registerUpdate')->middleware('auth');

Route::post('/home/cadastro', [HomeController::class, 'registerUpdateSend'])
    ->name('home.registerUpdateSend')->middleware('auth');

Route::post('/home/cadastro/update', [HomeController::class, 'registerUpdateUpdate'])
    ->name('home.registerUpdateUpdate')->middleware('auth');

Route::get('/home/agendamentos-solicitados', [HomeController::class, 'getAgendamentosSolicitados'])
    ->name('home.agendamentosSolicitados')->middleware('auth');

Route::delete('/home/agendamentos-solicitados/{id}', [HomeController::class, 'destroyAgendamento'])
    ->name('home.destroyAgendamento');

//  Rotas para Agenda dos Clientes


Route::get('/home/agendar/{pro_id}/{ser_id}/load-events', [HomeController::class, 'loadEvents'])
    ->name('cliente.routeLoadEvents');


Route::put('/home/agendar/{pro_id}/{ser_id}/event-update', [HomeController::class, 'update'])
    ->name('cliente.routeEventUpdate');

Route::delete('/home/agendar/{pro_id}/{ser_id}/event-delete', [HomeController::class, 'destroy'])
    ->name('cliente.routeEventDelete');

Route::post('/home/agendar/{pro_id}/{ser_id}', [HomeController::class, 'store'])
    ->name('cliente.routeEventStore');

Route::get('/home/agendar/{pro_id}/{ser_id}/load-businesshours', [HomeController::class, 'loadBusinessHours'])
    ->name('cliente.routeEventBusinessHours');

Route::get('/home/agendar/{pro_id}/{ser_id}/load-horariosatendimento', [HomeController::class, 'loadHorariosAtendimento'])
    ->name('cliente.routeEventHorariosAtendimento');

Route::get('load-service/{id}', [HomeController::class, 'loadService'])
    ->name('cliente.routeEventService');

Route::get('load-exceptions/{id}', [HomeController::class, 'loadExceptionsDays'])
    ->name('cliente.routeEventException');


