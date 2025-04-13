<main class="col-md-10">

    <img src="../img/loading.gif" id="spinner" class="mainSpinner" width="120" style="position: absolute; z-index: 1; top: 250px; left: 600px; display: none" />

    <div class="row mb-4 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
        <div class="col-md-11">
            <span class="span-30" style="color: gray"><i class="fa fa-table"></i> Tabelas </span>
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
        </ul>

        <!-- Tab panes -->
        <div class="tab-content bg-white border border-top-0">

            <div class="tab-pane active" id="home" style="padding: 20px;">

                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-light border" role="alert">
                            <i class="fa fa-table"></i> <i><b>Tabela</b></i>
                        </div>
                    </div>
                </div>

                <!-- FORMULARIO DE CADASTO AQUI-->
                <form id="tab-1-form-1">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="mb-1">Nome</label>
                            <div class="input-group  input-group mb-3">
                                <input type="text" name="name" id="name" class="form-control" placeholder="">
                            </div>
                        </div>

                    </div>
                </form>
                <!-- BOTÕES DA ABA CADASTRO -->
                <hr>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <a href="../sysdba/" class="btn btn-secondary btn-sm ml-2"><i class="fa fa-undo"></i> Voltar</a>
                        <button type="button" class="btn btn-success  btn-sm ml-2" data-dismiss="modal" id="tab-1-btn-salvar" onclick="addTable()" style="display: block;">&emsp;&emsp;<i class="fa fa-floppy-o"></i> Salvar&emsp;&emsp;</button>
                        <button type="button" class="btn btn-info btn-sm ml-2" id="tab-1-btn-salvar-alteracoes" onclick="" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Alterações</button>    
                    </div>
                </div>
            </div>

        </div><!-- .tab-content -->

    </div><!-- .col-md-12 -->
    <br />
</main> <!-- .col-md-10 -->