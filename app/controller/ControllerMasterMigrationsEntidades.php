<?php
session_start();
require_once '../../config/header.php';
require_once '../../app/model/MasterClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerMasterMigrationsEntidades {

    function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new MasterClassModel();
            $select = $crud->select('* ', 'master_migrations_entidades mm left join migrations m on m.id = mm.id_migrations  ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "

                    . (isset($_POST["id"]) && !empty($_POST["id"]) ? " AND t1.id =" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["script"]) && !empty($_POST["script"]) ? " AND t1.script LIKE '%" . filter_input(INPUT_POST, 'script', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["data_inicial"]) && !empty($_POST["data_inicial"]) ? " AND t1.criado_em BETWEEN '" . filter_input(INPUT_POST, 'data_inicial', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'data_final', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY t1.criado_em";

                    
            $crud = new MasterClassModel();
            $select = $crud->select("t1.*, t2.descricao, DATE_FORMAT(t1.criado_em, '%d/%m/%Y') as criado_em ", "master_migrations_entidades t1 left join master_migrations t2 on t2.id = t1.id_migration  ", $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    /*public function delete() {

        $val = new ClassValidacao();
        $val->set($_POST['id'], '"Id não Informado"')->obrigatorio();

        if ($val->validar()) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new MasterClassModel();
            $delete = $crud->delete('master_migrations_entidades ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/
}

