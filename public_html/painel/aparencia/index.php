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
                    $render->renderMain('aparencia', 'view-index');
                    $render->renderModal(array('modal-upload-preview-imagem'));
                    $render->renderFooter();
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php
        $render->renderScripts(array('Aparencia', 'UploadImagem', 'EntidadeInfo'));
        $render->renderScriptsOnload(array('razaoSocial' => array('')));
        $render->renderScriptsOnload(array('populaForm' => array('')));
        $render->renderScriptsOnload(array('populaFormCores' => array('')));    
        $render->renderScriptsOnload(array('locate' => array('logo')));
        $render->renderScriptsOnload(array('locateHeader' => array('')));
        $render->renderScriptsOnload(array('locate' => array('slide')));
        $render->renderScriptsOnload(array('locate' => array('banner')));
    ?>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>
    
</html>
