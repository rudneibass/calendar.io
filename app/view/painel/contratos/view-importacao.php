<main class="col-md-10" >

    <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
        <div class="col-md-11" >
            <span class="span-30" style="color: gray"><i class="fa fa-file-text-o"></i> Contratos </span>
        </div>
        <div class="col-md-1 p-0"> 
            <a href="cadastro.php">
                <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
            </a>
        </div>
    </div>

    <div class="row">     
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" ><span class="text-muted">Pesquisa Por...</span></div>
                <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <h6>Importação de Contratos</h6>
                                <form id="formJson">
                                    <div class="row">                    
                                        <div class="col-md-8">
                                            <div class="form-group">
                                              <input type="file" class="form-control-file" id="jsonFile" name="jsonFile" accept=".json">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <img class="loadingFormJson" src="../img/loading-sm.svg" style="display: none">
                                        </div>    

                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-sm btn-secondary" onclick="importarJson()">
                                                <i class="fa fa-file-text-o"></i>
                                                Importar
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                <div class="modal-footer p-2 border-top-0">
                    <button type="button" class="btn btn-secondary btn-sm"  onclick="locate()" >
                        <i class="fa fa-search"></i> Pesquisar
                    </button>
                </div>

            </div>

        </div>
    </div>

    <section>
        <div class="view-index-table-container">
            <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                <thead id="thead">

                </thead>
                <tbody id="tbody">

                </tbody>
            </table>

            <div class="text-center">
                <span id="tab_1_alerts" class="text-muted"></span>
                <img class="loading mt-5" src="../img/loading-sm.svg" style="display: none">
            </div> 
 
        </div>

        <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
            <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior" disabled></i>
            <span id="numeracao" class="size-14"></span>
            <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo" disabled></i>
        </div>
    </section>

</main>
