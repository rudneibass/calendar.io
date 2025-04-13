<main class="col-md-10">
    <section>
        <div class="row mb-3 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">
            <div class="col-md-10">
                <span class="span-30" style="color: gray"><i class="fa fa-users"></i> Folha de Pagamento Datalhada </span>
            </div>
            <div class="col-md-2 text-right">
                <a href="index.php" class="btn btn-secondary btn-sm centro">
                    <i class="fa fa-undo"></i> Voltar
                </a>
                <a href="cadastro.php" class="btn btn-success btn-sm centro">
                   <i class="fa fa-plus"></i> Cadastrar
                </a>
            </div>
        </div>
    </section>
    <!--
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
    </section> -->

    <section>
        <div class="view-index-table-container" style="min-height: 75vh; max-height: 75vh;">
            <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                <thead id="thead">

                </thead>
                <tbody id="tbody">

                </tbody>
            </table>

            <div id="js-messages" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">

            </div>

        </div>

        <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
            <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior" disabled></i>
            <span id="numeracao" class="size-14"></span>
            <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo" disabled></i>
        </div>
    </section>

    <section style="display: none">
        <div class="col-md-12 reset">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" style="border-bottom: none">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-1"><b><i class="fa fa-file-text-o"></i> K050</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-2"><b><i class="fa fa-file-text-o"></i> K051 </b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-3"><b><i class="fa fa-file-text-o"></i> K060 </b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-4"><b><i class="fa fa-file-text-o"></i> K070 </b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-5"><b><i class="fa fa-file-text-o"></i> K100 </b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-6"><b><i class="fa fa-file-text-o"></i> K110 </b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-7"><b><i class="fa fa-file-text-o"></i> K120 </b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-8"><b><i class="fa fa-file-text-o"></i> K130 </b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-9"><b><i class="fa fa-file-text-o"></i> K150 </b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-10"><b><i class="fa fa-file-text-o"></i> K250 </b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-11"><b><i class="fa fa-file-text-o"></i> K300 </b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-12"><b><i class="fa fa-file-text-o"></i> K990 </b></a>
                </li>
            </ul>


            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane border bg-white active" id="tab-1">
                    <div class="view-index-table-container" style="max-height: 70vh">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">
                            </thead>
                            <tbody id="tbody-K050">
                            </tbody>
                        </table>
                        <div id="js-messages-K050" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior-K050" disabled></i>
                        <span id="numeracao-K050" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo-K050" disabled></i>
                    </div>
                </div><!-- fim tab -->

                <div class="tab-pane border bg-white" id="tab-2">
                    <div class="view-index-table-container" style="max-height: 70vh">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">
                            </thead>
                            <tbody id="tbody-K051">
                            </tbody>
                        </table>
                        <div id="js-messages-K051" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior-K051" disabled></i>
                        <span id="numeracao-K051" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo-K051" disabled></i>
                    </div>
                </div><!-- fim tab -->

                <div class="tab-pane border bg-white" id="tab-3">
                    <div class="view-index-table-container" style="max-height: 70vh">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">
                            </thead>
                            <tbody id="tbody-K060">
                            </tbody>
                        </table>
                        <div id="js-messages-K060" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior-K060" disabled></i>
                        <span id="numeracao-K060" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo-K060" disabled></i>
                    </div>
                </div><!-- fim tab -->

                <div class="tab-pane border bg-white" id="tab-4">
                    <div class="view-index-table-container" style="max-height: 70vh">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">
                            </thead>
                            <tbody id="tbody-K070">
                            </tbody>
                        </table>
                        <div id="js-messages-K070" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior-K070" disabled></i>
                        <span id="numeracao-K070" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo-K070" disabled></i>
                    </div>
                </div><!-- fim tab -->


                <div class="tab-pane border bg-white" id="tab-5">
                    <div class="view-index-table-container" style="max-height: 70vh">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">
                            </thead>
                            <tbody id="tbody-K100">
                            </tbody>
                        </table>
                        <div id="js-messages-K100" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior-K100" disabled></i>
                        <span id="numeracao-K100" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo-K100" disabled></i>
                    </div>
                </div><!-- fim tab -->


                <div class="tab-pane border bg-white" id="tab-6">
                    <div class="view-index-table-container" style="max-height: 70vh">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">
                            </thead>
                            <tbody id="tbody-K110">
                            </tbody>
                        </table>
                        <div id="js-messages-K110" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior-K110" disabled></i>
                        <span id="numeracao-K110" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo-K110" disabled></i>
                    </div>
                </div><!-- fim tab -->


                <div class="tab-pane border bg-white" id="tab-7">
                    <div class="view-index-table-container" style="max-height: 70vh">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">
                            </thead>
                            <tbody id="tbody-K120">
                            </tbody>
                        </table>
                        <div id="js-messages-K120" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior-K120" disabled></i>
                        <span id="numeracao-K120" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo-K120" disabled></i>
                    </div>
                </div><!-- fim tab -->


                <div class="tab-pane border bg-white" id="tab-8">
                    <div class="view-index-table-container" style="max-height: 70vh">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">
                            </thead>
                            <tbody id="tbody-K130">
                            </tbody>
                        </table>
                        <div id="js-messages-K130" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior-K130" disabled></i>
                        <span id="numeracao-K130" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo-K130" disabled></i>
                    </div>
                </div><!-- fim tab -->


                <div class="tab-pane border bg-white" id="tab-9">
                    <div class="view-index-table-container" style="max-height: 70vh">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">
                            </thead>
                            <tbody id="tbody-K150">
                            </tbody>
                        </table>
                        <div id="js-messages-K150" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior-K150" disabled></i>
                        <span id="numeracao-K150" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo-K150" disabled></i>
                    </div>
                </div><!-- fim tab -->


                <div class="tab-pane border bg-white" id="tab-10">
                    <div class="view-index-table-container" style="max-height: 70vh">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">
                            </thead>
                            <tbody id="tbody-K250">
                            </tbody>
                        </table>
                        <div id="js-messages-K250" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior-K250" disabled></i>
                        <span id="numeracao-K250" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo-K250" disabled></i>
                    </div>
                </div><!-- fim tab -->


                <div class="tab-pane border bg-white" id="tab-11">
                    <div class="view-index-table-container" style="max-height: 70vh">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">
                            </thead>
                            <tbody id="tbody-K300">
                            </tbody>
                        </table>
                        <div id="js-messages-K300" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior-K300" disabled></i>
                        <span id="numeracao-K300" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo-K300" disabled></i>
                    </div>
                </div><!-- fim tab -->

                <div class="tab-pane border bg-white" id="tab-12">
                    <div class="view-index-table-container" style="max-height: 70vh">
                        <table class="table-hover table-bordered table-striped table-sm w-100" style="border-left: 0; border-right:0;">
                            <thead id="thead">
                            </thead>
                            <tbody id="tbody-K990">
                            </tbody>
                        </table>
                        <div id="js-messages-K990" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; ">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end w-100 align-items-center border bg-white">
                        <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior-K990" disabled></i>
                        <span id="numeracao-K990" class="size-14"></span>
                        <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo-K990" disabled></i>
                    </div>
                </div><!-- fim tab -->

            </div><!-- tab-content -->
        </div><!-- bgwhite -->
    </section>
</main>