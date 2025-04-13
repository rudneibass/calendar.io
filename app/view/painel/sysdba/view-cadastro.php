<main class="col-md-10" >

    <div class="row mb-1 pr-3" style="border: 1px solid #dee2e6; background-color: #f4faf4; padding: 15px 0px 10px 5px">     
        <div class="col-md-10" >
            <span class="span-30" style="color: gray"><i class="fa fa-table"></i> <?php echo $_GET['table'] ?></span>
        </div>
        <div class="col-md-1 p-0"> 
            <a href="cadastro.php">
                <button type="button" class="btn btn-success btn-sm centro"><i class="fa fa-plus"></i> Cadastrar</button>
            </a>
        </div>
        <div class="col-md-1 p-0"> 
            <a href="../sysdba">
                <button type="button" class="btn btn-sm  btn-secondary centro"><i class="fa fa-undo"></i> Voltar</button>
            </a>
        </div>
    </div>


    <div class="row" style="padding: 15px">     
        <div class="col-md-12 bg-white reset">
            <table class="table-hover table-bordered table-striped table-sm" style="width: 100%">
                <thead id="thead">

                </thead>
                <tbody id="tbody">

                </tbody>
            </table>
            <div id="echos"></div>
        </div>
        <div class="col-md-12 d-flex justify-content-end border bg-white">
            <div>
                <i class="btn fa fa-chevron-circle-left" style="font-size: 20px;" id="anterior" disabled style="font-size: 24px;"></i>
                <span id="numeracao" class="size-14"></span>
                <i class="btn fa fa-chevron-circle-right" style="font-size: 20px" id="proximo" disabled></i>
            </div>
        </div>
    </div>

</main>
