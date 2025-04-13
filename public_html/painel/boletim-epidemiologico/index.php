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
    <body onload="locate()" style="background-color: #FAFBFC;">

        <?php $render->renderHeader();?>   

        <div class="container-fluid">
            <div class="row full-screen">
                <?php $render->renderMain('boletim-epidemiologico','view-index'); ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 
        $render->renderScripts(array('BoletimEpidemiologico', 'EntidadeInfo'));
        $render->renderScriptsOnload(array('razaoSocial' => array('')));
    ?>
</html>
