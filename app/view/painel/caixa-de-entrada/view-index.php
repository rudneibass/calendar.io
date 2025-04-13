<main class="col-md-10">
    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-11">
                <span class="span-30" style="color: gray"><i class="fa fa-envelope"></i> Caixa de Entrada </span>
            </div>
            <div class="col-md-1 p-0">
            </div>
        </div>
    </section>


    <section>
        <div class="col-md-12 reset">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" style="border-bottom: none">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-1" onclick="ouvidoria()"><b><i class="fa fa-deaf"></i> Ouvidoria</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-2" onclick="enviadas()"><i class="fa fa-paper-plane"></i> Respostas Ouvidoria </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-3" onclick="esic()"><b><i class="fa fa-info-circle"></i> e-Sic </b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-4" onclick="respostasEsic()"><i class="fa fa-paper-plane"></i> Respostas E-Sic </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane border bg-white active" id="tab-1">

                    <div class="row pl-3 pr-3 pt-3">
                        <div class="col-md-12">
                            <div class="alert alert-light border" role="alert">
                                <i class="fa fa fa-deaf"></i> <i><b>Mensagens Recebidas Ouvidoria</b></i>
                            </div>
                        </div>
                    </div>

                    <form id="tab-1-form-1" style="display: block; ">
                        <input type="hidden" id="act_post_ajax" name="act_post_ajax" value="find">
                        <input type="hidden" id="tbl" name="tbl" value="ouvidoria">

                        <div class="d-flex justify-content-between flex-wrap pl-3 pr-3">
                            <div class="">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="text" name="o_id" class="form-control" id="id" placeholder="Nº Protocolo">
                                </div>
                            </div>

                            <div class="w-50">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="text" name="o_nome" class="form-control" id="nome" placeholder="Nome">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="date" name="o_data_ini" class="form-control" id="data_ini" placeholder="Digite data inicial">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="date" name="o_data_fim" class="form-control" id="data_fim" placeholder="Digite data final">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group">
                                    <button type="button" id="pesquisar" class="btn btn-secondary btn-sm" onclick="ouvidoria()"> Pesquisar <i class="fa fa-search"></i></button>

                                </div>
                            </div>
                        </div>

                    </form>


                    <div class="view-index-table-container table-responsive">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">

                            </thead>
                            <tbody id="tab-1-tbody-1">

                            </tbody>
                        </table>
                        <div class="text-center">
                            <br />
                            <span id="tab_1_alerts"></span>
                            <img id="tab_1_loading" src="../img/loading-md.svg" style="display: none;" />
                        </div>
                    </div>

                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior" disabled></i>
                        <span id="numeracao" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo" disabled></i>
                    </div>

                </div>


                <!-- ABA E-ENVIADAS  -->
                <div class="tab-pane border bg-white fade" id="tab-2" style="padding-bottom: 1rem;">
                    <div class="row pl-3 pr-3 pt-3">
                        <div class="col-md-12">
                            <div class="alert alert-light border" role="alert">
                                <i class="fa fa-paper-plane"></i> <i><b>Respostas Ouvidoria</b></i>
                            </div>
                        </div>
                    </div>

                    <form id="tab-2-form-1" style="display: block;">
                        <input type="hidden" id="act_post_ajax" name="act_post_ajax" value="find">
                        <input type="hidden" id="tbl" name="tbl" value="ouvidoria">
                        <div class="d-flex justify-content-between flex-wrap pl-3 pr-3">
                            <div class="">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="text" name="o_id" class="form-control" id="id" placeholder="Nº Protocolo">
                                </div>
                            </div>

                            <div class="w-50">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="text" name="o_nome" class="form-control" id="nome" placeholder="Nome">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="date" name="o_data_ini" class="form-control" id="data_ini" placeholder="Digite data inicial">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="date" name="o_data_fim" class="form-control" id="data_fim" placeholder="Digite data final">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group">
                                    <button type="button" id="pesquisar" class="btn btn-secondary btn-sm" onclick="ouvidoria()">Pesquisar <i class="fa fa-search"></i></button>

                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="view-index-table-container table-responsive">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">

                            </thead>
                            <tbody id="tab-2-tbody-1">

                            </tbody>
                        </table>
                        <div class="text-center">
                            <br />
                            <span id="tab_2_alerts"></span>
                            <img id="tab_2_loading" src="../img/loading-md.svg" style="display: none;" />
                        </div>
                    </div>

                </div><!-- fim tab-2 -->

                <!-- ABA E-SIC  -->
                <div class="tab-pane border bg-white fade" id="tab-3" style="padding-bottom: 1rem;">
                    <div class="row pl-3 pr-3 pt-3">
                        <div class="col-md-12">
                            <div class="alert alert-light border" role="alert">
                                <i class="fa fa-info-circle"></i> <i><b>Mensagens Recebidas E-Sic</b></i>
                            </div>
                        </div>
                    </div>

                    <form id="tab-3-form-1" style="display: block; ">
                        <input type="hidden" id="act_post_ajax" name="act_post_ajax" value="find">
                        <input type="hidden" id="tbl" name="tbl" value="ouvidoria">

                        <div class="d-flex justify-content-between flex-wrap pl-3 pr-3">
                            <div class="">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="text" name="o_id" class="form-control" id="id" placeholder="Nº Protocolo">
                                </div>
                            </div>

                            <div class="w-50">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="text" name="o_nome" class="form-control" id="nome" placeholder="Nome">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="date" name="o_data_ini" class="form-control" id="data_ini" placeholder="Digite data inicial">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="date" name="o_data_fim" class="form-control" id="data_fim" placeholder="Digite data final">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group">
                                    <button type="button" id="pesquisar" class="btn btn-secondary btn-sm" onclick="ouvidoria()">Pesquisar <i class="fa fa-search"></i></button>

                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="view-index-table-container table-responsive">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">

                            </thead>
                            <tbody id="tab-3-tbody-1">

                            </tbody>
                        </table>
                        <div class="text-center">
                            <br />
                            <span id="tab_3_alerts"></span>
                            <img id="tab_3_loading" src="../img/loading-md.svg" style="display: none;" />
                        </div>
                    </div>

                </div><!-- fim tab-detalge -->

                <!-- ABA E-ENVIADAS  -->
                <div class="tab-pane border bg-white fade" id="tab-4" style="padding-bottom: 1rem;">
                    <div class="row pl-3 pr-3 pt-3">
                        <div class="col-md-12">
                            <div class="alert alert-light border" role="alert">
                                <i class="fa fa-paper-plane"></i> <i><b>Respostas Esic</b></i>
                            </div>
                        </div>
                    </div>

                    <form id="tab-4-form-1" style="display: block;">
                        <input type="hidden" id="act_post_ajax" name="act_post_ajax" value="find">
                        <input type="hidden" id="tbl" name="tbl" value="ouvidoria">
                        <div class="d-flex justify-content-between flex-wrap pl-3 pr-3">
                            <div class="">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="text" name="o_id" class="form-control" id="id" placeholder="Nº Protocolo">
                                </div>
                            </div>

                            <div class="w-50">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="text" name="o_nome" class="form-control" id="nome" placeholder="Nome">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="date" name="o_data_ini" class="form-control" id="data_ini" placeholder="Digite data inicial">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group input-group-sm mb-3">
                                    <input type="date" name="o_data_fim" class="form-control" id="data_fim" placeholder="Digite data final">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group">
                                    <button type="button" id="pesquisar" class="btn btn-secondary btn-sm" onclick="ouvidoria()">Pesquisar <i class="fa fa-search"></i></button>

                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="view-index-table-container table-responsive">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">

                            </thead>
                            <tbody id="tab-4-tbody-1">

                            </tbody>
                        </table>

                        <div class="text-center">
                            <br />
                            <span id="tab_4_alerts"></span>
                            <img id="tab_4_loading" src="../img/loading-md.svg" style="display: none;" />
                        </div>
     
                    </div>

                </div><!-- fim tab-2 -->


            </div><!-- tab-content -->
        </div><!-- bgwhite -->
    </section>


    <section>
        <div class="row" style="padding: 15px">


            <div class="col-md-12 bg-white reset">

            </div>
        </div>
    </section>

</main>