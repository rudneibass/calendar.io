<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerEntidade {

    private $razaoSocial;
    private $cnpj;

    public function teste() {
        echo 'function teste() ControllerEntidade Controller';
    }

    public function razaoSocial() {
        $crud = new ClassModel();
        $select = $crud->select('razao_social, cnpj, dominio, fone_1 ', 'entidade ', '', array());
        $result = $select->fetchAll();
        foreach ($result as $data) {
            $this->razaoSocial = $data['razao_social'];
            $this->cnpj = $data['cnpj'];
        }
        
       echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function locate() {

        if (isset($_POST['id'])) {

            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('bairro,
									cargo_gestor,
									cep,
									cidade,
									cnpj,
									complemento,
									data_cadastro,
									dominio,
									email,
									facebook,
									fone_1,
									fone_2,
									geolocalizacao,
									gestor,
									horario_funcionamento,
									id,
									instagram,
									logo,
									logradouro,
									nome,
									numero,
									razao_social,
									tbl,
									tipo,
									twitter,
									uf,
									usuario,
									whatsapp,
									youtube,
                                    url_storage,
                                    dir_arquivos,
                                    dir_imagens ', 'entidade ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {

            $prep = "WHERE 1=1 "
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND id =" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND razao_social LIKE '%" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["c3"]) && !empty($_POST["c3"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c4', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY data_cadastro";

            $crud = new ClassModel();
            $select = $crud->select("*, DATE_FORMAT(data_cadastro, '%d/%m/%Y') as data_cadastro", 'entidade ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['razao_social'], '<b>"Razão Social"</b>')->obrigatorio();
        $val->set($_POST['nome'], '<b>"Nome Fantasia"</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>"Tipo"</b>')->obrigatorio();
        $val->set($_POST['gestor'], '<b>"Gestor"</b>')->obrigatorio();
        $val->set($_POST['cargo_gestor'], '<b>"Cargo do Gestor"</b>')->obrigatorio();
        $val->set($_POST['logradouro'], '<b>"Endereço"</b>')->obrigatorio();
        $val->set($_POST['numero'], '<b>"Nº"</b>')->obrigatorio();
        $val->set($_POST['cep'], '<b>"CEP"</b>')->obrigatorio();
        $val->set($_POST['cidade'], '<b>"Cidade"</b>')->obrigatorio();
        $val->set($_POST['uf'], '<b>"UF"</b>')->obrigatorio();
        $val->set($_POST['fone_1'], '<b>"Fone 1"</b>')->obrigatorio();
		$val->set($_POST['dominio'],'<b>"Endereço do site da instituição sem http://"</b>')->obrigatorio();
        
		$val->validarCnpj($_POST['cnpj']);

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $post['geolocalizacao'] = $_POST['geolocalizacao'];
            $crud = new ClassModel();
            $update = $crud->update('entidade ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['razao_social'], '<b>"Razão Social"</b>')->obrigatorio();
        $val->set($_POST['nome'], '<b>"Nome Fantasia"</b>')->obrigatorio();
        $val->set($_POST['tipo'], '<b>"Tipo"</b>')->obrigatorio();
        $val->set($_POST['gestor'], '<b>"Gestor"</b>')->obrigatorio();
        $val->set($_POST['cargo_gestor'], '<b>"Cargo do Gestor"</b>')->obrigatorio();
        $val->set($_POST['logradouro'], '<b>"Endereço"</b>')->obrigatorio();
        $val->set($_POST['numero'], '<b>"Nº"</b>')->obrigatorio();
        $val->set($_POST['cep'], '<b>"CEP"</b>')->obrigatorio();
        $val->set($_POST['cidade'], '<b>"Cidade"</b>')->obrigatorio();
        $val->set($_POST['uf'], '<b>"UF"</b>')->obrigatorio();
        $val->set($_POST['fone_1'], '<b>"Fone 1"</b>')->obrigatorio();
		$val->set($_POST['dominio'],'<b>"Endereço do site da instituição sem http://"</b>')->obrigatorio();
		
        $val->validarCnpj($_POST['cnpj']);

        if ($val->validar()) {
            $crud = new ClassModel();
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['usuario'] = $_SESSION['USUARIO'];
            $post['geolocalizacao'] = $_POST['geolocalizacao'];

            print $crud->insert($post, 'entidade ');
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
            $crud = new ClassModel();
            $delete = $crud->delete('entidade ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/

}
