<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Painel Administrativo</title>
        <?php
        require_once '../../_php/Render.php';
        $render = new Render();
        $render->renderHead();
        ?>   

        <!--
        <style>
            .nav-link { color: gray; padding: 22px; font-size: 14px}
        </style> -->

        <style>
            .nav-link { color: gray; font-size: 14px}
        </style> 
        
    </head>
    <body style="background-color: #FAFBFC;">

        <?php $render->renderHeader();?>   
        
        <div class="container-fluid">
            <div class="row full-screen">
                <?php 
                
                $render->renderMain('caixa-de-entrada','view-index'); 
                $render->renderModal(array('modal-ouvidoria', 'modal-esic', 'modal-enviadas', 'modal-migrate'));
                $render->renderFooter();
                
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 
    
    $render->renderScripts(array('MensagensOuvidoria','MensagensEsic','MensagensEnviadas', 'EntidadeInfo','Migrate'));
    $render->renderScriptsOnload(array('ouvidoria' => array('')));
    $render->renderScriptsOnload(array('razaoSocial' => array('')));
    $render->renderScriptsOnload(array('migrate' => array('')));
    
    ?>
</html>
