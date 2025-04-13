<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Painel Administrativo</title>

        <?php
        $id = isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : false;

        if (file_exists('../../../config/sec.php')) {
            require_once '../../../config/sec.php';
        } else {
            echo '<b>ATENÇÃO: </b>Não foi possivel localizar sec.php em public_html/painel/transparencia-covid19/editar.php!';
        }

        if (file_exists('../_html/tags-meta.html')) {
            include_once ('../_html/tags-meta.html');
        } else {
            echo '<b>ATENÇÃO: </b>Não foi possivel localizar tags-meta.html em public_html/painel/transparencia-covid19/editar.php!';
        }

        if (file_exists('../_html/tags-link.html')) {
            include_once ('../_html/tags-link.html');
        } else {
            echo '<b>ATENÇÃO: </b>Não foi possivel localizar tags-link.html em public_html/painel/transparencia-covid19/editar.php!';
        }
        ?>

    </head>
    <body style="background-color: #FAFBFC;">

        <?php
        if (file_exists('../_html/nav-top.html')) {
            include ('../_html/nav-top.html');
        } else {
            echo "<b>Atenção:</b> Não foi possviel localizar elemento <b>nav-top</b>!";
        }
        ?>   

        <div class="container-fluid">
            <div class="row full-screen">

                <?php
                if (file_exists('../_html/menu-lateral.html')) {
                    include ('../_html/menu-lateral.html');
                } else {
                    echo "<b>Atenção:</b> Não foi possviel localizar elemento <b>menu-lateral</b>!";
                }

                if (file_exists('../../../app/view/painel/transparencia-covid/main-form.php')) {
                    include ('../../../app/view/painel/transparencia-covid/main-form.php');
                } else {
                    echo "<b>Atenção:</b> Não foi possviel localizar elemento <b>main-form</b>!";
                }

                if (file_exists('../_html/footer.html')) {
                    include ('../_html/footer.html');
                } else {
                    echo "<b>Atenção:</b> Não foi possviel localizar elemento <b>footer</b>!";
                }
                ?>   

            </div><!-- full screen  -->
        </div><!-- container-fluid -->

    </body>

    <?php
    if (file_exists('../_html/tags-script.html')) {
        include_once ('../_html/tags-script.html');
    } else {
        echo '<b>ATENÇÃO: </b>Não foi possivel localizar tags-script.html em public_html/painel/transparencia-covid19/editar.php!';
    }
    ?>

    <script type='text/javascript' src="../_ajax/ControllerTransparenciaCovid.js"></script>

    <?php
    if (isset($id)) {
        echo"<script> populaForm($id)</script>";
    } else {
        echo "<b>ATENÇÃO: </b> ID do registro não foi especificado";
    }
    ?>

</html>

