<?php

require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerCaixaDeEntrada {

    function ouvidoria() {

        if (isset($_GET['id'])) {
            $prep = "WHERE o_id=" . filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*', 'ouvidoria ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {
            $prep = "WHERE 1=1 "
                    . (isset($_POST["o_id"]) && !empty($_POST["o_id"]) ? " AND o_id =" . filter_input(INPUT_POST, 'o_id', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["o_nome"]) && !empty($_POST["o_nome"]) ? " AND o_nome LIKE '%" . filter_input(INPUT_POST, 'o_nome', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["o_data_ini"]) && !empty($_POST["o_data_ini"]) ? " AND o_data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'o_data_ini', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'o_data_fim', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY o_id DESC";

            $crud = new ClassModel();
            $select = $crud->select("*", 'ouvidoria ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    function esic() {
        $prep = "WHERE 1=1 "
                . (isset($_POST["o_id"]) && !empty($_POST["o_id"]) ? " AND o_id =" . filter_input(INPUT_POST, 'o_id', FILTER_SANITIZE_NUMBER_INT) : "")
                . (isset($_POST["o_nome"]) && !empty($_POST["o_nome"]) ? " AND o_nome LIKE '%" . filter_input(INPUT_POST, 'o_nome', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                . (isset($_POST["o_data_ini"]) && !empty($_POST["o_data_ini"]) ? " AND o_data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'o_data_ini', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'o_data_fim', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                . " ORDER BY o_id DESC";

        $crud = new ClassModel();
        $select = $crud->select("*", 'esic_solicitacao ', '', array());
        $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    function enviadas() {
        $prep = "WHERE 1=1 "
                . (isset($_POST["o_id"]) && !empty($_POST["o_id"]) ? " AND o_id =" . filter_input(INPUT_POST, 'o_id', FILTER_SANITIZE_NUMBER_INT) : "")
                . (isset($_POST["o_nome"]) && !empty($_POST["o_nome"]) ? " AND o_nome LIKE '%" . filter_input(INPUT_POST, 'o_nome', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                . (isset($_POST["o_data_ini"]) && !empty($_POST["o_data_ini"]) ? " AND o_data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'o_data_ini', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'o_data_fim', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                . " ORDER BY data";

        $crud = new ClassModel();
        $select = $crud->select("*", 'enviadas ', '', array());
        $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
        echo json_encode($result, JSON_PRETTY_PRINT);
    }


}
