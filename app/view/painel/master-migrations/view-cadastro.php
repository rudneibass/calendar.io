<main class="col-md-10">



    <div class="row mb-4 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">

        <div class="col-md-11">

            <span class="span-30" style="color: gray"><i class="fa fa-building"></i> Migrations </span>

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

                            <i class="fa fa-building-o"></i> <i><b>Informações da Migration</b></i>

                        </div>

                    </div>

                </div>


                <!-- FORMULARIO DE CADASTO AQUI-->
                <form id="tab-1-form-1" enctype="multipart/form-data">

                    <div class="class row">

                        <div class="col-md-11">
                            <div class="form-group">
                                <label id="label-razao-social">
                                    Descrição
                                </label>
                                <input type="text" name="descricao" class="form-control" id="descricao" >
                            </div>
                        </div>

                        <div class="col-md-1" style="display: flex; align-items: center; padding-top: 15px">
                            <div class="form-check">
                                <input type="checkbox" name="ativo" class="form-check-input" id="ativo" />
                                <label id="label-razao-social" >
                                    Ativo?
                                </label>
                            </div>
                        </div>

                        <div class="class col-md-6">
                            <div class="form-group">
                              <label for="script">Query</label>
                              <textarea class="form-control" id="query" name="query" rows="15"></textarea>
                            </div>
                        </div>

                        <div class="class col-md-6">
                            <div class="form-group">
                              <label for="revert">Query Reverse</label>
                              <textarea class="form-control" id="query_reverse" id="query_reverse" rows="15"></textarea>
                            </div>
                        </div>

                    </div>

                    <br />

                    <!-- </div> -->

                </form>

                <!-- BOTÕES DA ABA CADASTRO -->

                <hr>

                    
                <div id="botoes-foot" style="padding: 10px; display: flex; justify-content: right;">
                    <a href="index.php" class="btn btn-secondary btn-sm"><i class="fa fa-undo"></i> Voltar</a>
                    <button type="button" class="btn btn-success  btn-sm ml-2" data-dismiss="modal" id="tab-1-btn-salvar" onclick="insert()" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar&emsp;&emsp;</button>
                    <button type="button" class="btn btn-info btn-sm ml-2" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Alterações</button>
                </div>


            </div>



            <!-- ABA DETALHE -->

            <div class="tab-pane container fade" id="menu1" style="padding-top: 20px; padding-bottom: 1rem; border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6; ">





            </div><!-- FIM DA ABA DETALHE -->

        </div><!-- .tab-content -->



    </div><!-- .col-md-12 -->

    <br />

</main> <!-- .col-md-10 -->