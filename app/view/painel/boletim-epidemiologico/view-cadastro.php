<main class="col-md-10">

    <img src="../img/loading.gif" id="spinner" class="mainSpinner" width="120" style="position: absolute; z-index: 1; top: 250px; left: 600px; display: none" />

    <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
        <div class="col-md-11">
        <span class="span-30" style="color: gray"><i class="fa fa-plus-square"></i> Epidemiologia </span><span class="gray">Boletim Epidemiologico</span>
        </div>
        <div class="col-md-1 p-0">
            <a href="cadastro.php" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</a>
        </div>
    </div>

    <!-- FORM CADASTRO -->
    <div class="col-md-12  reset">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Cadastro</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content bg-white border border-top-0">

            <div class="tab-pane active" id="home" style="padding: 20px;">

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-building-o"></i> <i><b>Dados do Boletim</b></i>

                            &emsp;
                            <span id="tab_1_alerts"></span>
                            <img class="loading" src="../img/loading-sm.svg" style="display: none">
                            </svg>

                        </div>
                    </div>
                </div>

                <form id="tab-1-form-1" enctype="multipart/form-data">
                    <input type="hidden" name="tbl" id="tbl" value="boletim_epidemiologico">

                    <!-- ROW 1 -->
                    <div class="row" id="row-1">

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>
                                    Data
                                </label>
                                <input type="date" name="data" id="data" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>
                                    Hora
                                </label>
                                <input type="text" name="hora" id="hora" class="form-control" required placeholder="00:00">
                            </div>
                        </div>



                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>
                                    Suspeitos
                                </label>
                                <input type="text" name="suspeitos" id="suspeitos" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>
                                    Confirmados
                                </label>
                                <input type="text" name="confirmados" id="confirmados" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>
                                    Descartados
                                </label>
                                <input type="text" name="descartados" id="descartados" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>
                                    Internados
                                </label>
                                <input type="text" name="internados" id="internados" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>
                                    Óbitos
                                </label>
                                <input type="text" name="obitos" id="obitos" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>
                                    Curados
                                </label>
                                <input type="text" name="curados" id="curados" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>
                                    Notificados
                                </label>
                                <input type="text" name="notificados" id="notificados" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>
                                    Isolamento
                                </label>
                                <input type="text" name="isolamento" id="isolamento" class="form-control" required>
                            </div>
                        </div>

                    </div>

                </form>
                <!-- BOTÕES DA ABA CADASTRO -->
                <hr>

                <div class="d-flex justify-content-between">
                    <div>

                    </div>
                    <div class="d-flex" id="botoes-foot">
                        <a href="../boletim-epidemiologico/" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                        <button type="button" class="btn btn-success  btn-sm" data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert()" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar&emsp;&emsp;</button>
                        <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Alterações</button>
                    </div>
                </div>

            </div>


        </div><!-- .tab-content -->

    </div><!-- .col-md-12 -->
    <br />
</main> <!-- .col-md-10 -->