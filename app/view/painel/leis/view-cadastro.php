<main class="col-md-10">
    <section>
        <div class="row mb-4 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
            <div class="col-md-11" >
                <span class="span-30" style="color: gray"><i class="fa fa-file-text-o"></i> Leis </span>
            </div>
            <div class="col-md-1 p-0"> 
                <a href="cadastro.php" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</a>
            </div>
        </div>
    </section>    


    <div class="col-md-12  reset">
        
        <section>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-1">Cadastro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-2" id="aba_arquivos">Arquivos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-3" id="aba_leis_alteradas">Leis Alteradas</a>
                </li>
            </ul>
        </section>

        <div class="tab-content bg-white border border-top-0">

            <div class="tab-pane active" id="tab-1" style="padding: 20px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-laptop"></i> <i><b>Dados da Lei</b></i>
                            &emsp;
                            <span id="tab_1_alerts"></span>
                            <img class="loading" src="../img/loading-sm.svg" style="display: none">
                        </div>
                    </div>
                </div>

                <!-- FORMULARIO DE CADASTO AQUI-->
                <form id="tab-1-form-1">
                    <input type="hidden" value="leis" name="tbl" id="tbl">	

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label><i class="fa fa-filter"></i> Tipo<span id="asterisco" style="color:#F00">*</span> </label>
                                <select id="tipo" name="tipo" class="form-control">
                                    <option  value="0"></option>
                                    <option value="Lei">Lei</option>
                                    <option value="Lei Complementar">Lei Complementar</option>
                                    <option value="Lei Orgânica">Lei Orgânica</option>
                                    <option value="Medida Provisória">Medida Provisória</option>
                                    <option value="Decreto">Decreto</option>
                                    <option value="Portaria">Portaria</option>
                                    <option value="Instrução Normativa">Instrução Normativa</option>
                                    <option value="Resolução">Resolução</option>
                                    <option value="Regimento Interno">Regimento Interno</option>
                                    <option value="Emenda Constitucional">Emenda Constitucional</option>
                                </select>                        
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <label>
                                    Numero da Lei<span id="asterisco" style="color:#F00">*</span> 
                                </label>
                                <input type="text" name="numero_lei" id="numero_lei"  class="form-control" required>
                            </div>
                        </div>

                        <!--
                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <label>
                                    Numero do Projeto
                                </label>
                                <input type="text" name="numero_projeto" id="numero_projeto"  class="form-control" required>
                            </div>
                        </div> -->

                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <label>
                                    Data da Lei<span id="asterisco" style="color:#F00">*</span> 
                                </label>
                                <input type="date" name="data_lei" id="data_lei"  class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group mb-3">
                                <label>
                                    Exercicio<span id="asterisco" style="color:#F00">*</span> 
                                </label>
                                <input type="text" name="exercicio" id="exercicio"  class="form-control" required>
                            </div>
                        </div>

                        <!-- F2 -->
                        <div class="col-md-4">
                            <label>Projeto de Lei</label>                                                       
                            <div class="d-flex" style="gap: 10px">
                                <div>
                                    <button 
                                        type="button" 
                                        class="btn btn-info" 
                                        onclick="showModal({
                                            table: 'materias', 
                                            modal_title: 'Projetos de lei',
                                            classe_elemento_recebe_codigo: 'exibe_codigo_materia',
                                            classe_elemento_exibe_descricao: 'exibe_descricao_materia',
                                        })" 
                                    >   
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                                <div class="form-group w-10" style="display: none;">
                                    <input type="text" class="form-control exibe_codigo_materia" name="id_materias" id="id_materias" readonly=“true” />
                                </div>
                                <div class="form-group w-100">
                                    <input type="text" class="form-control exibe_descricao_materia" id="materias_descricao"  readonly=“true” disabled />
                                </div>
                            </div>
                        </div><!-- FIM F2-->

                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <label>
                                    Data de Publicação<span id="asterisco" style="color:#F00">*</span> 
                                </label>
                                <input type="date" name="data_publicacao" id="data_publicacao"  class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group mb-3">
                                <label>
                                    Contra Covid-19 
                                </label>
                                <input type="checkbox" name="contra_covid" id="contra_covid"  class="form-check" required>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group mb-3">
                                <label>
                                    Titulo<span id="asterisco" style="color:#F00">*</span> 
                                </label>
                                <input type="text" name="resumo" id="resumo"  class="form-control" required>
                            </div>
                        </div>

                        
                        <div class="col-md-12">
                            <label>Descrição</label>
                            <div class="form-group">
                                <textarea name="descricao" id="descricao"  class="form-control" rows="5" cols="200"></textarea>
                            </div>
                        </div>

                    </div><!-- .row -->

                    <br/>                               
                </form>
                <!-- BOTÕES DA ABA CADASTRO -->
                <hr>
                <div class="d-flex justify-content-end">
                    <div class="d-flex" id="botoes-foot">
                        <a href="index.php" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                        <button type="button" class="btn btn-success  btn-sm mr-2"  data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert()" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar&emsp;&emsp;</button>
                        <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true" ></i> Salvar Alterações</button>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-2" style="padding: 20px; ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-laptop"></i> <i><b>Arquivos da Lei</b></i>
                        </div>
                    </div>
                </div>

                <form id="search-arquivos">
                    <input type="hidden" name="id_tabela_pai"  id="id-tabela-pai-form-search-arquivos" value="">

                    <div class="row" id="row-1">
                        <div class="col-md-5">
                            <div class="input-group  input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                </div>
                                <input type="text" name="c1"  id="c1" class="form-control" placeholder="Nome">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group  input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                </div>
                                <input type="date" name="c2"  id="c2" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group  input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                </div>
                                <input type="date" name="c3"  id="c3" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="input-group  input-group-sm mb-3">
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
                    <div class="d-flex" id="botoes-foot-tab-2">
                        <a href="index.php" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                        <button type="button" class="btn btn-sm btn-info" id="tab-2-btn-show-modal-upload"><i class="fa fa-cloud-upload"></i> Enviar Arquivos</button> 
                    </div>
                </div>

            </div>

            <div class="tab-pane  fade" id="tab-3" style="padding: 20px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-file-text"></i> <i><b>Leis Alteradas</b></i>
                        </div>
                    </div>
                </div>
                <form id="tab-3-form-1">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group form-group mb-3">
                                <label>
                                    Cod.
                                </label>
                                <input type="text" class="form-control"  name="id_lei_alteradora" id="id_lei_alteradora" readonly="true">
                            </div>
                        </div>
                        <!-- F2 -->
                        <div class="col-md-10">
                            <label>Pesquisar lei alterada </label>                                                       
                            <div class="d-flex" style="gap: 10px">
                                <div>
                                    <button 
                                        type="button" 
                                        class="btn btn-info" 
                                        onclick="showModal({
                                            table: 'leis', 
                                            modal_title: 'Leis',
                                            classe_elemento_recebe_codigo: 'exibe_codigo_leis',
                                            classe_elemento_exibe_descricao: 'exibe_descricao_leis',
                                        })" 
                                    >
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                                <div class="form-group w-10" style="display: none;">
                                    <input type="text" class="form-control exibe_codigo_leis" name="id_lei_alterada" id="id_lei_alterada" readonly=“true” />
                                </div>
                                <div class="form-group w-100">
                                    <input type="text" class="form-control exibe_descricao_leis" id="exibe_descricao"  readonly=“true” disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 p-0">
                            <label>&emsp;</label><br/>
                            <button type="button" class="btn btn-info ml-2"  id="tab-3-btn-salvar" style="display: block;" onclick="insertTab3Form1()" > Adicionar </button>
                        </div>
                    </div>
                </form>
                <hr/>
                <table class="table table-hover table-bordered table-striped table-sm" style="width: 100%">
                    <thead id="tab-3-thead-1">
                        <tr>
                            <th>Cod</th>
                            <th>Leis alteradas</th>
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
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br/>
</main>