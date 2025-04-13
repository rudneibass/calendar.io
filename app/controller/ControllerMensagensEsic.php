<?php
session_start();
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerMensagensEsic {

    function esic() {

        if (isset($_GET['id'])) {
        
            $prep = "WHERE es.id=" . filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('*, DATE_FORMAT(data_cadastro, "%d/%m/%Y") as data_cadastro_formatada', 'esic_solicitacao  ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        
        } else {
            
            $prep = "WHERE 1=1 "
                    . (isset($_POST["id"]) && !empty($_POST["id"]) ? " AND id =" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) : "")
                    . (isset($_POST["nome"]) && !empty($_POST["nome"]) ? " AND nome LIKE '%" . filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                    . (isset($_POST["data_ini"]) && !empty($_POST["data_ini"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'data_ini', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'o_data_fim', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                    . " ORDER BY id DESC";

            $crud = new ClassModel();
            $select = $crud->select("*, DATE_FORMAT(data_cadastro, '%d/%m/%Y') as data_cadastro_formatada", 'esic_solicitacao ', $prep, array());
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }

    function respostasEsic() {

        $prep = "WHERE 1=1 "
                . (isset($_POST["id"]) && !empty($_POST["id"]) ? " AND id =" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) : "")
                . (isset($_POST["nome"]) && !empty($_POST["nome"]) ? " AND o_nome LIKE '%" . filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS) . "%'" : "")
                . (isset($_POST["data_ini"]) && !empty($_POST["data_ini"]) ? " AND data_cadastro BETWEEN '" . filter_input(INPUT_POST, 'data_ini', FILTER_SANITIZE_SPECIAL_CHARS) . "' AND '" . filter_input(INPUT_POST, 'o_data_fim', FILTER_SANITIZE_SPECIAL_CHARS) . "'" : "")
                . " ORDER BY id DESC";

        $crud = new ClassModel();
        $select = $crud->select("*, DATE_FORMAT(data, '%d/%m/%Y') as data, SUBSTRING(`mensagem_resposta`, 1, 150) as mensagem_resposta", 'esic_respostas ', $prep, array());
        $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    function vizualizarEnviadasEsic() {

        $prep = "WHERE id=" . filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
        $crud = new ClassModel();
        $select = $crud->select('*, DATE_FORMAT(data, "%d/%m/%Y") as data', 'esic_respostas  ', $prep, array());
        $result = $select->fetchAll(); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY >> N Ã O << ASSOCIATIVO. 
        foreach ($result as $data) {
            echo '<div>     
                        <div class="corpo-msg">
                            <span class="span-14">---------- Mensagem enviada ---------</span><br/>
                            <span class="span-14">Enviado:&nbsp;' . $data['data'] . '</span><br/>
                            <span class="span-14" >Protocolo:&nbsp;</span>00000' . $data['id_esic'] . '<br/><br/>
                            <span>' . $data['mensagem_resposta'] . '</span>
                        </div>   
                  </div>';
        }
    }


    function changeStatus(){
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        $table = 'ouvidoria';
        $post['status'] = '1';
        $crud = new ClassModel();
        $crud->update($table, $post, $id);
    }

    public function enviarResposta() {

        $val = new ClassValidacao();
        $val->set($_POST['mensagem_resposta'], '<b>Mensagem de Resposta</b>')->obrigatorio();
        $val->set($_POST['id_esic'], '<b>FK não localizado!</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            
            $crud = new ClassModel();

            $select = $crud->select('id_usuario', 'esic_solicitacao', 'WHERE id = '.$post['id_esic'], array());
            $result = $select->fetchAll(); 


            foreach ($result as $item) {
                $post['id_usuario'] = $item['id_usuario'];
            }


            $post['data'] = date("Y/m/d h:i:s");
            
            print $crud->Insert($post, 'ouvidoria_respostas');
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

}
