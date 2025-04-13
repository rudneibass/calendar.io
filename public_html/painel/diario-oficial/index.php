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
        <style>
            .dia {
                border: 1px solid #ccc;
                padding: 10px;
                min-height: 100px;
                width: 14.28%;
                position: relative;
            }
            .dia-footer{
             position: absolute;
             bottom: 0;
             right: 0;
             left: 0;
             width: 100%;
             text-align: end;
             padding: 5px;
            }
            .dia.hoje {
                background-color:rgba(142, 235, 142, 0.74);
                color: #000;
                font-weight: bold;
            }
            .dia.selecionado {
                background-color:rgba(235, 229, 142, 0.74);
                color: #000;
                font-weight: bold;
            }
            .dia ul {
                padding-left: 0;
                margin-left: 25px;
            }
            .dia ul li{
                padding-left: 0;
                margin-left: 0;
            }
            .dia ul li::marker {
                color: gray;
            }
        </style>
    </head>
    <body style="background-color: #FAFBFC;">

        <?php $render->renderHeader(); ?>   

        <div class="container-fluid">
            <div class="row full-screen">
                <?php
                    $render->renderMain('diario-oficial', 'view-index');
                    $render->renderModal(array('modal-diario-oficial', 'modal-upload'));
                    $render->renderFooter();
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->
    </body>
    <?php
        $render->renderScripts(array('DiarioOficial', 'OptionSelect', 'Upload', 'ListarArquivos', 'EntidadeInfo'));
        $render->renderScriptsOnload(array('optionSelect' => array('entidade_orgaos', 'mandatos')));
        $render->renderScriptsOnload(array('razaoSocial' => array('')));
    ?>
    <script>
        $(document).ready(function() {
            carregarCalendario(0);
        });
    </script>
</html>
