<main class="col-md-10">

    <section>
        <div class="row mb-4 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-9">
                <span class="span-30" style="color: gray"><i class="fa fa-files-o"></i> Arquivos Enviados</span>
            </div>
            <div class="col-md-3 p-0" style="text-align: end;">
                <button type="button" class="btn btn-sm btn-secondary mr-2" onclick="showModalUpload('modal-upload-preview-imagem', 'ControllerRedimencionaImagem', 'redimensiona', '9999', 'arquivos')"><i class="fa fa-cloud-upload"></i> Enviar Imagem</button>
                <button type="button" class="btn btn-sm btn-info" onclick="showModalUpload('modal-upload', 'ControllerUploadMultiplo', 'analisaArquivo', '9999', 'arquivos', 'insert')"><i class="fa fa-cloud-upload"></i> Enviar Arquivos</button>
                
                <!-- <a href="cadastro.php">
                     <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button> 
                </a> -->
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><span class="text-muted">Pesquisa Por...</span></div>
                    <div class="card-body">
                        <form id="tab-1-form-1">
                            <input type="hidden" name="id_tabela_pai" id="id-tabela-pai-form-search-arquivos" value="">

                            <div class="row" id="row-1">
                                
                                <div class="col-md-7">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-file-text"> </i></span>
                                        </div>
                                        <input type="text" name="c2" class="form-control" placeholder="Nome">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                        </div>
                                        <input type="date" name="c3" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="input-group  input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend1"> <i class="fa fa-calendar"> </i></span>
                                        </div>
                                        <input type="date" name="c4" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-1">
                                    <div class="input-group  input-group-sm mb-3 btn btn-secondary btn-sm pt-2 pb-2" onclick="locate('tab-1-form-1')">
                                        <i class="fa fa-search m-auto"></i> 
                                    </div>
                                </div>

                            </div>
                        </form>

                        <?php if ($_SESSION['ID_USUARIO'] == "999") { ?>
                        
                        <div class="d-flex justify-content-end">
                            <a class="gray" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                              <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>

                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                  <form id="form-2">
                                      <div class="row">
                                            <div class="col-md-8">
                                                <div class="input-group  input-group-sm mb-3">
                                                    <input type="text" name="nova_url" id="postfix" class="form-control" placeholder="Nova Url">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group input-group-sm mb-3">
                                                    <select class="form-control" name="tipo" id="tipo">
                                                        <option value=''>Tipo</option>
                                                        <option value='arquivos'>Arquivos</option>
                                                        <option value='imagens'>Imagens</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="input-group  input-group-sm mb-3 btn btn-secondary btn-sm m-auto" onclick="updateUrl()">
                                                    <span class="m-auto"> Update Url Arquivos </span>
                                                </div>
                                            </div>

                                        </div>
                                     </form>

                                    <form id="form-3">
                                        <div class="row">

                                            <div class="col-md-9">
                                                <div class="input-group  input-group-sm mb-3">
                                                    <input type="text" name="nova_url" id="postfix" class="form-control" placeholder="Nova Url">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="input-group  input-group-sm mb-3 btn btn-secondary btn-sm" onclick="updateUrlCapaNoticia()">
                                                     <span class="m-auto">Update Url Imagem Noticias</span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <form id="form-4">
                                        <div class="row">

                                            <div class="col-md-9">
                                                <div class="input-group  input-group-sm mb-3">
                                                    <input type="text" name="nova_url" id="postfix" class="form-control" placeholder="Nova Url">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="input-group  input-group-sm mb-3 btn btn-secondary btn-sm"" onclick="updateUrlImagemServidor()">
                                                        <span class="m-auto"> Update Url Imagem Vereadores </span>
                                                </div>
                                            </div>
                                         </div>
                                    </form>

                                </div>
                            </div>
                        <?php } ?>            

                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="view-index-table-container">
            <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                <thead id="thead">

                </thead>
                <tbody id="tbody">

                </tbody>
            </table>

            <div class="text-center">
                <span id="tab_1_alerts pt-5"></span>
                <img class="loading mt-5" src="../img/loading-sm.svg" style="display: none">
            </div>  
            
        </div>

        <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
            <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior" disabled></i>
            <span id="numeracao" class="size-14"></span>
            <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo" disabled></i>
        </div>
    </section>
</main><!-- col-md-10 -->