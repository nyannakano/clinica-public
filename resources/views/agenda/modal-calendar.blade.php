<div class="modal fade" id="modalCalendar" tabindex="-1" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleModal">Title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="message"></div>

                <form id="formEvent">
                    <div id="formClinica">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="title" class="tituloCampo">Título:</label>
                            <div class="input-group mb-2">
                                <input type="text" required class="form-control" name="title" id="title"
                                       placeholder="Titulo do evento">
                                <input type="hidden" name="id" id="id" class="id">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="pro_id" class="tituloCampo">Profissional:</label>
                            <div class="input-group">
                                <select name="pro_id" id="pro_id" class="custom-select mb-2">
                                    <option value="">Selecione o Profissional...</option>
                                    @foreach($profissionais as $profissional)
                                        <option value="{{ $profissional->id }}">{{ $profissional->pro_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="ser_id" class="tituloCampo">Serviço:</label>
                            <div class="input-group">
                                <select name="ser_id" id="ser_id" class="custom-select mb-2" disabled>
                                    <option value="0">Selecione o Serviço...</option>
                                    @foreach($servicos as $servico)
                                        <option value="{{ $servico->id }}">{{ $servico->ser_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="clie_id" class="tituloCampo">Cliente:</label>
                            <div class="input-group">
                                <select name="clie_id" id="clie_id" class="custom-select mb-2">
                                    <option value="">Selecione o Cliente...</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->clie_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="price" class="tituloCampo">
                                Valor:<br>
                                <b>APENAS DEMONSTRATIVO, NÃO AFETA O FINANCEIRO</b>
                            </label>
                            <div class="input-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">R$</span>
                                    </div>
                                    <input type="number" class="form-control" name="price" id="price"
                                           value="0.00" step="0.10" min="0"
                                           placeholder="Preço">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="start" class="tituloCampo">Data e Hora Inicial:</label>
                            <div class="input-group">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control date-time" name="start" id="start"
                                           placeholder="Data e Hora Inicial">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="end" class="tituloCampo">Data e Hora Final:</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control date-time" name="end" id="end"
                                       placeholder="Data e Hora Final">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="color" class="tituloCampo">Cor:</label>
                            <div class="input-group mb-2">
                                <input type="color" class="form-control" name="color" id="color" placeholder="Cor">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="description" class="tituloCampo">Descrição:</label>
                            <div class="input-group mb-2">
                                <textarea class="form-control" name="description" id="description"
                                          placeholder="Descrição">
                                </textarea>
                            </div>
                        </div>
                        <div class="col-sm-6" hidden>
                            <label for="status" class="tituloCampo">Status:</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="status" id="status" placeholder="Status">
                            </div>
                        </div>

                    </div>
                </div>
                </form>
                {{-- modal para verificar dados do agendamento acima
                    modal para confirmar pedidos de agendamento abaixo --}}
                     <div class="form-group row" id="confirmarPedido">
                        <div class="col-sm-6">
                            <label for="clie_id" class="tituloCampo">Cliente:</label>
                            <div class="input-group">
                                <select name="clie_id" id="clie_id" class="custom-select mb-2" disabled>
                                    <option value="">Selecione o Cliente...</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->clie_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="pro_id" class="tituloCampo">Profissional:</label>
                            <div class="input-group">
                                <select name="pro_id" id="pro_id" class="custom-select mb-2" disabled>
                                    <option value="">Selecione o Profissional...</option>
                                    @foreach($profissionais as $profissional)
                                        <option value="{{ $profissional->id }}">{{ $profissional->pro_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="ser_id" class="tituloCampo">Serviço:</label>
                            <div class="input-group">
                                <select name="ser_id" id="ser_id" class="custom-select mb-2" disabled>
                                    <option value="0">Selecione o Serviço...</option>
                                    @foreach($servicos as $servico)
                                        <option value="{{ $servico->id }}">{{ $servico->ser_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="start" class="tituloCampo">Data e Hora Inicial:</label>
                            <div class="input-group">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control date-time" name="start" id="start"
                                           placeholder="Data e Hora Inicial" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="end" class="tituloCampo">Data e Hora Final:</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control date-time" name="end" id="end"
                                       placeholder="Data e Hora Final" disabled>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="description" class="tituloCampo">Descrição:</label>
                            <div class="input-group mb-2">
                                <textarea class="form-control" name="description" id="description"
                                          placeholder="Descrição" disabled>
                                </textarea>
                            </div>
                        </div>

                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary saveEvent">Salvar</button>
                    <button type="button" class="btn btn-primary confirmEvent">Confirmar Agendamento</button>
                    <button type="button" class="btn btn-primary approveEvent">Aprovar Agendamento</button>
                    <button type="button" id="whatsappEvent" class="btn btn-success whatsappEvent">Whatsapp</button>
                    <button type="button" class="btn btn-danger deleteEvent">Excluir</button>
                </div>
            </div>
        </div>
    </div>
</div>
