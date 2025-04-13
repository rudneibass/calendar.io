
<main class="col-sm-10">

    <section>
        <div class="row mb-4 pr-4" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
            <div class="col-sm-11" >
                <span class="span-30" style="color: gray"><!-- <i class="fa fa-users"></i> --> Covid-19 </span><span class="gray">Transparência Covid-19</span>
            </div>
            <div class="col-sm-1 p-0"> 
                <a href="cadastrar.php">
                    <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
                </a>
            </div>
        </div>
    </section>

    <section>
        <div class="row" style="padding: 20px">     
            <div class="col-sm-12 reset">

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
                <div class="tab-content border border-top-0 bg-white">

                    <div class="tab-pane container active" id="tab-1" style="padding-top: 20px; padding-bottom: 1rem; ">

                        <form id="form_insert" enctype="multipart/form-data">
                            <input type="hidden" name="tbl" id="tbl" value="transparencia_covid">
                            <!-- ROW 1 -->
                            <div class="row" id="row-1">

                                <div class="col-sm-6">
                                    <div class="form-group input-group-sm mb-3">
                                        <label>
                                           Receitas
                                        </label>
                                        <input type="text" name="receitas" id="receitas" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group input-group-sm mb-3">
                                        <label>
                                            Empenhos
                                        </label>
                                        <input type="text" name="empenhos" id="empenhos" class="form-control" required >
                                    </div>
                                </div> 

                                <div class="col-sm-6">
                                    <div class="form-group input-group-sm mb-3">
                                        <label>
                                            Liquidações
                                        </label>
                                        <input type="text" name="liquidacoes" id="liquidacoes" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group input-group-sm mb-3">
                                        <label>
                                            Pagamentos
                                        </label>
                                        <input type="text" name="pagamentos" id="pagamentos" class="form-control" required >
                                    </div>
                                </div> 

                            </div>

                        </form>
                        <hr>

                        <div class="row">
                            <div id="btn-upload" class="col-9">

                            </div>
                            <div class="col-sm-1">
                                <a href="index.php"><button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-undo"></i> Voltar</button></a>
                            </div>
                            <div class="col-sm-2" id="botoes-foot">
                                <button type="button" class="btn btn-success  btn-sm"  data-dismiss="modal" id="btn-salvar" onclick="insert('form_insert')" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                            </div>
                        </div>

                    </div>

                    <!-- ABA DETALHE  -->
                    <div class="tab-pane container fade" id="tab-2" style="padding-top: 20px; padding-bottom: 1rem;">

                        <div id="echos-pessoa-vinculo"></div>

                        <hr>
                        <!-- BOTÕES ABA DETALHE -->
                        <div class="row">
                            <div id="btn-upload" class="col-9">

                            </div>
                            <div class="col-sm-1">
                                <a href="index.php">
                                    <button type="button" class="btn btn-secondary btn-sm" id="tab-2-btn-voltar" ><i class="fa fa-undo"></i> Voltar</button>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" id="tab-2-btn-cancelar" style="display: none;"><i class="fa fa-undo"></i> Cancelar</button>
                            </div>
                            <div class="col-sm-2" id="botoes-foot-tab-2">
                                <button type="button" class="btn btn-success  btn-sm"  id="tab-2-btn-salvar" style="display: block;" onclick="insertPessoaVinculo()" >&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar &emsp;&emsp;</button>
                                <button type="button" class="btn btn-info btn-sm"  id="tab-2-btn-salvar-alteracoes"  style="display: none;" onclick="" ><i class="fa fa-floppy-o" ></i> Salvar Alterações</button>
                            </div>
                        </div>

                    </div><!-- fim tab-detalge -->
                </div><!-- tab-content -->
            </div><!-- bgwhite -->
        </div><!-- .row -->
    </section>

</main>


