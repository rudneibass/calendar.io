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
                
                $render->renderMain('contratos','view-cadastro'); 
                $render->renderModal(array('modal-upload', 'modal-input-pesquisa'));
                $render->renderFooter();
                
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 
    
    $render->renderScripts(array('Contratos', 'OptionSelect', 'InputPesquisa', 'Upload', 'ListarArquivos', 'EntidadeInfo')); 
    $render->renderScriptsOnload(array('razaoSocial' => array('')));
    $render->renderScriptsOnload(array('optionSelect' => array('entidade_orgaos', 'mandatos')));
    $render->renderScriptsOnload(array('ListarArquivos' => array($id, 'contratos')));
    if($id){ $render->renderScriptsOnload(array('populaForm' => array($id)));}
    
    ?>
</html>
