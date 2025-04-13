<main class="col-md-10">



    <div class="row mb-4 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">

        <div class="col-md-11">

            <span class="span-30" style="color: gray"><i class="fa fa-building"></i> Entidade </span>

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

                <a class="nav-link" data-toggle="tab" href="#menu1">Detalhes</a>

            </li>

        </ul>



        <!-- Tab panes -->

        <div class="tab-content bg-white border border-top-0 p-3">



            <div class="tab-pane active" id="home" style="padding-top: 10px;">

                <div class="row">

                    <div class="col-md-12">

                        <div class="alert alert-light border" role="alert">

                            <i class="fa fa-building-o"></i> <i><b>Informações da Entidade</b></i>

                        </div>

                    </div>

                </div>


                <!-- FORMULARIO DE CADASTO AQUI-->
                <form id="tab-1-form-1" enctype="multipart/form-data">

                    <input type="hidden" value="entidade" name="tbl" id="tbl">

                    <!-- <div class="container bg-white"> -->

                    <div class="row" id="row-2">

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">

                                            <div class="form-group input-group-sm mb-3">

                                                <label id="label-razao-social">

                                                    <i class="fa fa-building"></i>&nbsp;Razão Social <span id="asterisco" style="color:#F00">*</span>

                                                </label>

                                                <input type="text" name="razao_social" class="form-control" id="razao_social" required>

                                            </div>

                                        </div>




                                        <div class="col-md-2" id="col-cpf" style="display: block;">

                                            <div class="form-group input-group-sm mb-3" style="display: block;">

                                                <label id="label-cnpj">

                                                    CNPJ<span id="asterisco" style="color:#F00">*</span>

                                                </label>

                                                <input type="text" name="cnpj" id="cnpj" class="form-control" onblur="verificaCpfCnpj()" required>

                                            </div>

                                        </div>



                                        <div class="col-md-2">

                                            <div class="form-group input-group-sm mb-3" style="display: block;">

                                                <label id="label-cnpj">

                                                    Sigla<span id="asterisco" style="color:#F00">*</span>

                                                </label>

                                                <input type="text" name="sigla" id="sigla" class="form-control" onblur="verificaCpfCnpj()" required>

                                            </div>

                                        </div>



                                        <div class="col-md-2">

                                            <div class="form-group input-group-sm mb-3">

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




                                        <div class="col-md-3">

                                            <div class="form-group input-group-sm mb-3">

                                                <label>

                                                    Dominio

                                                </label>

                                                <input type="text" name="dominio" class="form-control" id="dominio">

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group input-group-sm mb-3">

                                                <label>

                                                    logo <span id="asterisco" style="color:#F00">*</span>

                                                </label>

                                                <input type="text" name="logo" class="form-control" id="logo">

                                            </div>

                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-check form-switch">
                                                <label>Site em manutenção nesse momento?</label>
                                                <input type="checkbox" id="manutencao" name="manutencao">
                                            </div>
                                        </div>



                                    </div>

                                </div>


                                <div class="col-md-12 mt-3">
                                    <fieldset>
                                        <legend>
                                            <h5 class="text-muted">Endereço e Atendimento</h5>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>Rua</label>
                                                    <input type="text" name="logradouro" id="logradouro" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>Número</label>
                                                    <input type="text" name="numero" id="numero" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>Bairro</label>
                                                    <input type="text" name="bairro" id="bairro" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>Complemento</label>
                                                    <input type="text" name="complemento" id="complemento" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>Cidade</label>
                                                    <input type="text" name="cidade" id="cidade" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>UF</label>
                                                    <input type="text" name="uf" id="uf" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>Horário de Atendimento</label>
                                                    <input type="text" name="horario_funcionamento" id="horario_funcionamento" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                    </fieldset>
                                </div>


                                <div class="col-md-12 mt-3">
                                    <fieldset>
                                        <legend>
                                            <h5 class="text-muted">Contato e Redes Sociais</h5>
                                        </legend>
                                        <div class="row">
                                    
                                            <div class="col-md-4">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>
                                                        <i class="fa fa-facebook"></i> Facebook
                                                    </label>
                                                    <input type="text" name="facebook" id="facebook" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>
                                                        <i class="fa fa-facebook"></i> Instagram
                                                    </label>
                                                    <input type="text" name="instagram" id="instagram" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>
                                                        <i class="fa fa-youtube"></i> Youtube
                                                    </label>
                                                    <input type="text" name="youtube" id="youtube" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>
                                                        <i class="fa fa-twitter"></i> Twitter
                                                    </label>
                                                    <input type="text" name="twitter" id="twitter" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>
                                                        <i class="fa fa-linkedin"></i> Linkedin
                                                    </label>
                                                    <input type="text" name="linkedin" id="linkedin" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>
                                                        <i class="fa fa-mail"></i> Email
                                                    </label>
                                                    <input type="text" name="email" id="email" class="form-control">
                                                </div>                                
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>
                                                        Fone
                                                    </label>
                                                    <input type="text" name="fone_1" id="fone_1" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>
                                                        Fone 2
                                                    </label>
                                                    <input type="text" name="fone_2" id="fone_2" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group input-group-sm mb-3">
                                                    <label>
                                                        <i class="fa fa-whatsapp"></i> Whatsapp
                                                    </label>
                                                    <input type="text" name="whatsapp" id="whatsapp" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                    </fieldset>
                                </div>





                                <div class="col-md-12 mt-3">

                                    <fieldset>

                                        <legend>

                                            <h5 class="text-muted">Credências Site</h5>

                                        </legend>

                                        <div class="row">

                                            <div class="col-md-2">

                                                <div class="form-group input-group-sm mb-3">

                                                    <label>DB Type</label>

                                                    <input type="text" name="db_type" id="db_type" class="form-control">

                                                </div>

                                            </div>



                                            <div class="col-md-4">

                                                <div class="form-group input-group-sm mb-3">

                                                    <label>Host</label>

                                                    <input type="text" name="host" id="host" class="form-control">

                                                </div>

                                            </div>



                                            <div class="col-md-2">

                                                <div class="form-group input-group-sm mb-3">

                                                    <label>DB Name</label>

                                                    <input type="text" name="db_name" id="db_name" class="form-control">

                                                </div>

                                            </div>



                                            <div class="col-md-2">

                                                <div class="form-group input-group-sm mb-3">

                                                    <label>User</label>

                                                    <input type="text" name="user" id="user" class="form-control">

                                                </div>

                                            </div>



                                            <div class="col-md-2">

                                                <div class="form-group input-group-sm mb-3">

                                                    <label>Pass</label>

                                                    <input type="text" name="pass" id="pass" class="form-control">

                                                </div>

                                            </div>

                                        </div>

                                    </fieldset>

                                </div>


                                <div class="col-md-12 mt-3">

                                    <fieldset>

                                        <legend>

                                            <h5 class="text-muted">Credências Ged</h5>

                                        </legend>

                                        <div class="row">



                                            <div class="col-md-2">

                                                <div class="form-group input-group-sm mb-3">

                                                    <label>DB Type GedW2e</label>

                                                    <input type="text" name="db_type_ged" id="db_type_ged" class="form-control">

                                                </div>

                                            </div>



                                            <div class="col-md-4">

                                                <div class="form-group input-group-sm mb-3">

                                                    <label>Host GedW2e</label>

                                                    <input type="text" name="db_host_ged" id="db_host_ged" class="form-control">

                                                </div>

                                            </div>



                                            <div class="col-md-2">

                                                <div class="form-group input-group-sm mb-3">

                                                    <label>DB Name GedW2e</label>

                                                    <input type="text" name="db_name_ged" id="db_name_ged" class="form-control">

                                                </div>

                                            </div>



                                            <div class="col-md-2">

                                                <div class="form-group input-group-sm mb-3">

                                                    <label>User GedW2e</label>

                                                    <input type="text" name="db_user_ged" id="db_user_ged" class="form-control">

                                                </div>

                                            </div>



                                            <div class="col-md-2">

                                                <div class="form-group input-group-sm mb-3">

                                                    <label>Pass GedW2e</label>

                                                    <input type="text" name="db_pass_ged" id="db_pass_ged" class="form-control">

                                                </div>

                                            </div>

                                        </div>

                                    </fieldset>

                                </div>

                            </div>


                        </div>



                    </div><!-- ROW 2 -->

                    <br />

                    <!-- </div> -->

                </form>

                <!-- BOTÕES DA ABA CADASTRO -->

                <hr>

                <div class="row">

                    <div id="btn-upload" class="col-9">

                    </div>

                    <div class="col-1">

                        <a href="index.php"><button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-undo"></i> Voltar</button></a>

                    </div>

                    <div class="col-2" id="botoes-foot">

                        <button type="button" class="btn btn-success  btn-sm" data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert()" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar&emsp;&emsp;</button>

                        <button type="button" class="btn btn-info btn-sm" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Alterações</button>

                    </div>

                </div>

            </div>



            <!-- ABA DETALHE -->

            <div class="tab-pane container fade" id="menu1" style="padding-top: 20px; padding-bottom: 1rem; border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6; ">





            </div><!-- FIM DA ABA DETALHE -->

        </div><!-- .tab-content -->



    </div><!-- .col-md-12 -->

    <br />

</main> <!-- .col-md-10 -->