<main class="col-md-10">

    <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
        <div class="col-md-11" >
            <span class="span-30" style="color: gray"><i class="fa fa-users"></i> Plano de Contratação Anual </span>
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
                <a class="nav-link active" data-toggle="tab" href="#tab-1">Cadastro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-2">Arquivos</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content bg-white border border-top-0">

            <div class="tab-pane active" id="tab-1" style="padding: 20px;">

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-file-text-o"></i> <i><b>Dados do Planoo</b></i>
                            &emsp;
                            <span id="tab_1_alerts"></span>
                            <img class="loading" src="../img/loading-sm.svg" style="display: none">
                        </div>
                    </div>
                </div>

                <!-- FORMULARIO DE CADASTO AQUI-->
                <form id="tab-1-form-1">
                    <div>	
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fa fa-filter"></i> Gestão/Legislatura</label>
                                    <select  class="form-control" name="id_mandatos" id="id_mandatos">
                                        <option  value='0'></option>
                                        <optgroup id="optGroupmandatos" label="Gestão/Legislatura">

                                        </optgroup>
                                    </select>                        
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fa fa-filter"></i> Órgão </label>
                                    <select  class="form-control" name="id_entidade_orgaos" id="id_entidade_orgaos">
                                        <option  value='0'></option>
                                        <optgroup id="optGroupentidade_orgaos" label="Órgão">

                                        </optgroup>
                                    </select>                        
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">	
                                    <label> Nome</label>
                                    <input type="text" name="nome" class="form-control" id="nome" value=""  />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">	
                                    <label>Exercício</label>
                                    <input type="text" name=exercicio class="form-control" id="exercicio" value=""  />
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><i class="fa fa-calendar"></i> Data</label>	
                                    <input type="date" name="data" class="form-control" id="data" />
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">	
                                    <label> Descrição</label>
                                    <textarea  name="descricao" class="form-control" id="descricao" value="" rows="4"></textarea>
                                </div>
                            </div> 

                        </div>
                    </div>

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

            <!-- ABA ARQUIVOS -->
            <div class="tab-pane fade" id="tab-2" style="padding: 20px;">
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-file-text-o"></i> <i><b>Arquivos da Publicação</b></i>
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
                        <a href="index.php" class="btn btn-secondary btn-sm mr-2" id="tab-2-btn-voltar"><i class="fa fa-undo"></i> Voltar</button></a>
                        <button type="button" class="btn btn-sm btn-info" id="tab-2-btn-show-modal-upload"><i class="fa fa-cloud-upload"></i> Enviar Arquivos</button> 
                    </div>
                </div>

            </div><!-- FIM DA ABA ARQUIVOS -->
        </div><!-- .tab-content -->

    </div><!-- .col-md-12 -->
    <br/>
</main> <!-- .col-md-10 -->