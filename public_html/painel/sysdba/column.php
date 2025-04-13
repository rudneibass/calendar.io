<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Painel Administrativo</title>
        <?php
        $column_name = isset($_GET['column_name']) && !empty($_GET['column_name']) ? $_GET['column_name'] : false;
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
                
                $render->renderMain('sysdba','view-form'); 
                $render->renderModal(array('modal-upload-preview-imagem'));
                $render->renderFooter();
                
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 
    
    $render->renderScripts(array('MasterDatabase', 'EntidadeInfo')); 
    $render->renderScriptsOnload(array('razaoSocial' => array('')));
    if($column_name){ $render->renderScriptsOnload(array('populaForm' => array($table, $column_name)));}
    
    ?>
</html>
