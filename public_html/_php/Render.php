<?php

class Render {

    function __construct() {
        /*if (file_exists('../../../config/sec.php')) {
            require_once '../../../config/sec.php';
        } else {
            echo '<b>ATENÇÃO: </b>Não foi possivel localizar sec.php!';
        }*/
    }

    function renderHead() {

        if (file_exists('../_html/tags-meta.html')) {
            include_once ('../_html/tags-meta.html');
        } else {
            echo '<b>ATENÇÃO: </b>Não foi possivel localizar tags-meta.html!';
        }

        if (file_exists('../_html/tags-link.html')) {
            include_once ('../_html/tags-link.html');
        } else {
            echo '<b>ATENÇÃO: </b>Não foi possivel localizar tags-link.html!';
        }
    }

    function renderHeader() {
        if (file_exists('../_html/header.html')) {
            include ('../_html/header.html');
        } else {
            echo "<b>Atenção:</b> Não foi possviel localizar elemento <b>nav-top</b>!";
        }

    }

    function renderMain($viewDir, $viewName) {
        /*if (file_exists('../_html/menu-lateral.html')) {
            include ('../_html/menu-lateral.html');
        } else {
            echo "<b>Atenção:</b> Não foi possviel localizar elemento <b>menu-lateral</b>!";
        }*/

        if (file_exists('../../../app/view/painel/' . $viewDir . '/' . $viewName . '.php')) {
            include ('../../../app/view/painel/' . $viewDir . '/' . $viewName . '.php');
        } else {
            echo "<b>Atenção:</b> Não foi possviel localizar elemento <b>main-index</b>!";
        }
    }

    function renderFooter() {
        if (file_exists('../_html/footer.html')) {
            include ('../_html/footer.html');
        } else {
            echo "<b>Atenção:</b> Não foi possviel localizar elemento <b>footer</b>!";
        }
    }

    function renderModal($array) {

        foreach ($array as $chave => $valor) {
            if (file_exists('../_html/' . $valor . '.html')) {
                include ('../_html/' . $valor . '.html');
            } else {
                echo "<b>Atenção:</b> Não foi possviel localizar elemento <b> '.$valor.'</b>!";
            }
        }
    }

    function renderScripts($array) {
        if (file_exists('../_html/tags-script.html')) {
            include_once ('../_html/tags-script.html');
        } else {
            echo '<b>ATENÇÃO: </b>Não foi possivel localizar tags-script.html em public_html/painel/usuarios/cadastrar.php!';
        }

        foreach ($array as $chave => $valor) {

            if (file_exists('../_ajax/Controller' . $valor . '.js')) {
                echo "<script type='text/javascript' src='../_ajax/Controller" . $valor . ".js'></script>";
            } else {
                echo "<b>ATENÇÃO: </b>Não foi possivel localizar Controller" . $valor . ".js";
            }
        }
    }

    function renderScriptsOnload($arrayAssocBidimensional) {

        echo "<script>";
        foreach ($arrayAssocBidimensional as $key => $row) {
            foreach ($row as $i => $a) {
                echo $key . "('" . $a . "');";
            }
        }
        echo "</script>";
    }

}
