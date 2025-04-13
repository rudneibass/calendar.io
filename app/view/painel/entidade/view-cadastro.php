<main class="col-md-10">

    <img src="../img/loading.gif" id="spinner" class="mainSpinner" width="120" style="position: absolute; z-index: 1; top: 250px; left: 600px; display: none" />

    <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
        <div class="col-md-11">
            <span class="span-30" style="color: gray"><i class="fa fa-building-o"></i> Entidade </span>
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
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Gestores</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content bg-white border border-top-0">

            <div class="tab-pane active" id="home" style="padding: 20px;">

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-building-o"></i> <i><b>Informações da Entidade</b></i>

                            &emsp;
                            <span id="tab_1_alerts"></span>
                            <svg id="tab_1_loading" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#818182" style="display: none;">
                                <path d="M12,4a8,8,0,0,1,7.89,6.7A1.53,1.53,0,0,0,21.38,12h0a1.5,1.5,0,0,0,1.48-1.75,11,11,0,0,0-21.72,0A1.5,1.5,0,0,0,2.62,12h0a1.53,1.53,0,0,0,1.49-1.3A8,8,0,0,1,12,4Z">
                                    <animateTransform attributeName="transform" type="rotate" dur="0.75s" values="0 12 12;360 12 12" repeatCount="indefinite" />
                                </path>
                            </svg>

                        </div>
                    </div>
                </div>

                <!-- FORMULARIO DE CADASTO AQUI-->
                <form id="tab-1-form-1" enctype="multipart/form-data">
                    <input type="hidden" value="entidade" name="tbl" id="tbl">
                    <div class="bg-white">
                        <div class="row" id="row-2">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group input-group-md">
                                            <label id="label-razao-social">
                                                <i class="fa fa-building-o"></i>&nbsp;Razão Social <span id="asterisco" style="color:#F00">*</span>
                                            </label>
                                            <input type="text" name="razao_social" class="form-control" id="razao_social" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group input-group-md">
                                            <label id="label-razao-social">
                                                <i class="fa fa-building-o"></i>&nbsp;Nome Fantasia <span id="asterisco" style="color:#F00">*</span>
                                            </label>
                                            <input type="text" name="nome" id="nome" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2" id="col-cpf" style="display: block;">
                                        <div class="form-group input-group-md" style="display: block;">
                                            <label id="label-cnpj">
                                                CNPJ<span id="asterisco" style="color:#F00">*</span>
                                            </label>
                                            <input type="text" name="cnpj" id="cnpj" class="form-control" onblur="verificaCpfCnpj()" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group input-group-md">
                                            <label><i class="fa fa-filter"></i> Tipo</label>
                                            <select name="tipo" id="tipo" class="form-control">
                                                <option></option>
                                                <option value='1'>Prefeitura</option>
                                                <option value='2'>Câmara</option>
                                                <option value='3'>Autarquia</option>
                                                <option value='4'>Consórcio</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group input-group-md">
                                            <label id="label-razao-social">
                                                Nome do Gestor <span id="asterisco" style="color:#F00">*</span>
                                            </label>
                                            <input type="text" name="gestor" class="form-control" id="gestor" style="text-transform:uppercase" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group input-group-md" style="display: block;">
                                            <label id="label-cnpj">
                                                Cargo do Gestor<span id="asterisco" style="color:#F00">*</span>
                                            </label>
                                            <input type="text" name="cargo_gestor" id="cargo_gestor" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group input-group-md">
                                            <label><i class="fa fa-home"></i> Endereço</label>
                                            <input type="text" name="logradouro" id="logradouro" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group input-group-md">
                                            <label>Nº</label>
                                            <input type="text" name="numero" class="form-control" id="numero">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group input-group-md">
                                            <label>Bairro</label>
                                            <input type="text" name="bairro" class="form-control" id="bairro">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group input-group-md">
                                            <label>Complemento </label>
                                            <input type="text" name="complemento" class="form-control" id="complemento">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group input-group-md">
                                            <label>cep</label>
                                            <input type="text" name="cep" class="form-control" id="cep">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group input-group-md">
                                            <label>Cidade</label>
                                            <input type="text" name="cidade" class="form-control" id="cidade">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group input-group-md">
                                            <label>UF</label>
                                            <input type="text" name="uf" class="form-control" id="uf">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group input-group-md">
                                            <label>
                                                Fone 1
                                            </label>
                                            <input type="text" name="fone_1" id="fone_1" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group input-group-md">
                                            <label>
                                                Fone 2
                                            </label>
                                            <input type="text" name="fone_2" id="fone_2" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group input-group-md">
                                            <label>
                                                <i class="fa fa-whatsapp"></i> Whatsapp
                                            </label>
                                            <input type="text" name="whatsapp" id="whatsapp" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group input-group-md">
                                            <label>
                                                Horário de Funcionamento
                                            </label>
                                            <input type="text" class="form-control" name="horario_funcionamento" id="horario_funcionamento">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group input-group-md">
                                            <label>
                                                <i class="fa fa-envelope"></i> Email
                                            </label>
                                            <input type="text" name="email" class="form-control" id="email">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group input-group-md">
                                            <label>
                                                <i class="fa fa-facebook"></i> Facebook
                                            </label>
                                            <input type="text" name="facebook" id="facebook" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group input-group-md">
                                            <label>
                                                <i class="fa fa-instagram"></i> Instagram
                                            </label>
                                            <input type="text" name="instagram" id="instagram" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group input-group-md">
                                            <label>
                                                <i class="fa fa-youtube"></i> Youtube
                                            </label>
                                            <input type="text" name="youtube" id="youtube" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group input-group-md">
                                            <label>
                                                <i class="fa fa-twitter"></i> Twitter
                                            </label>
                                            <input type="text" name="twitter" id="twitter" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                <i class="fa fa-map-marker"></i> Geolocalização
                                            </label>
                                            <textarea class="form-control" name="geolocalizacao" id="geolocalizacao" rows="5"></textarea>
                                        </div>
                                    </div>

                                    <?php if ($_SESSION['ID_USUARIO'] == "999") { ?>

                                        <div class="col-md-12 border pt-4 pb-4 mt-4 mb-4">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group input-group-md">
                                                        <label>
                                                            <i class="fa fa-laptop"></i> Dominio <i class="text-muted">(http://...)</i>
                                                        </label>
                                                        <input type="text" name="dominio" id="dominio" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group input-group-md">
                                                        <label>
                                                            Url storage <i>(http:// ou https://)</i>
                                                        </label>
                                                        <input type="text" name="url_storage" id="url_storage" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group input-group-md">
                                                        <label>
                                                            Diretório de arquivos
                                                        </label>
                                                        <input type="text" name="dir_arquivos" id="dir_arquivos" class="form-control" disabled readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group input-group-md">
                                                        <label>
                                                            Diretório de Imagens
                                                        </label>
                                                        <input type="text" name="dir_imagens" id="dir_imagens" class="form-control" disabled readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group input-group-md">
                                                        <label>
                                                            Servidor
                                                        </label>
                                                        <input type="text" name="servidor_ftp" class="form-control" value="ftp.sitew2e.tecnologia.ws">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group input-group-md">
                                                        <label>
                                                            Usuário
                                                        </label>
                                                        <input type="text" name="usuario_ftp" class="form-control" value="sitew2etecnologi1">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group input-group-md">
                                                        <label>
                                                            Senha
                                                        </label>
                                                        <input type="password" name="senha_ftp" class="form-control" value="W2etecnologia@locaweb">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>


                                </div>
                            </div>

                        </div><!-- ROW 2 -->
                        <br />
                    </div>
                </form>
                <!-- BOTÕES DA ABA CADASTRO -->
                <hr>

                <div class="d-flex justify-content-between">
                    <div>

                    </div>
                    <div class="d-flex" id="botoes-foot">
                        <a href="../entidade/" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                        <button type="button" class="btn btn-success  btn-sm" data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert()" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar&emsp;&emsp;</button>
                        <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Alterações</button>
                    </div>
                </div>

            </div>

            <!-- ABA DETALHE  -->
            <div class="tab-pane fade" id="menu1" style="padding: 20px;">

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-user"></i> <i><b>Gestores da Entidade</b></i>
                        </div>
                    </div>
                </div>


                <form id="tab-2-form-1" enctype="multipart/form-data">
                    <input type="hidden" value="entidade_gestores" name="tbl" id="tbl">
                    <input type="hidden" value="<?php echo date("Y/m/d h:i:s") ?>" name="data_cadastro" id="data_cadastro">
                    <!-- ROW 1 -->
                    <div class="row">

                        <div class="col-md-1">
                            <div class="form-group input-group-md">
                                <label>
                                    Cod.
                                </label>
                                <input type="text" class="form-control" name="id_entidade" id="relacionamento" readonly="true">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group input-group-md">
                                <label><i class="fa fa-filter"></i> Funcionário</label>
                                <select name="id_servidor" id="id_servidor" class="form-control">
                                    <option value='0'></option>
                                    <optgroup id="optGroupservidor" label="Servidor">

                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group input-group-md">
                                <label><i class="fa fa-filter"></i> Cargo</label>
                                <select name="id_cargo" id="id_cargo" class="form-control">
                                    <option value='0'></option>
                                    <optgroup id="optGroupcargos" label="Cargos">

                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group input-group-md">
                                <label>
                                    <i class="fa fa-calendar"></i> Data de Ingresso <span id="asterisco" style="color:#F00">*</span>
                                </label>
                                <input type="date" class="form-control" name="data_inicio" id="data_inicio">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group input-group-md">
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

                <hr />

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
                <div class="d-flex justify-content-between">
                    <div>

                    </div>
                    <div class="d-flex" id="botoes-foot-tab-2">
                        <a href="index.php" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-undo"></i> Voltar</a>
                        <button type="button" class="btn btn-danger btn-sm mr-2" id="tab-2-btn-cancelar" style="display: none;"><i class="fa fa-undo"></i> Cancelar</button>
                        <button type="button" class="btn btn-success  btn-sm" id="tab-2-btn-salvar" style="display: block;" onclick="insertTab2Form1()">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                        <button type="button" class="btn btn-info btn-sm" id="tab-2-btn-salvar-alteracoes" style="display: none;" onclick=""><i class="fa fa-floppy-o"></i> Salvar Alterações</button>
                    </div>
                </div>

            </div><!-- fim tab-detalhe -->
        </div><!-- .tab-content -->

    </div><!-- .col-md-12 -->
    <br />
</main> <!-- .col-md-10 -->