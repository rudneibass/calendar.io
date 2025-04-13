<main class="col-md-10">

    <img src="../img/loading.gif" id="spinner" class="mainSpinner" width="120" style="position: absolute; z-index: 1; top: 250px; left: 600px; display: none" />
    <section>
        <div class="row mb-4 pr-4" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-11">
                <span class="span-30" style="color: gray"><i class="fa fa-newspaper-o"></i> Notícias </span>
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
            <div class="col-md-12 reset">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#detalhe">Detalhes</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content bg-white border border-top-0">

                    <div class="tab-pane active" id="home" style="padding: 20px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-newspaper-o"></i> <i><b>Informações da Notícia</b></i>
                                </div>
                            </div>
                        </div>

                        <form id="tab-1-form-1" enctype="multipart/form-data">
                            <input type="hidden" value="noticias" name="tbl" id="tbl">
                            <input type="hidden" value="<?php echo date("Y/m/d h:i:s") ?>" name="data_cadastro" id="data_cadastro">
                            <input type="hidden" value="<?php echo date("Y/m/d h:i:s") ?>" name="data_cadastro_formatada" id="data_cadastro_formatada">


                            <div class="row" id="row-1">

                                <div class="col-md-4">
                                    <div class="form-group input-group-sm mb-3">
                                        Título<span id="asterisco" style="color:#F00">*</span>
                                        <input type="text" name="titulo" id="titulo" class="form-control" maxlength="75" required>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group input-group-sm mb-3">
                                        Resumo<span id="asterisco" style="color:#F00">*</span>
                                        <input type="text" name="resumo" id="resumo" class="form-control" maxlength="180">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-sm mb-3">
                                        Data Notícia<span id="asterisco" style="color:#F00">*</span>
                                        <input type="date" name="data_noticia" id="data_noticia" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group input-group-sm mb-3">
                                        <i class="fa fa-filter"></i> Categoria
                                        <select id="categoria" name="categoria" class="form-control">
                                            <option value="">Categoria</option>
                                            <option value='#Administração'>#Administração</option>
                                            <option value='#Agenda'>#Agenda</option>
                                            <option value='#Agricultura'>#Agricultura</option>
                                            <option value='#Aluguéis'>#Aluguéis</option>
                                            <option value='#ApoioAoPaciente'>#ApoioAoPaciente</option>
                                            <option value='#AssistênciaSocial'>#AssistênciaSocial</option>
                                            <option value='#Audiência'>#Audiência</option>
                                            <option value='#Certidões'>#Certidões</option>
                                            <option value='#ConselhoTutelar'>#ConselhoTutelar</option>
                                            <option value='#Controladoria'>#Controladoria</option>
                                            <option value='#Controle'>#Controle</option>
                                            <option value='#Cultura'>#Cultura</option>
                                            <option value='#DefesaCivil'>#DefesaCivil</option>
                                            <option value='#Desenvolvimento'>#Desenvolvimento</option>
                                            <option value='#DireitosHumano'>#DireitosHumano</option>
                                            <option value='#Drogas'>#Drogas</option>
                                            <option value='#Educação'>#Educação</option>
                                            <option value='#Empreendedorismo'>#Empreendedorismo</option>
                                            <option value='#Emprego'>#Emprego</option>
                                            <option value='#Endereço'>#Endereço</option>
                                            <option value='#Esporte'>#Esporte</option>
                                            <option value='#Festa'>#Festa</option>
                                            <option value='#Finança'>#Finança</option>
                                            <option value='#FolhaDePagamento'>#FolhaDePagamento</option>
                                            <option value='#Gestão'>#Gestão</option>
                                            <option value='#Habitação'>#Habitação</option>
                                            <option value='#Imóveis'>#Imóveis </option>
                                            <option value='#Imposto'>#Imposto </option>
                                            <option value='#Infraestrutura'>#Infraestrutura </option>
                                            <option value='#Isenção'>#Isenção </option>
                                            <option value='#Jurídico'>#Jurídico </option>
                                            <option value='#Juventude'>#Juventude </option>
                                            <option value='#Lazer'>#Lazer </option>
                                            <option value='#Limpeza'>#Limpeza </option>
                                            <option value='#MeioAmbiente'>#MeioAmbiente </option>
                                            <option value='#Melhoria'>#Melhoria </option>
                                            <option value='#Mobilidade'>#Mobilidade </option>
                                            <option value='#Mulher'>#Mulher </option>
                                            <option value='#Município'>#Município </option>
                                            <option value='#nataldeamordeluz'>#nataldeamordeluz</option>
                                            <option value='#Obra'>#Obra </option>
                                            <option value='#Planejamento'>#Planejamento </option>
                                            <option value='#Prefeito'>#Prefeito </option>
                                            <option value='#Saneamento'>#Saneamento</option>
                                            <option value='#Saúde'>#Saúde </option>
                                            <option value='#Segurança'>#Segurança </option>
                                            <option value='#Tecnologia'>#Tecnologia </option>
                                            <option value='#Transparência'>#Transparência </option>
                                            <option value='#Tributação'>#Tributação </option>
                                            <option value='#Tributo'>#Tributo </option>
                                            <option value='#Tributos'>#Tributos</option>
                                            <option value='#Turismo'>#Turismo </option>
                                            <option value='#Urbanismo'>#Urbanismo </option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group input-group-sm mb-3">
                                        Imagem Capa da Notícia<span id="asterisco" style="color:#F00">*</span>
                                        <input type="text" name="imagem_url" id="imagem_url" class="form-control">
                                    </div>
                                </div>

                            </div><!-- row-1 -->

                            <div class="row" id="row-2">
                                <div class="col-md-12">
                                    <label>Descrição</label><span id="asterisco" style="color:#F00">*</span>
                                    <div class="form-group">
                                        <textarea name="descricao" id="descricao" class="form-control" rows="8"></textarea>
                                    </div>
                                </div>
                            </div><!-- row-2 -->

                        </form>

                        <hr>

                        <div class="row">
                            <div id="btn-upload" class="col-9">
                                <button type="button" class="btn btn-secondary btn-sm btn-upload" id="tab-1-btn-show-modal-upload" disabled><i class="fa fa-cloud-upload"></i> ENVIAR IMAGEM PARA CAPA</button>
                            </div>
                            <div class="col-1">
                                <a href="index.php"><button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-undo"></i> Voltar</button></a>
                            </div>
                            <div class="col-2" id="botoes-foot">
                                <button type="button" class="btn btn-success  btn-sm" data-dismiss="modal" id="btn_insert" onclick="insert('form_insert')" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar&emsp;&emsp;</button>
                            </div>
                        </div>

                    </div>

                    <!-- ABA DETALHE  -->
                    <div class="tab-pane fade" id="detalhe" style="padding: 20px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-newspaper-o"></i> <i><b>Imagens da Notícia</b></i>
                                </div>
                            </div>
                        </div>

                        <div class="row" id='lista-de-imagens'>

                        </div>
                        <hr>

                        <!-- BOTÕES ABA DETALHE -->
                        <div class="row">
                            <div id="btn-upload" class="col-9 div-btn-upload">
                                <!-- Botão está sendo inserido via javascript -->
                                <button type="button" class="btn btn-secondary btn-sm btn-upload" id="tab-2-btn-2-show-modal-upload" disabled><i class="fa fa-cloud-upload"></i> Enviar Imagem para capa</button>
                                <button type="button" class="btn btn-sm btn-info" id="tab-2-btn-show-modal-upload" disabled><i class="fa fa-cloud-upload"></i> Enviar imagens adicionais</button>
                            </div>
                            <div class="col-1">
                            </div>
                            <div class="col-2" id="botoes-foot">
                            </div>
                        </div>

                    </div><!-- fim tab-detalge -->
                </div><!-- tab-content -->
            </div><!-- bgwhite -->
        </div><!-- .row -->
    </section>

</main>