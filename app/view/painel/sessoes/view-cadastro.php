<main class="col-md-10">

    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
            <div class="col-md-11" >
                <span class="span-30" style="color: gray"><i class="fa fa-balance-scale"></i> Sessões </span>
            </div>
            <div class="col-md-1 p-0"> 
                <a href="cadastro.php">
                    <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
                </a>
            </div>
        </div>
    </section>

    <section>
        <div>     
            <div class="col-md-12  reset">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-1">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-2">Presença</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-3">Arquivos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-4">Matérias/Votação</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content bg-white border border-top-0">

                    <div class="tab-pane active" id="tab-1" style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-balance-scale"></i> <i><b>Dados da Sessão</b></i>
                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <img class="loading" src="../img/loading-sm.svg" style="display: none">                                      
                                </div>
                            </div>
                        </div>

                        <form id="tab-1-form-1" enctype="multipart/form-data">
                            <div>
                                <input type="hidden" name="tbl" id="tbl" value="sessoes">
                                <input type="hidden" value="<?php echo date("Y/m/d h:i:s") ?>" name="data_cadastro" id="data_cadastro">                              

                                <div class="row"> 
                                    
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label><i class="fa fa-filter"></i> Tipo de Sessão<span id="asterisco" style="color:#F00">*</span> </label>
                                            <select name="tipo" id="tipo" class="form-control">
                                                <option value="">Selecione um tipo</option>
                                                <option  value='Ordinaria'>Ordinária</option>
                                                <option  value='Extra-Ordinaria'>Extra-Ordinária</option>
                                                <option  value='Audiencia Pública'>Audiência Pública</option>
                                                <option  value='Solene'>Solene</option>
                                                <option  value='Abertura de período legislativo'>Abertura de período legislativo</option>
                                                <option  value='Encerramento de período legislativo'>Encerramento de período legislativo</option>
                                                <option  value='Intinerante'>Intinerante</option>
                                                <option  value='Sessao administrativa'>Sessão administrativa</option>
                                                <option  value='Sessão especial'>Sessão especial</option>
                                                <option  value='Posse'>Posse</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="form-group mb-3">
                                            <label>
                                                Nome<span id="asterisco" style="color:#F00">*</span> 
                                            </label>
                                            <input type="text" name="nome" id="nome" class="form-control"   required>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group mb-3">
                                            <label>
                                                Numero<span id="asterisco" style="color:#F00">*</span> 
                                            </label>
                                            <input type="text" name="numero" id="numero" class="form-control"   required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label>
                                                Data<span id="asterisco" style="color:#F00">*</span> 
                                            </label>
                                            <input type="date" name="data" id="data" class="form-control"   required>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group mb-3">
                                            <label>
                                                Exercício<span id="asterisco" style="color:#F00">*</span> 
                                            </label>
                                            <input type="text" name="exercicio" id="exercicio" class="form-control"   required>
                                        </div>
                                    </div>



                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label><i class="fa fa-filter"></i> Situação<span id="asterisco" style="color:#F00">*</span> </label>
                                            <select name="situacao" id="situacao" class="form-control">
                                                <option value="">Selecione situação</option>
                                                <option  value='Aberta'>Aberta</option>
                                                <option  value='Encerrada'>Encerrada</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="form-group mb-3">
                                            <label><i class="fa fa-filter"></i> Legislatura <span id="asterisco" style="color:#F00">*</span> </label>
                                            <select  name="id_mandatos" id="id_mandatos" class="form-control">
                                                <option  value='0'></option>
                                                <optgroup id="optGroupmandatos" label="Legislatura">

                                                </optgroup>
                                            </select>                        
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">	
                                            <label><i class="fa fa-pencil"></i> Resumo</label>
                                            <textarea type="text" name="descricao" class="form-control" id="descricao"   rows="4" value=""  ></textarea>
                                        </div>
                                    </div>

                                </div><!-- .row  -->

                            </div>
                        </form>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <div class="d-flex" id="botoes-foot">
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-success  btn-sm mr-2"  id="tab-1-btn-salvar" onclick="insert('form_insert')" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true" ></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div>

                    <!-- ABA DETALHE  -->
                    <div class="tab-pane fade" id="tab-2" style="padding: 20px;">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-balance-scale"></i> <i><b>Membros da Sessão</b></i>
                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <img class="loading" src="../img/loading-sm.svg" style="display: none">                                   
                                </div>
                            </div>
                        </div>
                    
                        <form id="tab-2-form-1" enctype="multipart/form-data">
                            <input type="hidden" value="sessoes_membros" name="tbl" id="tbl">                              
                            <input type="hidden" value="<?php echo date("Y/m/d h:i:s") ?>" name="data_cadastro" id="data_cadastro">                              
                            <!-- ROW 1 -->
                            <div class="row">

                                <div class="col-md-1">
                                    <div class="form-group mb-3">
                                        <label>
                                            Cod.
                                        </label>
                                        <input type="text" class="form-control"  name="id_sessoes" id="relacionamento" readonly="true">
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group mb-3">
                                        <label><i class="fa fa-filter"></i> Parlamentar</label>
                                        <select  name="id_servidor" id="id_servidor" class="form-control">
                                            <option  value='0'></option>
                                            <optgroup id="optGroupservidor" label="Servidor">

                                            </optgroup>
                                        </select>                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label><i class="fa fa-filter"></i> Presente</label>
                                        <select  name="presente" id="presente" class="form-control">
                                            <optgroup label="Presente">
                                                <option  value='S'>Sim</option>
                                                <option  value='N'>Não</option>
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
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2" id="tab-2-btn-voltar"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-danger btn-sm mr-2" id="tab-2-btn-cancelar" style="display: none;"><i class="fa fa-undo"></i> Cancelar</button>
                                <button type="button" class="btn btn-success  btn-sm"  id="tab-2-btn-salvar" style="display: block;" onclick="insertTab2Form1()" >&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm"  id="tab-2-btn-salvar-alteracoes"  style="display: none;" onclick="" ><i class="fa fa-floppy-o" ></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div><!-- fim tab-detalhe -->

                    <!-- ABA ARQUIVOS  -->
                    <div class="tab-pane fade" id="tab-3" style="padding: 20px;">                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-file-text"></i> <i><b>Arquivos da Sessão</b></i>
                                </div>
                            </div>
                        </div>


                        <form id="search-arquivos">
                            <input type="hidden" name="id_tabela_pai"  id="id-tabela-pai-form-search-arquivos" value="">

                            <div class="row" id="row-1">
                                <div class="col-md-5">
                                    <div class="input-group  mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                        </div>
                                        <input type="text" name="c1"  id="c1" class="form-control" placeholder="Nome">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group  mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                        </div>
                                        <input type="date" name="c2"  id="c2" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group  mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                        </div>
                                        <input type="date" name="c3"  id="c3" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="input-group  mb-3">
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
                        <div class="d-flex justify-content-end">
                            
                            <div>
                                <a href="index.php">
                                    <button type="button" class="btn btn-secondary btn-sm" id="tab-4-btn-voltar" >
                                        <i class="fa fa-undo"></i> 
                                        Voltar
                                    </button>
                                </a>
                            </div>

                            <div class="ml-2" id="botoes-foot-tab-3">
                                <button type="button" class="btn btn-sm btn-info" id="tab-3-btn-show-modal-upload">
                                    <i class="fa fa-cloud-upload"></i> 
                                    Enviar Arquivos
                                </button> 
                            </div>

                        </div>

                    </div><!-- fim tab-ARQUIVOS -->

                    <!-- ABA -->
                    <div class="tab-pane fade" id="tab-4" style="padding: 20px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-users"></i> <i><b>Matérias/Votação</b></i>
                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <img class="loading" src="../img/loading-sm.svg" style="display: none">                                    
                                </div>
                            </div>
                        </div>
                        <form id="tab-4-form-1">

                            <!-- ROW 1 -->
                            <div class="row">

                                <div class="col-md-1">
                                    <div class="form-group form-group mb-3">
                                        <label>
                                            Cod.
                                        </label>
                                        <input type="text" class="form-control relacionamento"  name="id_sessoes" readonly="true">
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group form-group mb-3">
                                        <label><i class="fa fa-filter"></i> Matéria<span id="asterisco" style="color:#F00">*</span> </label>
                                        <select  name="id_materias" id="id_materias" class="form-control">
                                            <option  value='0'></option>
                                            <optgroup id="optGroupmaterias" label="Matérias">

                                            </optgroup>
                                        </select>                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="input-group  mb-3">
                                        <label><i class="fa fa-filter"></i> Ordem para apreciação<span id="asterisco" style="color:#F00">*</span> </label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <B>Nº</B></span>
                                        </div>
                                        <input type="text" name="ordem"  id="ordem" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </form>               
                        <hr/>
                        <table class="table table-hover table-bordered table-striped table-sm" style="width: 100%">
                            <thead id="tab-4-thead-1">
                                <tr>
                                    <th>Cod</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="tab-4-tbody-1">

                            </tbody>
                        </table>
                        <div id="tab-4-echos-1"></div>

                        <hr>
                        <!-- BOTÕES ABA MATERIAS/VOTACAO -->
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end" id="botoes-foot">
                                <a href="index.php" class="btn btn-secondary btn-sm" id="tab-4-btn-voltar"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-danger btn-sm ml-2" id="tab-4-btn-cancelar" style="display: none;"><i class="fa fa-undo"></i> Cancelar</button>
                                <button type="button" class="btn btn-success  btn-sm ml-2"  id="tab-4-btn-salvar" style="display: block;" onclick="insertTab4Form1()" >&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm ml-2"  id="tab-4-btn-salvar-alteracoes"  style="display: none;" onclick="" ><i class="fa fa-floppy-o" ></i> Salvar Alterações</button>
                            </div>
                        </div>
                    </div><!-- fim tab-2 -->

                </div><!-- tab-content -->
            </div><!-- bgwhite -->
        </div><!-- .row -->
    </section>

</main>


