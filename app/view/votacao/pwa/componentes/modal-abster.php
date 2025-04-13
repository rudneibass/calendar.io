<?php $emVotacao = $GLOBALS['emVotacao']; ?>
<section>
    <div class="modal fade" id="modalAbstencao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border" style="background:rgba(0, 0, 0, 0.5);">
                <div class="modal-body" style="background:rgba(0, 0, 0, 0.5); text-align: center;">
                <h1 style="color: white">Atenção</h1>
                    <hr style="color: white"/>
                    <h2 style="color: white">
                        Você deseja realmente abster-se dessa matéria?
                    </h2>
                    <br />
                    <div class="align-center d-flex" >
                        <button
                            type="button"
                            class="btn btn-default btn-lg btn3d"
                            data-bs-dismiss="modal">
                            <i class="fa fa-undo"></i>
                            Voltar
                        </button>
                        &emsp;
                        <button type="button" class="btn btn-info btn-lg btn3d m-auto" onclick="votar({id_servidor: <?php echo $_SESSION['USUARIO_ID']; ?>, id_materias: <?php echo $emVotacao->materia['id_materias'] ?>, voto: 'ABS'})">
                            <i class="fa fa-user-secret"></i>&nbsp;Abster-se
                        </button>
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </div>
</section>