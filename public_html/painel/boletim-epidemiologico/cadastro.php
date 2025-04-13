<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Painel Administrativo</title>
        <?php
        $id = isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : false;
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
                
                $render->renderMain('boletim-epidemiologico','view-cadastro'); 
                $render->renderFooter();
                
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 

    $render->renderScripts(array('BoletimEpidemiologico', 'EntidadeInfo')); 
    $render->renderScriptsOnload(array('razaoSocial' => array('')));
    $render->renderScriptsOnload(array('optionSelect' => array('servidor','entidade','cargos')));
    if($id){ $render->renderScriptsOnload(array('populaForm' => array($id)));}
    
    ?>
</html>
