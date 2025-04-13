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
                
                $render->renderMain('publicacoes','view-cadastro'); 
                $render->renderModal(array('modal-upload'));
                $render->renderFooter();
                
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 
        $render->renderScripts(array('Publicacoes', 'OptionSelect', 'Upload', 'ListarArquivos')); 
        $render->renderScriptsOnload(array('ListarArquivos' => array($id, 'publicacoes')));
        $render->renderScriptsOnload(array('optionSelect' => array('entidade_orgaos', 'mandatos')));
        if($id){ $render->renderScriptsOnload(array('populaForm' => array($id)));}
    ?>

<script>
        function  optionSelectNovo({tabela, filtros, inputId}) {
            $.ajax({
                url: '../../_php/Dispatch.php?controller=ControllerOptionSelect&&action=optionSelectNovo&&tbl=' + tabela,
                type: 'POST',
                data: {filtros: filtros},
                success: function (data) {
                    $('#' + inputId).html(data);
                }
            });
        }
        
        optionSelectNovo({
            tabela: 'opcoes_tabelas_colunas', 
            filtros: {campo: 'tabela', valor: 'publicacoes'},
            inputId: 'optgroup_tipo'
        })
    </script>
</html>

