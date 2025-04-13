<main class="col-md-10">

    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-11">
                <span class="span-30" style="color: gray"><i class="fa fa-money"></i> Tabela de Valores de Diárias </span>
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
                                <i class="fa fa-money"></i> <i><b>Valor de Diárias</b></i>
                                &emsp;
                                <span id="tab_1_alerts"></span>
                                <img class="loading" src="../img/loading-sm.svg" style="display: none">
                            </div>
                        </div>
                    </div>

                    <form id="tab-1-form-1">
                        <input type="hidden" value="links" name="tbl" id="tbl">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label><i class="fa fa-filter"></i> Órgão </label>
                                    <select  class="form-control" name="id_entidade_orgaos" id="id_entidade_orgaos">
                                        <option  value='0'></option>
                                        <optgroup id="optGroupentidade_orgaos" label="Órgãos">

                                        </optgroup>
                                    </select>                        
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><i class="fa fa-filter"></i> Tipo</label>
                                    <select id="tipo" name="tipo" class="form-control">
                                        <option value="0"></option>
                                        <optgroup label="Trânsparencia">
                                            <option value="rural">Rural</option>
                                            <option value="urbana"> Urbana</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Valor </label><span style="color: red">*</span>
                                    <input type="text" name="valor" id="valor" class="form-control" value="" />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Exercício </label><span style="color: red">*</span>
                                    <input type="text" name="exercicio" id="exercicio" class="form-control" value="" />
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