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

        <?php 
            $render->renderHeader(); 
        ?>

        <div class="container-fluid">
            <div class="row full-screen">
                <?php 
                    $render->renderMain('materias','view-cadastro'); 
                    $render->renderModal(array('modal-upload'));
                    $render->renderModal(array('modal-arquivos'));
                    $render->renderFooter();
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 
        $render->renderScripts(array('Materias', 'MateriasAutores', 'MateriasFases', 'MateriasVotos','OptionSelect', 'Upload', 'ListarArquivos', 'EntidadeInfo')); 
        $render->renderScriptsOnload(array('razaoSocial' => array('')));
        $render->renderScriptsOnload(array('optionSelect' => array('entidade_orgaos', 'servidor')));
        if($id){ 
            $render->renderScriptsOnload(array('populaForm' => array($id)));
            $render->renderScriptsOnload(array('listarArquivos' => array($id, 'materias')));
        }
    ?>
</html>
