<main class="col-md-10">


        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-11">
                <span class="span-30" style="color: gray"><i class="fa fa-building"></i> Órgãos</span>
            </div>
            <div class="col-md-1 p-0">
                <a href="cadastro.php">
                    <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
                </a>
            </div>
        </div>
  


 
            <div class="col-md-12 reset">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-1">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-2">Gestores</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content bg-white border border-top-0">

                    <div class="tab-pane active" id="tab-1" style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-building"></i> <i><b>Dados do Órgão</b></i>
                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <img class="loading" src="../img/loading-sm.svg" style="display: none">
                                </div>
                            </div>
                        </div>

                        <form id="tab-1-form-1" enctype="multipart/form-data">

                            <input type="hidden" name="tbl" id="tbl" value="entidade_orgaos">

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><i class="fa fa-filter"></i> Entidade </label>
                                        <select name="id_entidade" id="id_entidade" class="form-control">
                                            <option value='0'></option>
                                            <optgroup id="optGroupentidade" label="Entidades">

                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Nome<span id="asterisco" style="color:#F00">*</span>
                                        </label>
                                        <input type="text" name="nome" id="nome" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>
                                            CNPJ
                                        </label>
                                        <input type="text" name="cnpj" id="cnpj" class="form-control"  required>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            Atual Gestor
                                        </label>
                                        <input type="text" name="gestor" id="gestor" class="form-control"  required>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>
                                            Cargo do Atual Gestor
                                        </label>
                                        <input type="text" name="cargo_gestor" id="cargo_gestor" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>
                                            CEP
                                        </label>
                                        <input type="text" name="cep" id="cep" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            Rua
                                        </label>
                                        <input type="text" name="rua" id="rua" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>
                                            Nº
                                        </label>
                                        <input type="text" name="numero" id="numero" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>
                                            Bairro
                                        </label>
                                        <input type="text" name="bairro" id="bairro" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>
                                            Complemento
                                        </label>
                                        <input type="text" name="complemento" id="complemento" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>
                                            Fone 1
                                        </label>
                                        <input type="text" name="fone_1" id="fone_1" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>
                                            Fone 2
                                        </label>
                                        <input type="text" name="fone_2" id="fone_2" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            Email
                                        </label>
                                        <input type="text" name="email" id="email" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            Web Page
                                        </label>
                                        <input type="text" name="web_page" id="web_page" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Horário de Atendimento
                                        </label>
                                        <input type="text" name="web_page" id="web_page" class="form-control"  required>
                                    </div>
                                </div>

                            </div><!-- .ROW #ENDEREÇO -->

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

                    <div class="tab-pane" id="tab-2" style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-user"></i> <i><b>Gestores do Órgão</b></i>
                                </div>
                            </div>
                        </div>

                        <form id="tab-2-form-1" enctype="multipart/form-data">
                            <input type="hidden" value="entidade_orgaos_gestor" name="tbl" id="tbl">
                            <input type="hidden" value="<?php echo date("Y/m/d h:i:s") ?>" name="data_cadastro" id="data_cadastro">
                            <!-- ROW 1 -->
                            <div class="row">

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>
                                            Cod.
                                        </label>
                                        <input type="text" class="form-control" name="id_entidade_orgaos" id="relacionamento" readonly="true">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><i class="fa fa-filter"></i> Funcionário</label>
                                        <select name="id_servidor" id="id_servidor" class="form-control">
                                            <option value='0'></option>
                                            <optgroup id="optGroupservidor" label="Servidor">

                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><i class="fa fa-filter"></i> Cargo</label>
                                        <select name="id_cargo" id="id_cargo" class="form-control">
                                            <option value='0'></option>
                                            <optgroup id="optGroupcargos" label="Cargos">

                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>
                                            <i class="fa fa-calendar"></i> Data de Ingresso <span id="asterisco" style="color:#F00">*</span>
                                        </label>
                                        <input type="date" class="form-control" name="data_inicio" id="data_inicio">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>
                                            <i class="fa fa-calendar"></i> Data Fim <span id="asterisco" style="color:#F00">*</span>
                                        </label>
                                        <input type="date" class="form-control" name="data_fim" id="data_fim">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <label>Ativo</label><br />
                                    <input type="checkbox" id="ativo" name="ativo">
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
                        <div class="d-flex justify-content-between">
                            <div>

                            </div>
                            <div class="d-flex" id="botoes-foot-tab-2">
                                <a href="index.php" class="btn btn-secondary btn-sm mr-2" id="tab-2-btn-voltar"><i class="fa fa-undo"></i> Voltar</a>
                                <button type="button" class="btn btn-danger btn-sm mr-2" id="tab-2-btn-cancelar" style="display: none;"><i class="fa fa-undo"></i> Cancelar</button>
                                <button type="button" class="btn btn-success  btn-sm" id="tab-2-btn-salvar" style="display: block;" onclick="insertTab2Form1()">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm" id="tab-2-btn-salvar-alteracoes" style="display: none;" onclick=""><i class="fa fa-floppy-o"></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div>

                </div><!-- tab-content -->
            </div><!-- bgwhite -->

</main>