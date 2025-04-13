<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Painel Administrativo</title>
        <?php
        require_once '../../_php/Render.php';
        $render = new Render();
        $render->renderHead();

        $id = isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : false;
        $competencia = isset($_GET['competencia']) && !empty($_GET['competencia']) ? $_GET['competencia'] : false;
        ?>   
    </head>
    <body style="background-color: #FAFBFC;">

        <?php $render->renderHeader();?>   

        <div class="container-fluid">
            <div class="row full-screen">
                <?php 
                
                $render->renderMain('pessoal','view-detalhe'); 
                $render->renderFooter();
                
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 
    
    $render->renderScripts(array('Pessoal', 'EntidadeInfo'));
    $render->renderScriptsOnload(array('razaoSocial' => array('')));
    $render->renderScriptsOnload(array('detalheFolha' => array($competencia)));
    
    ?>
    
</html>
