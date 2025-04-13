<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Painel Administrativo</title>
        <?php
        require_once '../../_php/Render.php';
        $render = new Render();
        $render->renderHead();
        ?>   
    </head>
    <body style="background-color: #FAFBFC;">

        <?php $render->renderHeader();?>   

        <div class="container-fluid">
            <div class="row full-screen">
                <?php 
                
                $render->renderMain('pessoal','view-index'); 
                $render->renderFooter();
                
                ?>   
            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>
    <?php 
    
    $render->renderScripts(array('Pessoal', 'EntidadeInfo'));
    $render->renderScriptsOnload(array('razaoSocial' => array('')));
    $render->renderScriptsOnload(array('folhas' => array('')));
   /* $render->renderScriptsOnload(array('locate' => array('K050')));
    $render->renderScriptsOnload(array('locate' => array('K051')));
    $render->renderScriptsOnload(array('locate' => array('K060')));
    $render->renderScriptsOnload(array('locate' => array('K070')));
    $render->renderScriptsOnload(array('locate' => array('K100')));
    $render->renderScriptsOnload(array('locate' => array('K110')));
    $render->renderScriptsOnload(array('locate' => array('K120')));
    $render->renderScriptsOnload(array('locate' => array('K130')));
    $render->renderScriptsOnload(array('locate' => array('K150')));
    $render->renderScriptsOnload(array('locate' => array('K250')));
    $render->renderScriptsOnload(array('locate' => array('K300')));
    $render->renderScriptsOnload(array('locate' => array('K990'))); */
   
    
    ?>
    
</html>
