<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Painel Administrativo</title>
        <?php
            require_once '../../_php/Render.php';
            $render = new Render();
            $render->renderHead();
        ?>   
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    </head>
    <body style="background-color: #FAFBFC;">

        <?php $render->renderHeader(); ?>

        <div class="container-fluid">
            <div class="row full-screen">
                <?php
                    $render->renderMain('multimidia', 'view-index');
                    $render->renderModal(array('modal-upload'));
                    $render->renderModal(array('modal-upload-preview-imagem'));
                    $render->renderFooter();
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
   
    <?php
        $render->renderScripts(array('Multimidia', 'UploadImagem', 'Upload','EntidadeInfo'));
        $render->renderScriptsOnload(array('razaoSocial' => array('')));
        $render->renderScriptsOnload(array('locate' => array('tab-1-form-1')));
    ?>    
</html>