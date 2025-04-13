
<main class="col-md-10">

    <section>
        <div class="row mb-4 pr-4" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
            <div class="col-md-11" >
                <span class="span-30" style="color: gray"><i class="fa fa-file-text"></i> Matérias </span>
            </div>
            <div class="col-md-1 p-0"> 
                <a href="cadastro.php">
                    <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
                </a>
            </div>
        </div>
    </section>

    <section>
        <div class="row">     
            <div class="col-md-12">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-1">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-2">Autores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-3">Tramitação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-4">Arquivos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-5">Votação</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content bg-white border border-top-0">

                    <div class="tab-pane active" id="tab-1" style="padding: 20px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-file-text"></i> <i><b>Dados da Matéria</b></i>
                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <img class="loading" src="../img/loading-sm.svg" style="display: none">
                                </div>
                            </div>
                        </div>

                        <form id="tab-1-form-1">
                            <input type="hidden" value="materias" name="tbl" id="tbl">	
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group form-group mb-3">	
                                        <label><i class="fa fa-filter"></i> Tipo<span id="asterisco" style="color:#F00">*</span> </label>
                                        <select name="tipo" id="tipo" class="form-control">
                                            <option value=''></option>
                                            <optgroup id="tipo_materia" label="Tipo">
                                                 <option value="Comunicado">Comunicado</option>
                                                <option value="Convênio">Convênio</option>
                                                <option value="Emenda">Emenda</option>
                                                <option value="Expediente apresentado pelos Vereadores">Expediente apresentado pelos Vereadores</option>
                                                <option value="Expediente Recebido do Prefeito">Expediente Recebido do Prefeito</option>
                                                <option value="Expediente Recebidos de Diversos">Expediente Recebidos de Diversos</option>
                                                <option value="Indicação">Indicação</option>
                                                <option value="Moção de Congratulações">Moção de Congratulações</option>
                                                <option value="Moção de Pesar">Moção de Pesar</option>
                                                <option value="Oficios Expedidos">Oficios Expedidos</option>
                                                <option value="Oficios Recebidos">Oficios Recebidos</option>
                                                <option value="Projeto de Decreto Legislativo">Projeto de Decreto Legislativo</option>
                                                <option value="Projeto de indicacao">Projeto de indicacao</option>
                                                <option value="Projeto de Lei - Executivo">Projeto de Lei - Executivo</option>
                                                <option value="Projeto de Lei - Legislativo">Projeto de Lei - Legislativo</option>
                                                <option value="Projeto de Resolução">Projeto de Resolução</option>
                                                <option value="Requerimento">Requerimento</option>
                                                <option value="Resolução">Resolução</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                 
                                <div class="col-md-2">
                                    <div class="form-group form-group mb-3">
                                        <label>Número<span id="asterisco" style="color:#F00">*</span> </label>	
                                        <input type="text" name="numero" id="numero" class="form-control" placeholder="Número" value="" />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group form-group mb-3">	
                                        <label>Exercício<span id="asterisco" style="color:#F00">*</span> </label>
                                        <input type="text" name="exercicio" id="exercicio" class="form-control" placeholder="Exercício" value=""/>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group form-group mb-3">
                                        <label><i class="fa fa-calendar"></i> Data<span id="asterisco" style="color:#F00">*</span> </label>	
                                        <input type="date" name="data" id="data" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group form-group mb-3">
                                        <label><i class="fa fa-filter"></i>Situação</label>
                                        <select name="situacao" id="situacao" class="form-control">
                                            <optgroup  label="Situação">
                                                <option  value='Aberta'>Aberta</option>
                                                <option  value='Fechada'>Fechada</option>
                                                <option  value='Cancelada'>Cancelada</option>
                                                <option  value='Aprovada'>Aprovada</option>
                                                <option  value='Desaprovada'>Desaprovada</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">	
                                        <label><i class="fa fa-pencil"></i> Descrição<span id="asterisco" style="color:#F00">*</span> </label>
                                        <textarea type="text" name="descricao" id="descricao" class="form-control"    rows="5" value=""  ></textarea>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <hr>

                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end">
                                <a href="index.php" class="btn btn-secondary btn-sm"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-success  btn-sm ml-2"  data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert('form_insert')" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm ml-2" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true" ></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div>

                    <!-- ABA -->
                    <div class="tab-pane fade" id="tab-2" style="padding: 20px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-users"></i> <i><b>Autores da Matéria</b></i>
                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <img class="loading" src="../img/loading-sm.svg" style="display: none">                                    
                                </div>
                            </div>
                        </div>
                        <form id="tab-2-form-1">
                            <input type="hidden" value="materias_autores" name="tbl" id="tbl">                              
                            <!-- ROW 1 -->
                            <div class="row">

                                <div class="col-md-1">
                                    <div class="form-group form-group mb-3">
                                        <label>
                                            Cod.
                                        </label>
                                        <input type="text" class="form-control"  name="id_materias" id="relacionamento" readonly="true">
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group form-group mb-3">
                                        <label><i class="fa fa-filter"></i> Servidor<span id="asterisco" style="color:#F00">*</span> </label>
                                        <select  name="id_servidor" id="id_servidor" class="form-control">
                                            <option  value='0'></option>
                                            <optgroup id="optGroupservidor" label="Servidor">

                                            </optgroup>
                                        </select>                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group form-group mb-3">
                                        <label><i class="fa fa-filter"></i> Autor/Subescritor<span id="asterisco" style="color:#F00">*</span> </label>
                                        <select  name="autor_subescritor" id="autor_subescritor" class="form-control">
                                            <option  value='0'></option>
                                            <optgroup  label="Autor/Subescritor">
                                                <option value="Autor">Autor</option>
                                                <option value="Subescritor">Subescritor</option>
                                            </optgroup>
                                        </select>                        
                                    </div>
                                </div>

                            </div>

                        </form>               

                        <hr/>

                        <table class="table table-hover table-bordered table-striped table-sm" style="width: 100%">
                            <thead id="tab-2-thead-1">
                                <tr>
                                    <th>Cod</th>
                                    <th>Nome</th>
                                    <th>Autor/Subescritor</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tab-2-tbody-1">

                            </tbody>
                        </table>
                        <div id="tab-2-echos-1"></div>

                        <hr>
                        <!-- BOTÕES ABA DETALHE -->
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end" id="botoes-foot">
                                <a href="index.php" class="btn btn-secondary btn-sm" id="tab-2-btn-voltar"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-danger btn-sm ml-2" id="tab-2-btn-cancelar" style="display: none;"><i class="fa fa-undo"></i> Cancelar</button>
                                <button type="button" class="btn btn-success  btn-sm ml-2"  id="tab-2-btn-salvar" style="display: block;" onclick="insertTab2Form1()" >&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm ml-2"  id="tab-2-btn-salvar-alteracoes"  style="display: none;" onclick="" ><i class="fa fa-floppy-o" ></i> Salvar Alterações</button>
                            </div>
                        </div>
                    </div><!-- fim tab-2 -->


                    <!-- ABA FASES  -->
                    <div class="tab-pane  fade" id="tab-3" style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-file-text"></i> <i><b>Tramitação da Matéria</b></i>
                                </div>
                            </div>
                        </div>


                        <form id="tab-3-form-1">
                            <input type="hidden" value="materias_fases" name="tbl" id="tbl">                              
                            <!-- ROW 1 -->
                            <div class="row">

                                <div class="col-md-1">
                                    <div class="form-group form-group mb-3">
                                        <label>
                                            Cod.
                                        </label>
                                        <input type="text" class="form-control"  name="id_materias" id="tab_3_form_1_relacionamento" readonly="true">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group form-group mb-3">
                                        <label><i class="fa fa-filter"></i> Fase<span id="asterisco" style="color:#F00">*</span> </label>
                                        <select  name="fase" id="fase" class="form-control">
                                            <optgroup  label="Fases">
                                                <option value="Apresentado">Apresentado</option>
                                                <option value="Iniciativa">Iniciativa</option>
                                                <option value="Discussão">Discussão</option>
                                                <option value="Deliberação(Votação)">Deliberação(Votação)</option>
                                                <option value="Sansão ou Veto">Sansão ou Veto</option>
                                                <option value="Promulgação">Promulgação</option>
                                                <option value="Publicação">Publicação</option>
                                            </optgroup>
                                        </select>                        
                                    </div>
                                </div>

                                <!--
                                <div class="col-md-3">
                                    <div class="form-group form-group mb-3">
                                        <label><i class="fa fa-filter"></i>Situação</label>
                                        <select name="situacao" id="situacao" class="form-control">
                                            <optgroup  label="Situação">
                                                <option  value='Aberta'>Aberta</option>
                                                <option  value='Fechada'>Fechada</option>
                                                <option  value='Cancelada'>Cancelada</option>
                                                <option  value='Aprovada'>Aprovada</option>
                                                <option  value='Desaprovada'>Desaprovada</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div> -->

                                <div class="col-md-2">
                                    <div class="form-group form-group mb-3">
                                        <label>
                                            <i class="fa fa-calendar"></i> Data <span id="asterisco" style="color:#F00">*</span> 
                                        </label>
                                        <input type="date" class="form-control" name="data_fase" id="data_fase" >
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group form-group mb-3">
                                        <label>
                                            Hora 
                                        </label>
                                        <input type="text" class="form-control" name="hora_fase" id="hora_fase" >
                                    </div>
                                </div>  
                                
                                <div class="col-md-12">
                                    <div class="form-group">	
                                        <label><i class="fa fa-pencil"></i> Descrição<span id="asterisco" style="color:#F00">*</span> </label>
                                        <textarea type="text" name="descricao" id="descricao" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>

                            </div>

                        </form>               

                        <hr/>

                        <table class="table table-hover table-bordered table-striped table-sm" style="width: 100%">
                            <thead id="tab-3-thead-1">
                                <tr>
                                    <th>Cod</th>
                                    <th>Fase</th>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tab-3-tbody-1">

                            </tbody>
                        </table>
                        <div id="tab-3-echos-1"></div>

                        <hr>
                        <!-- BOTÕES ABA DETALHE -->
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end"  id="botoes-foot">
                                <a href="index.php" class="btn btn-secondary btn-sm" id="tab-3-btn-voltar"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-danger btn-sm ml-2" id="tab-3-btn-cancelar" style="display: none;"><i class="fa fa-undo"></i> Cancelar</button>
                                <button type="button" class="btn btn-success  btn-sm ml-2"  id="tab-3-btn-salvar" style="display: block;" onclick="insertTab3Form1()" >&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm ml-2"  id="tab-3-btn-salvar-alteracoes"  style="display: none;" onclick="" ><i class="fa fa-floppy-o" ></i> Salvar Alterações</button>
                            </div>
                        </div>
                    </div><!-- fim tab-3 -->


                    <!-- ABA FASES  -->
                    <div class="tab-pane fade" id="tab-4" style="padding: 20px;">                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-file-text"></i> <i><b>Arquivos da Matéria</b></i>
                                </div>
                            </div>
                        </div>


                        <form id="search-arquivos">
                            <input type="hidden" name="id_tabela_pai"  id="id-tabela-pai-form-search-arquivos" value="">

                            <div class="row" id="row-1">
                                <div class="col-md-5">
                                    <div class="input-group  form-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                        </div>
                                        <input type="text" name="c1"  id="c1" class="form-control" placeholder="Nome">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group  form-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                        </div>
                                        <input type="date" name="c2"  id="c2" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group  form-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                        </div>
                                        <input type="date" name="c3"  id="c3" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="input-group  form-group mb-3">
                                        <button type="button" class="btn btn-secondary btn-sm" id="pesquisar-arquivos" >
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
                        <hr/>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end">
                                <a href="index.php" class="btn btn-secondary btn-sm ml-2" id="tab-4-btn-voltar"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-sm btn-info ml-2" id="tab-4-btn-show-modal-upload"><i class="fa fa-cloud-upload"></i> Enviar Arquivos</button> 
                            </div>
                        </div>

                    </div><!-- fim tab-4 -->

                    <div class="tab-pane fade" id="tab-5" style="padding: 20px;">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-balance-scale"></i> <i><b>Votação</b></i>
                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <img class="loading" src="../img/loading-sm.svg" style="display: none">
                                </div>
                            </div>
                        </div>
                    
                        <form id="tab-5-form-1" enctype="multipart/form-data">                              
                            <!-- ROW 1 -->
                            <div class="row">

                                <div class="col-md-1">
                                    <div class="form-group mb-3">
                                        <label>
                                            Cod.
                                        </label>
                                        <input type="text" class="form-control id"  name="id_materias" id="tab_5_form_1_relacionamento" readonly="true">
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="form-group mb-3">
                                        <label><i class="fa fa-filter"></i> Parlamentar</label>
                                        <select  name="id_servidor" id="id_servidor" class="form-control id_servidor">
                                            <option  value='0'></option>
                                            <optgroup id="optGroupservidor" class="optGroupservidor" label="Servidor">

                                            </optgroup>
                                        </select>                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label><i class="fa fa-filter"></i> Voto</label>
                                        <select  name="voto" id="voto" class="form-control">
                                            <optgroup label="Voto">
                                                <option  value='S'>Sim</option>
                                                <option  value='N'>Não</option>
                                            </optgroup>
                                        </select>                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label> &emsp;</label><br/>
                                        <button type="button" class="btn btn-success "  id="tab-5-btn-salvar" style="display: block;" onclick="insertTab5Form1()" >&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>                
                                    </div>
                                </div>

                            </div>

                        </form>               

                        <hr/>

                        <table class="table table-hover table-bordered table-striped table-sm" style="width: 100%">
                            <thead id="tab-5-thead-1">
                                <tr>
                                    <th>Cod</th>
                                    <th>Nome</th>                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tab-5-tbody-1">

                            </tbody>
                        </table>
                        <div id="tab-5-echos-1"></div>

                        <hr>
                        <!-- BOTÕES ABA VOTAÇÕES -->
                        <div class="d-flex justify-content-end">
                            <div class="d-flex" id="botoes-foot-tab-2">
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2" id="tab-5-btn-voltar"><i class="fa fa-undo"></i> Voltar</a>
                            </div>
                        </div>

                    </div><!-- fim tab-votações -->

                </div><!-- tab-content -->
            </div><!-- bgwhite -->
        </div><!-- .row -->
    </section>

</main>


