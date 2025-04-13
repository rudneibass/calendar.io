<main class="col-md-10">
    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-11">
                <span class="span-30" style="color: gray"><i class="fa fa-users"></i> Servidores </span>
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
                    <div class="card-header"><span class="text-muted">Pesquisa Por...</span></div>
                    <div class="card-body">

                        <form id="search">
                            <div class="row" id="row-1">

                                <div class="col-md-2">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                        </div>
                                        <input type="text" name="c1" id="c1" class="form-control" placeholder="Código">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                        </div>
                                        <input type="text" name="c2" id="c2" class="form-control" placeholder="Nome">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                        </div>
                                        <input type="text" name="nome_eleitoral" id="nome_eleitoral" class="form-control" placeholder="Nome Eleitoral">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="input-group  input-group-sm mb-3">
                                        <input type="date" name="c3" id="c3" class="form-control" placeholder="CPF">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="input-group  input-group-sm mb-3">
                                        <input type="date" name="c4" id="c4" class="form-control" placeholder="CPF">
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                    <div class="modal-footer p-2 border-top-0">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="locate()">
                            <i class="fa fa-search"></i> Pesquisar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div style="background: #fff; min-height: 50vh; max-height: 50vh; overflow: auto; margin-top: 1rem; border-left: 1px solid; border-right: 1px solid; border-color: #dfe3ee;">
            <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                <thead id="thead">

                </thead>
                <tbody id="tbody">
                
                </tbody>
            </table>

            
            <div class="text-center">
                <br/>
                <span id="tab_1_alerts"></span>
                <svg id="tab_1_loading" width="35" height="35" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"  fill="#818182"  style="display: none;">
                    <path d="M12,4a8,8,0,0,1,7.89,6.7A1.53,1.53,0,0,0,21.38,12h0a1.5,1.5,0,0,0,1.48-1.75,11,11,0,0,0-21.72,0A1.5,1.5,0,0,0,2.62,12h0a1.53,1.53,0,0,0,1.49-1.3A8,8,0,0,1,12,4Z">
                    <animateTransform attributeName="transform" type="rotate" dur="0.75s" values="0 12 12;360 12 12" repeatCount="indefinite"/>
                    </path>
                </svg>
            </div>
            

        </div>

        <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
            <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior" disabled></i>
            <span id="numeracao" class="size-14"></span>
            <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo" disabled></i>
        </div>
    </section>

</main>