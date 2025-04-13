<main class="col-md-10">

    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-11">
                <span class="span-30" style="color: gray"><i class="fa fa-file-text"></i> Processo Seletivo </span>
            </div>
            <div class="col-md-1 p-0">
                <a href="cadastro.php">
                    <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
                </a>
            </div>
        </div>
    </section>

    <section>
        <div class="col-md-12  reset">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-1">Cadastro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-2">Fases</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-4">Arquivos</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content bg-white border border-top-0">
                <div class="tab-pane active" id="tab-1" style="padding: 20px;">

                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-file-text"></i> <i><b>Dados do Processo Seletivo</b></i>
                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <img class="loading" src="../img/loading-sm.svg" style="display: none">
                                </div>
                            </div>
                        </div>

                        <form id="tab-1-form-1">
                            <div class="bg-white">
                                <input type="hidden" value="processo_seletivo" name="tbl" id="tbl">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><i class="fa fa-filter"></i> Órgão </label>
                                            <select class="form-control" name="id_entidade_orgaos" id="id_entidade_orgaos">
                                                <option value='0'></option>
                                                <optgroup id="optGroupentidade_orgaos" label="Órgão">

                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><i class="fa fa-filter"></i> Legislatura/Gestão</label>
                                            <select class="form-control" name="id_mandatos" id="id_mandatos">
                                                <option value='0'></option>
                                                <optgroup id="optGroupmandatos" label="Mandato/Gestão">

                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><i class="fa fa-filter"></i> Tipo</label>
                                            <select name="tipo" id="tipo" class="form-control">
                                                <optgroup label="Concurso Público">
                                                    <option value='EDITAL DE CONCURSO PÚBLICO'>EDITAL DE CONCURSO PÚBLICO</option>
                                                    <option value='HOMOLOGAÇÃO DAS INSCRIÇÕES PARA CANDIDATOS COM DEFICIÊNCIA'>HOMOLOGAÇÃO DAS INSCRIÇÕES PARA CANDIDATOS COM DEFICIÊNCIA</option>
                                                    <option value='LOCAIS PROVAS - CONCURSO'>LOCAIS PROVAS - CONCURSO</option>
                                                    <option value='GABARITO PRELIMINAR'>GABARITO PRELIMINAR</option>
                                                    <option value='RECURSO - PROVA OBJETIVA'>RECURSO - PROVA OBJETIVA</option>
                                                    <option value='OMUNICADO RESULTADOS DOS RECURSOS'>COMUNICADO RESULTADOS DOS RECURSOS</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label> Titulo</label>
                                            <input type="text" name="titulo" class="form-control" id="titulo" value="" />
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label><i class="fa fa-calendar"></i> Data</label>
                                            <input type="date" name="data_publicacao" class="form-control" id="data_publicacao" />
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Exercício</label>
                                            <input type="text" name=exercicio class="form-control" id="exercicio" value="" />
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Descrição</label>
                                            <textarea name="descricao" class="form-control" id="descricao" value="" rows="4"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </form>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <div class="d-flex" id="botoes-foot">
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-success  btn-sm mr-2" data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert('form_insert')" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div>

                    <!-- ABA FASES  -->
                    <div class="tab-pane fade" id="tab-2" style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-file-text"></i> <i><b>Fases do Processo Seletivo</b></i>
                                </div>
                            </div>
                        </div>

                        <form id="tab-2-form-1">
                            <input type="hidden" value="licitacoes_fases" name="tbl" id="tbl">
                            <!-- ROW 1 -->
                            <div class="row">

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>
                                            Cod.
                                        </label>
                                        <input type="text" class="form-control" name="id_processo_seletivo" id="relacionamento" readonly="true">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>
                                            Fase <span id="asterisco" style="color:#F00">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="fase" id="fase">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>
                                            <i class="fa fa-calendar"></i> Data <span id="asterisco" style="color:#F00">*</span>
                                        </label>
                                        <input type="date" class="form-control" name="data_fase" id="data_fase">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>
                                            Hora <span id="asterisco" style="color:#F00">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="hora_fase" id="hora_fase">
                                    </div>
                                </div>


                            </div>

                        </form>

                        <hr />

                        <table class="table table-hover table-bordered table-striped table-sm" style="width: 100%">
                            <thead id="tab-2-thead-1">
                                <tr>
                                    <th>Cod</th>
                                    <th>FASE</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tab-2-tbody-1">

                            </tbody>
                        </table>
                        <div id="tab-2-echos-1"></div>

                        <hr>
                        <!-- BOTÕES ABA DETALHE -->
                        <div class="d-flex justify-content-end">                                
                            <div class="d-flex" id="botoes-foot-tab-2">
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2" id="tab-2-btn-voltar"><i class="fa fa-undo"></i> Voltar</button></a>  
                                <button type="button" class="btn btn-danger btn-sm mr-2" id="tab-2-btn-cancelar" style="display: none;"><i class="fa fa-undo"></i> Cancelar</button>
                                <button type="button" class="btn btn-success  btn-sm" id="tab-2-btn-salvar" style="display: block;" onclick="insertTab2Form1()">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm" id="tab-2-btn-salvar-alteracoes" style="display: none;" onclick=""><i class="fa fa-floppy-o"></i> Salvar Alterações</button>
                            </div>
                        </div>
                    </div><!-- fim tab-2 -->

                    <!-- ABA ARQUIVOS  -->
                    <div class="tab-pane fade" id="tab-4" style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-file-text"></i> <i><b>Arquivos do Processo Seletivo</b></i>
                                </div>
                            </div>
                        </div>

                        <form id="search-arquivos">
                            <input type="hidden" name="id_tabela_pai" id="id-tabela-pai-form-search-arquivos" value="">

                            <div class="row" id="row-1">
                                <div class="col-md-5">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                        </div>
                                        <input type="text" name="c1" id="c1" class="form-control" placeholder="Nome">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                        </div>
                                        <input type="date" name="c2" id="c2" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                        </div>
                                        <input type="date" name="c3" id="c3" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="input-group  input-group-sm mb-3">
                                        <button type="button" class="btn btn-secondary btn-sm" id="pesquisar-arquivos">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <table class="table table-hover table-bordered table-striped">
                            <thead id='thead-arquivos'>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id='tbody-arquivos'>

                            </tbody>
                        </table>
                        <div id="echos-arquivos"></div>
                        <hr />
                        <div class="d-flex justify-content-end">
                            <div class="d-flex" id="botoes-foot-tab-2">
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2" id="tab-4-btn-voltar"><i class="fa fa-undo"></i> Voltar</button></a>
                                <button type="button" class="btn btn-sm btn-info" id="tab-3-btn-show-modal-upload"><i class="fa fa-cloud-upload"></i> Enviar Arquivos</button>
                            </div>
                        </div>

                    </div><!-- fim tab-3 -->


                </div><!-- tab-content -->
            </div><!-- bgwhite -->
    </section>

</main>