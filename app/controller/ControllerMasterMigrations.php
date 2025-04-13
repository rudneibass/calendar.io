<?php



session_start();

require_once '../../config/header.php';

require_once '../../app/model/MasterClassModel.php';

require_once '../../app/model/ClassValidacao.php';



class ControllerMasterMigrations {





    function locate() {



        if (isset($_POST['id'])) {



            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";

            $crud = new MasterClassModel();

            $select = $crud->select('* ', 'master_migrations ', $prep, array());

            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.

            echo json_encode($result, JSON_PRETTY_PRINT);

        } else {



            $prep = "WHERE 1=1 "

                    . (isset($_POST["id"]) && !empty($_POST["id"]) ? " AND id =" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) : "")

                    . (isset($_POST["script"]) && !empty($_POST["script"]) ? " AND script LIKE '%" . filter_input(INPUT_POST, 'script', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")

                    . (isset($_POST["data_inicial"]) && !empty($_POST["data_inicial"]) ? " AND criado_em BETWEEN '" . filter_input(INPUT_POST, 'data_inicial', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'data_final', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")

                    . " ORDER BY criado_em DESC";



            $crud = new MasterClassModel();

            $select = $crud->select("*, DATE_FORMAT(criado_em, '%d/%m/%Y') as criado_em", 'master_migrations ', $prep, array());

            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO

            echo json_encode($result, JSON_PRETTY_PRINT);

        }

    }



    public function update() {

        $val = new ClassValidacao();

        $val->set($_POST['descricao'], 'Descrição')->obrigatorio();

        $val->set($_POST['query'], 'Query')->obrigatorio();



        if ($val->validar()) {

            $post = filter_var_array($_POST);

            if(isset($_POST['ativo'])){
                $post['ativo'] = 'S';
            }

            if(!isset($_POST['ativo'])){
                $post['ativo'] = 'N';
            }

            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            $crud = new MasterClassModel();

            $update = $crud->update('master_migrations ', $post, $id);

        } else {

            foreach ($val->getErrors() as $erro) {

                echo "$erro <br />";

            }

        }

    }



    public function insert() {



        $val = new ClassValidacao();

        $val->set($_POST['descricao'], 'Descrição')->obrigatorio();

        $val->set($_POST['query'], 'Query')->obrigatorio();



        if ($val->validar()) {

            $crud = new MasterClassModel();

            $post = filter_var_array($_POST);

            if(isset($_POST['ativo'])){
                $post['ativo'] = 'S';
            }

            if(!isset($_POST['ativo'])){
                $post['ativo'] = 'N';
            }

            print $crud->insert($post, 'master_migrations ');

        } else {

            foreach ($val->getErrors() as $erro) {

                echo "$erro <br />";

            }

        }

    }



    /*public function delete() {



        $val = new ClassValidacao();

        $val->set($_POST['id'], '"Id não Informado"')->obrigatorio();



        if ($val->validar()) {

            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            $crud = new MasterClassModel();

            $delete = $crud->delete('master_migrations ', ' WHERE id=?', array($id));

        } else {

            foreach ($val->getErrors() as $erro) {

                echo "$erro <br />";

            }

        }

    }*/
}

