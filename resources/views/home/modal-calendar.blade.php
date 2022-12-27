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
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="title" class="tituloCampo">Título:</label>
                            <div class="input-group mb-2">
                                <input type="text" required class="form-control" name="title" id="title"
                                       placeholder="Titulo do evento">
                                <input type="hidden" name="id" id="id" class="id">
                                <input type="hidden" name="servico" id="servico" class="servico">
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
                        {{-- <div class="col-sm-6">
                            <label for="end" class="tituloCampo">Data e Hora Final:</label> <b>RETIRAR DATA E HORA FINAL, CLIENTE PRECISA APENAS SELECIONAR O HORARIO DE INICIO</b>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control date-time" name="end" id="end"
                                       placeholder="Data e Hora Final" disabled>
                            </div>
                        </div> --}}
                        {{-- <div class="col-sm-6">
                            <label for="color" class="tituloCampo">Cor:</label>
                            <div class="input-group mb-2"> --}}
                                <input type="color" class="form-control" name="color" id="color" placeholder="Cor" value="#00CED1" hidden>
                            {{-- </div>
                        </div> --}}
                        <div class="col-sm-6">
                            <label for="description" class="tituloCampo">Descrição:</label>
                            <div class="input-group mb-2">
                                <textarea class="form-control" name="description" id="description"
                                          placeholder="Descrição">
                                </textarea>
                            </div>
                        </div>
                        <h5>Todos os agendamentos estão sujeitos a aprovação da Scullp</h5>
                        <div class="col-sm-6" hidden>
                            <label for="status" class="tituloCampo">Status:</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="status" id="status" placeholder="Status">
                            </div>
                        </div>


                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary saveEvent">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>
