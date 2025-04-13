
<main class="col-md-10">

    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
            <div class="col-md-11" >
                <span class="span-30" style="color: gray"> <i class="fa fa-users"></i> Comissões </span>
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
                        <a class="nav-link" data-toggle="tab" href="#tab-2">Membros</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content bg-white border border-top-0">

                    <div class="tab-pane active" id="tab-1" style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-users"></i> <i><b>Dados da Comissão</b></i>
                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <img class="loading" src="../img/loading-sm.svg" style="display: none">
                                </div>
                            </div>
                        </div>

                        <form id="tab-1-form-1" enctype="multipart/form-data">
                            <div>
                                <input type="hidden" name="tbl" id="tbl" value="comissoes">

                                <div class="row">                                               

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>
                                                Nome<span id="asterisco" style="color:#F00">*</span> 
                                            </label>
                                            <input type="text" name="nome" id="nome" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label>
                                                Sigla<span id="asterisco" style="color:#F00">*</span> 
                                            </label>
                                            <input type="text" name="sigla" id="sigla" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label><i class="fa fa-filter"></i> Legislatura</label>
                                            <select  name="legislatura" id="legislatura" class="form-control">
                                                <option  value='0'></option>
                                                <optgroup id="optGrouplegislaturas" label="Legislaturas">

                                                </optgroup>
                                            </select>                        
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label><i class="fa fa-filter"></i> Tipo de Comissao</label>
                                            <select id="tipo" name="tipo" class="form-control">
                                                <option value="0">Tipo de Comissao</option>
                                                <option  value='Permanente'>Permanente</option>
                                                <option  value='Temporaria'>Temporária</option>
                                                <option  value='Mista'>Mista</option>
                                                <option  value='Parlamentar de Inquerito'>Parlamentar de Inquerito</option>
                                                <option  value='Geral'>Geral</option>
                                            </select>                        
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">	
                                            <label><i class="fa fa-pencil"></i> Descrição</label>
                                            <textarea type="text" name="descricao" class="form-control" id="descricao"   rows="4" value=""></textarea>
                                        </div>
                                    </div>

                                </div><!-- .row  -->

                            </div>
                        </form>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <div class="d-flex" id="botoes-foot">
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2" ><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-success  btn-sm mr-2"  data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert('form_insert')" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true" ></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div>

                    <!-- ABA DETALHE  -->
                    <div class="tab-pane fade" id="tab-2" style="padding: 20px;">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-users"></i> <i><b>Membros da Comissão</b></i>
                                </div>
                            </div>
                        </div>
                    
                        <form id="tab-2-form-1" enctype="multipart/form-data">
                            <input type="hidden" value="comissoes_detalhe" name="tbl" id="tbl">                              
                            
                            <!-- ROW 1 -->
                            <div class="row">

                                <div class="col-md-1">
                                    <div class="form-group mb-3">
                                        <label>
                                            Cod.
                                        </label>
                                        <input type="text" class="form-control"  name="id_comissao" id="relacionamento" readonly="true">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label><i class="fa fa-filter"></i> Funcionário</label>
                                        <select  name="id_servidor" id="id_servidor" class="form-control">
                                            <option  value='0'></option>
                                            <optgroup id="optGroupservidor" label="Servidor">

                                            </optgroup>
                                        </select>                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label>
                                            Cargo <span id="asterisco" style="color:#F00">*</span> 
                                        </label>
                                        <input type="text" class="form-control" name="cargo" id="cargo" >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label>
                                            <i class="fa fa-calendar"></i> Data de Ingresso <span id="asterisco" style="color:#F00">*</span> 
                                        </label>
                                        <input type="date" class="form-control" name="data_inicio" id="data_inicio" >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label>
                                            <i class="fa fa-calendar"></i> Data Fim <span id="asterisco" style="color:#F00">*</span> 
                                        </label>
                                        <input type="date" class="form-control" name="data_fim" id="data_fim" >
                                    </div>
                                </div>                                

                                <div class="col-md-1">
                                    <label>Ativo</label><br/>
                                    <input type="checkbox"  id="ativo" name="ativo">
                                </div>

                            </div>

                        </form>               

                        <hr/>

                        <table class="table table-hover table-bordered table-striped table-sm" style="width: 100%">
                            <thead id="tab-2-thead-1">
                                <tr>
                                    <th>Cod</th>
                                    <th>Nome</th>
                                    <th>Cargo</th>
                                    <th>Data Inicio</th>
                                    <th>Data Fim</th>
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
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-danger btn-sm mr-2" id="tab-2-btn-cancelar" style="display: none;"><i class="fa fa-undo"></i> Cancelar</button>
                                <button type="button" class="btn btn-success  btn-sm mr-2"  id="tab-2-btn-salvar" style="display: block;" onclick="insertTab2Form1()" >&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm"  id="tab-2-btn-salvar-alteracoes"  style="display: none;" onclick="" ><i class="fa fa-floppy-o" ></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div><!-- fim tab-detalge -->
                </div><!-- tab-content -->
            </div><!-- bgwhite -->
        </div><!-- .row -->
    </section>

</main>


