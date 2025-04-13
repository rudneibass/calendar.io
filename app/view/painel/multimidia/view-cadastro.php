<main class="col-md-10">

    <section>
        <div class="row pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-11">
                <span class="span-30" style="color: gray"><i class="fa fa-files-o"></i> Arquivos Enviados</span>
            </div>
            <div class="col-md-1 p-0">
            </div>
        </div>
    </section>

    <section>
        <div class="row" style="padding: 20px">
            <div class="col-md-12 reset">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-1">Cadastro</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content bg-white border border-top-0">

                    <div class="tab-pane active" id="tab-1" style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-light border" role="alert">
                                    <i class="fa fa-play-circle-o"></i> <i><b>Detalhes do Arquivo</b></i>
                                    &emsp;
                                    <span id="tab_1_alerts"></span>
                                    <img class="loading" src="../img/loading-sm.svg" style="display: none">
                                </div>
                            </div>
                        </div>

                        <form id="tab-1-form-1">

                            <div class="row" id="row-1">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Nome </label>
                                        <input type="text" id="nome" class="form-control" disabled="true">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> Data </label>
                                        <input type="text" id="data" class="form-control" disabled="true">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> Horas </label>
                                        <input type="text" id="hora" class="form-control" disabled="true">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> Tipo </label>
                                        <input type="text" id="tipo" class="form-control" disabled="true">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> Tamanho <i>(em bytes)</i> </label>
                                        <input type="text" id="tamanho" class="form-control" disabled="true">
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><i class="fa fa-filter"></i> Tabela Pai</label>
                                        <select name="tabela_pai" id="tabela_pai" class="form-control">
                                            <option value="banner">Banner</option>
                                            <option value="comissoes">Comissoes</option>
                                            <option value="comunicados">Comunicados</option>
                                            <option value="contratos">Contratos</option>
                                            <option value="convenios">Convênios</option>
                                            <option value="entidade">Entidade</option>
                                            <option value="entidade_orgaos">Entidade Órgãos</option>
                                            <option value="diarias">Diárias</option>
                                            <option value="header">Header</option>
                                            <option value="leis">Leis</option>
                                            <option value="logo">Logo</option>
                                            <option value="licitacoes">Licitações</option>
                                            <option value="materias">Matérias</option>
                                            <option value="noticias">Notícias</option>
                                            <option value="obras">Obras</option>
                                            <option value="portarias">Portarias</option>
                                            <option value="processo_seletivo">Processo Seletivo</option>
                                            <option value="publicacoes">Publicações</option>
                                            <option value="responsabilidade">Resp. Fiscal</option>
                                            <option value="servicos">Serviços</option>
                                            <option value="servidor">Servidores</option>
                                            <option value="slide">Slide</option>
                                            <option value="videos">Vídeos</option>
                                        </select>
                                    </div>
                                </div>

                                <!--                        <div class="col-md-2">
                                <div class="form-group">
                                    <label> Tabela Pai </label>
                                    <input type="text" name="tabela_pai" id="tabela_pai"  class="form-control" required >
                                </div>
                            </div>-->

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> Código Tabela Pai </label>
                                        <input type="text" name="id_tabela_pai" id="id_tabela_pai" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label> Caminho Relativo</label>
                                        <input type="text" name="caminho_relativo" id="caminho_relativo" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> Caminho Absoluto</label>
                                        <input type="text" name="caminho_absoluto" id="caminho_absoluto" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Link para redirecionamento do usuário</label>
                                        <input type="text" name="link" id="link" class="form-control" required>
                                    </div>
                                </div>

                            </div><!-- row-1 -->

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

                </div><!-- tab-content -->
            </div><!-- bgwhite -->
        </div><!-- .row -->
    </section>
</main> <!-- .col-md-10 -->