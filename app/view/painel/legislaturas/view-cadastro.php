
<main class="col-md-10">

    <section>
        <div class="row mb-4 pr-4" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
            <div class="col-md-11" >
                <span class="span-30" style="color: gray"><i class="fa fa-users"></i> Legislaturas </span>
            </div>
            <div class="col-md-1 p-0"> 
                <a href="cadastro.php">
                    <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
                </a>
            </div>
        </div>
    </section>

    <section>
        <div class="row" style="padding: 20px">     
            <div class="col-md-12  reset">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-1">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-2">Detalhes</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content bg-white">

                    <div class="tab-pane container active" id="tab-1" style="padding-top: 20px; padding-bottom: 1rem; border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6; ">

                        <form id="tab-1-form-1" enctype="multipart/form-data">
                            <div class="container bg-white">
                                <input type="hidden" name="tbl" id="tbl" value="mandatos_detalhe">
                                <input type="hidden" value="<?php echo date("Y/m/d h:i:s") ?>" name="data_cadastro" id="data_cadastro">                              

                                <div class="row">                                               

                                    <div class="col-md-4">
                                        <div class="form-group input-group-sm mb-3">
                                            <label>
                                                Nome<span id="asterisco" style="color:#F00">*</span> 
                                            </label>
                                            <input type="text" name="nome" id="nome" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group input-group-sm mb-3">
                                            <label>
                                                Numero<span id="asterisco" style="color:#F00">*</span> 
                                            </label>
                                            <input type="text" name="numero" id="numero" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group input-group-sm mb-3">
                                            <label>
                                                Data da Eleição<span id="asterisco" style="color:#F00">*</span> 
                                            </label>
                                            <input type="date" name="data_eleicao" id="data_eleicao" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group input-group-sm mb-3">
                                            <label>
                                                Data Inicio<span id="asterisco" style="color:#F00">*</span> 
                                            </label>
                                            <input type="date" name="data_inicio" id="data_inicio" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group input-group-sm mb-3">
                                            <label>
                                                Data Inicio<span id="asterisco" style="color:#F00">*</span> 
                                            </label>
                                            <input type="date" name="data_fim" id="data_fim" class="form-control" required>
                                        </div>
                                    </div>

                                </div><!-- .row  -->

                            </div>
                        </form>

                        <hr>

                        <div class="row">
                            <div id="btn-upload" class="col-9">

                            </div>
                            <div class="col-md-1">
                                <a href="index.php"><button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-undo"></i> Voltar</button></a>
                            </div>
                            <div class="col-md-2" id="botoes-foot">
                                <button type="button" class="btn btn-success  btn-sm"  data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert('form_insert')" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true" ></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div>

                    <!-- ABA DETALHE  -->
                    <div class="tab-pane container fade" id="tab-2" style="padding-top: 20px; padding-bottom: 1rem; border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6; ">
                        <form id="tab-2-form-1" enctype="multipart/form-data">
                            <input type="hidden" value="entidade_orgaos_gestor" name="tbl" id="tbl">                              
                            <input type="hidden" value="<?php echo date("Y/m/d h:i:s") ?>" name="data_cadastro" id="data_cadastro">                              
                            <!-- ROW 1 -->
                            <div class="row">

                                <div class="col-md-1">
                                    <div class="form-group input-group-sm mb-3">
                                        <label>
                                            Cod.
                                        </label>
                                        <input type="text" class="form-control"  name="id_mandatos" id="relacionamento" readonly="true">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group input-group-sm mb-3">
                                        <label><i class="fa fa-filter"></i> Funcionário</label>
                                        <select  name="id_servidor" id="id_servidor" class="form-control">
                                            <option  value='0'></option>
                                            <optgroup id="optGroupservidor" label="Servidor">

                                            </optgroup>
                                        </select>                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-sm mb-3">
                                        <label>
                                            Cargo <span id="asterisco" style="color:#F00">*</span> 
                                        </label>
                                        <input type="text" class="form-control" name="cargo" id="cargo" >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-sm mb-3">
                                        <label>
                                            <i class="fa fa-calendar"></i> Data de Ingresso <span id="asterisco" style="color:#F00">*</span> 
                                        </label>
                                        <input type="date" class="form-control" name="data_inicio" id="data_inicio" >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-sm mb-3">
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
                        <div class="row">
                            <div id="btn-upload" class="col-9">

                            </div>
                            <div class="col-md-1">
                                <a href="index.php">
                                    <button type="button" class="btn btn-secondary btn-sm" id="tab-2-btn-voltar" ><i class="fa fa-undo"></i> Voltar</button>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" id="tab-2-btn-cancelar" style="display: none;"><i class="fa fa-undo"></i> Cancelar</button>
                            </div>
                            <div class="col-md-2" id="botoes-foot-tab-2">
                                <button type="button" class="btn btn-success  btn-sm"  id="tab-2-btn-salvar" style="display: block;" onclick="insertTab2Form1()" >&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm"  id="tab-2-btn-salvar-alteracoes"  style="display: none;" onclick="" ><i class="fa fa-floppy-o" ></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div><!-- fim tab-detalge -->
                </div><!-- tab-content -->
            </div><!-- bgwhite -->
        </div><!-- .row -->
    </section>

</main>


