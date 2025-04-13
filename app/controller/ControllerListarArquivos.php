<?php
session_start();
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerListarArquivos {

    private $table;
    private $id;

    function teste() {
        echo 'function teste() Listar Arquivos Controller';
    }

    public function listarImagens() {
        $prep = "WHERE tabela_pai = '" . $this->getTable() . "' AND id_tabela_pai =" . $this->getId() . "";
        $crud = new ClassModel();
        $result = $crud->select('*', 'arquivos', ' ' . $prep, array());

        foreach ($result as $data) {
            echo '  <div class="col-md-2" id="tr' . $data['id'] . '">
                     <div class="card">
                        <div class="card-body p-0">
                            <a href="../multimidia/cadastro.php?id=' . $data['id'] . '" target="_blank"><img class="card-img-top" src="' . $data['caminho_absoluto'] . '"></a>
                        </div>
                        <div class="card-footer p-1">
                            <button class="btn btn-danger btn-sm"  onclick="deletarImagem(' . $data['id'] . ', ' . $data['id_tabela_pai'] . ', \'' . $data['tabela_pai'] . '\')"><i class="fa fa-trash"></i></button>
                            <small>' . $data['nome'] . '</small>    
                        </div>    
                    </div>
                </div>';
        }
    }

    /*public function deletarImagem() {

        $val = new ClassValidacao();
        $val->set($_POST['id_tabela_pai'], '"ID não Informado"')->obrigatorio();

        if ($val->validar()) {
            $id = $this->getId();
            $crud = new ClassModel();
            $delete = $crud->delete('arquivos', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }*/
    
    
    public function excluirArquivo() {
        $val = new ClassValidacao();
        $val->set($_POST['id'], '"ID não Informado"')->obrigatorio();

        if ($val->validar()) {
            $crud = new ClassModel();
            $delete = $crud->delete('arquivos', ' WHERE id=?', array($_POST['id']));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }
    
        function listarArquivos() {
            $prep = "WHERE tabela_pai = '" . $this->getTable() . "' AND id_tabela_pai =" . $this->getId() . ""
                    . (isset($_POST["c1"]) && !empty($_POST["c1"]) ? " AND nome LIKE '%" . filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_SPECIAL_CHARS)."%'" : "")
                    . (isset($_POST["c2"]) && !empty($_POST["c2"]) ? " AND data BETWEEN '" . filter_input(INPUT_POST, 'c2', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'c3', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY id DESC";
    
            $crud = new ClassModel();
            $select = $crud->select("*,DATE_FORMAT(data,'%d/%m/%Y') as data", 'arquivos ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
      
    }
    

    public function getTable() {
        return $this->setTable();
    }
    public function getId() {
        return $this->setId();
    }


    public function setTable() {
        return $this->table = filter_input(INPUT_POST, 'tabela_pai', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    public function setId() {
        return $this->id = filter_input(INPUT_POST, 'id_tabela_pai', FILTER_SANITIZE_SPECIAL_CHARS);
    }

}
