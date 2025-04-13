<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Painel Administrativo</title>
        <?php
        require_once '../../_php/Render.php';
        $render = new Render();
        $render->renderHead();
        ?>   
    </head>
    <body style="background-color: #FAFBFC;">

        <?php $render->renderHeader();?>   

        <div class="container-fluid">
            <div class="row full-screen">
                <?php 
                
                $render->renderMain('leis','view-index'); 
                $render->renderModal(array('modal-arquivos'));
                $render->renderFooter();
                
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 
    
    $render->renderScripts(array('Leis', 'ListarArquivos', 'EntidadeInfo'));
    $render->renderScriptsOnload(array('razaoSocial' => array('')));
    $render->renderScriptsOnload(array('locate' => array('')));
    
    ?>
    
</html>
