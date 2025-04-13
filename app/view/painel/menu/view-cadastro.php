<main class="col-md-10">

    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-11">
                <span class="span-30" style="color: gray"><i class="fa fa-list"></i> Menu do Site </span>
            </div>
            <div class="col-md-1 p-0">
                <a href="cadastro.php">
                    <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
                </a>
            </div>
        </div>
    </section>

    <section>
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
                                <i class="fa fa-list"></i> <i><b>Menu do Site</b></i>
                                &emsp;
                                <span id="tab_1_alerts"></span>
                                <img class="loading" src="../img/loading-sm.svg" style="display: none">
                            </div>
                        </div>
                    </div>

                    <form id="tab-1-form-1">
                        <input type="hidden" value="links" name="tbl" id="tbl">

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nome </label>
                                    <input type="text" name="nome" id="nome" class="form-control" value="" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Url</label>
                                    <input type="text" name="url" id="url" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label> Ordem</label>
                                    <input type="text" name="ordem" id="ordem" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label><i class="fa fa-filter"></i> Órgão </label>
                                    <select  class="form-control" name="id_menu" id="id_menu">
                                        <option  value='0'>É um menu pricipal</option>
                                        <optgroup id="optGroupmenus" label="Pertence á...">

                                        </optgroup>
                                    </select>                        
                                </div>
                            </div>

                            <div class="col-md-2 d-flex align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" name="ativo" id="ativo" class="form-check-input" required>
                                    <label class="form-check-label">
                                        Ativo
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Descrição</label>
                                    <input type="text" name="descricao" id="descricao" class="form-control" value="" />
                                </div>
                            </div>

                        </div>
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
    </section>




</main>