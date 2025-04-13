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
                
                $render->renderMain('pessoa','view-cadastro'); 
                $render->renderModal(array('modal-upload-preview-imagem'));
                $render->renderFooter();
                
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 
    
    $render->renderScripts(array('Pessoa', 'PessoaVinculo', 'OptionSelect','UploadImagem')); 
    $render->renderScriptsOnload(array('optionSelect' => array('entidade_orgaos','cargos')));
    if($id){ $render->renderScriptsOnload(array('populaForm' => array($id)));}
    
    ?>
</html>
