<?php $emVotacao = $GLOBALS['emVotacao']; ?>
<section>
    <div class="modal fade"
        id="modalDetalhes"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border" style="background:rgba(0, 0, 0, 0.5);">
                <div class="modal-body" style="background:rgba(0, 0, 0, 0.5); max-height: 73vh; overflow-y: scroll">
                    <div>
                        <p style=" color: white; text-transform: uppercase; font-weight: bold; text-align: center;" class="mb-3"> 
                            <?php echo $emVotacao->materia['materia_tipo'] ?? '';?>
                            <?php echo $emVotacao->materia['materia_numero'] ?? ''; ?>
                        </p>
                        <p style="color: #FFC107; text-transform: uppercase; "  class="mb-3">
                            <?php echo $emVotacao->materia['materia_descricao'] ?? ''; ?>
                        </p>
                        <p style="color: #FFFFFF; font-size: 1rem;"  class="mb-3">
                            <?php echo $emVotacao->materia['sessao_descricao'] ?? ''; ?>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-lg btn-light" data-bs-dismiss="modal">
                        <i class="fa fa-undo"></i>
                        Voltar
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>