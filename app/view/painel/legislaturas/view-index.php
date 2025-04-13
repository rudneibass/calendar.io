<main class="col-md-10" >
    <section>
        <div class="row mb-4 pr-4" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
            <div class="col-md-11">
                <span class="span-30" style="color: gray"><i class="fa fa-users"></i> Legislaturas </span>
            </div>
            <div class="col-md-1 p-0"> 
                <a href="cadastro.php">
                    <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
                </a>
            </div>
        </div>
    </section>

    <section>
        <div class="row">     
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" ><span class="text-muted">Pesquisa Por...</span></div>
                    <div class="card-body">

                        <form id="search">
                            <div class="row" id="row-1">

                                <div class="col-md-2">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                        </div>
                                        <input type="text" name="c1"  id="c1" class="form-control" placeholder="Código">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                        </div>
                                        <input type="text" name="c2"  id="c2" class="form-control" placeholder="Nome">
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="input-group  input-group-sm mb-3">
                                        <input type="date" name="c3"  id="c3" class="form-control" placeholder="CPF">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="input-group  input-group-sm mb-3">
                                        <input type="date" name="c4"  id="c4" class="form-control" placeholder="CPF">
                                    </div>
                                </div>


                            </div>      
                        </form>
                    </div>
                    <div class="modal-footer p-2 border-top-0">
                        <button type="button" class="btn btn-secondary btn-sm"  onclick="locate()" >
                            <i class="fa fa-search"></i> Pesquisar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row" style="padding: 15px">   


            <div class="col-md-12 bg-white reset">
                <table class="table-hover table-bordered table-striped table-sm" style="width: 100%">
                    <thead id="thead">

                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
                <div id="echos"></div>
                <div class="container">
                    <div class="row border bg-white">
                        <div class="col-md-10 reset"></div>
                        <div class="col-md-2 p-0">
                            <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior" disabled style="font-size: 24px;"></i>
                            <span id="numeracao" class="size-14"></span>
                            <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo" disabled></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
