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
                
                $render->renderMain('sessoes','view-cadastro'); 
                $render->renderModal(array('modal-upload'));
                $render->renderFooter();
                
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 
    
    $render->renderScripts(array('Sessoes', 'SessoesMembros', 'SessoesMaterias', 'OptionSelect', 'Upload', 'ListarArquivos')); 
    $render->renderScriptsOnload(array('optionSelect' => array('servidor', 'mandatos')));
    $render->renderScriptsOnload(array('optionSelectMaterias' => array('materias')));
    if($id){ $render->renderScriptsOnload(array('populaForm' => array($id)));}
    
    ?>
</html>
