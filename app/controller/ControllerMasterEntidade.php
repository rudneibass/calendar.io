<?php



session_start();

require_once '../../config/header.php';

require_once '../../app/model/MasterClassModel.php';

require_once '../../app/model/ClassValidacao.php';



class ControllerMasterEntidade {





    function locate() {



        if (isset($_POST['id'])) {



            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";

            $crud = new MasterClassModel();

            $select = $crud->select('* ', 'master_entidade ', $prep, array());

            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.

            echo json_encode($result, JSON_PRETTY_PRINT);

        } else {



            $prep = "WHERE 1=1 "

                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")

                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND razao_social LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")

                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")

                    . " ORDER BY data_cadastro";



            $crud = new MasterClassModel();

            $select = $crud->select("*, DATE_FORMAT(data_cadastro, '%d/%m/%Y') as data_cadastro", 'master_entidade ', $prep, array());

            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO

            echo json_encode($result, JSON_PRETTY_PRINT);

        }

    }



    public function update() {

        $val = new ClassValidacao();

        $val->set($_POST['razao_social'], 'Razão Social')->obrigatorio();

        $val->set($_POST['sigla'], 'Sigla')->obrigatorio();

        $val->set($_POST['dominio'], 'Domínio')->obrigatorio();



        $val->validarCnpj($_POST['cnpj']);




        if ($val->validar()) {

            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            if (!isset($post['manutencao'])) {

                $post['manutencao'] = 'off';
    
            }

            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            $crud = new MasterClassModel();

            $update = $crud->update('master_entidade ', $post, $id);

        } else {

            foreach ($val->getErrors() as $erro) {

                echo "$erro <br />";

            }

        }

    }



    public function insert() {



        $val = new ClassValidacao();

        $val->set($_POST['razao_social'], 'Razão Social')->obrigatorio();

        $val->set($_POST['tipo'], 'Tipo')->obrigatorio();

        $val->set($_POST['logradouro'], 'Endereço')->obrigatorio();

        $val->set($_POST['numero'], 'Nº')->obrigatorio();

        $val->set($_POST['cidade'], 'Cidade')->obrigatorio();

        $val->set($_POST['uf'], 'UF')->obrigatorio();

        $val->validarCnpj($_POST['cnpj']);



        if ($val->validar()) {

            $crud = new MasterClassModel();

            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            if (!isset($post['manutencao'])) {

                $post['manutencao'] = 'off';
    
            }

            $post['data_cadastro'] = date("Y/m/d h:i:s");

            $post['usuario'] = $_SESSION['USUARIO'];

            print $crud->insert($post, 'master_entidade ');

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

            $delete = $crud->delete('master_entidade ', ' WHERE id=?', array($id));

        } else {

            foreach ($val->getErrors() as $erro) {

                echo "$erro <br />";

            }

        }

    }*/



}

