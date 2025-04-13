<main class="col-md-10">

    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-11">
            <span class="span-30" style="color: gray"><i class="fa fa-users"></i> Pessoal e Folha de Pagamento </span>
            </div>
            <div class="col-md-1 p-0">
                <a href="cadastro.php">
                    <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
                </a>
            </div>
        </div>
    </section>

    <section>
        <div class="col-md-12 reset">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-1">Cadastro</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content bg-white border border-top-0">

                <div class="tab-pane active" id="tab-1" style="padding: 20px;">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-light border d-flex align-items-center" role="alert">
                                <i class="fa fa-users"></i> &nbsp;<i><b>Importação de Informações Pessoais</b></i>
                                &nbsp;
                                <div id="js-messages"></div>
                            </div>
                        </div>
                    </div>

                    <form id="tab-1-form-1"  enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-1">
                                <div class="form-group mb-3">
                                    <label> Mês <small>01, 02...</small></label>
                                    <input type="text" name="mes" id="mes" class="form-control" value="" maxlength="2" minlength="2"/>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group mb-3">
                                    <label> Ano</label>
                                    <input type="text" name="ano" id="ano" class="form-control" value="" maxlength="4" minlength="4"/>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><i class="fa fa-filter"></i> Tipo de Arquivo</label>
                                    <select class="form-control form-control-md" id="tipo_arquivo" name="tipo_arquivo">
                                        <option value="manad">Arquivo Manad (Padrão)</option>
                                        <option value="terceiros">Arquivo de Terceiros</option>
                                    </select>                        
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><i class="fa fa-filter"></i> Tipo Folha</label>
                                    <select class="form-control form-control-md" id="tipo_folha" name="tipo_folha">
                                        <option value="N">Normal</option>
                                        <option value="C">Complementar</option>
                                        <option value="D">Décimo Terceiro</option>
                                    </select>             
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                  <label for="exampleFormControlFile1">Arquivo de Texto</label>
                                  <input type="file" class="form-control-file" name="arquivo" id="arquivo">
                                </div>
                            </div>   

                        </div>
                    </form>

                    <hr>

                    <div class="d-flex justify-content-end align-items-center">
                        <div class="mr-2">
                            <a href="index.php"><button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-undo"></i> Voltar</button></a>
                        </div>
                        <div id="botoes-foot">
                            <button type="button" class="btn btn-success  btn-sm" data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert('tab-1-form-1')" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                            <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" style="display: none;" onclick=""><i class="fa fa-floppy-o"></i> Salvar Alterações</button>
                        </div>
                    </div>

                </div>

            </div><!-- tab-content -->
        </div><!-- bgwhite -->
    </section>




</main>