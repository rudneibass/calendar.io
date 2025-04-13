<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Painel Administrativo</title>
        <?php
        $table = isset($_GET['table']) && !empty($_GET['table']) ? $_GET['table'] : false;
        require_once '../../_php/Render.php';
        $render = new Render();
        $render->renderHead();
        ?>   
    </head>
    <body style="background-color: #FAFBFC;">

        <?php $render->renderHeader(); ?>   

        <div class="container-fluid">
            <div class="row full-screen">
                <?php 
                
                $render->renderMain('sysdba','view-cadastro-tabela'); 
                $render->renderModal(array('modal-upload'));
                $render->renderFooter();
                
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 
    
    $render->renderScripts(array('MasterDatabase', 'EntidadeInfo')); 
    $render->renderScriptsOnload(array('razaoSocial' => array('')));
    if($table){ $render->renderScriptsOnload(array('showColumns' => array($table)));}
    
    ?>
</html>
