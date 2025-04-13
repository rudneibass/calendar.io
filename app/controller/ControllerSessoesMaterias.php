<?php

session_start();
require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/ClassValidacao.php';

class ControllerSessoesMaterias {


    function locate() {

        if (isset($_GET['id'])) {

            $prep = "WHERE id=" . filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) . " ";
            $crud = new ClassModel();
            $select = $crud->select('* ', 'sessoes_materias ', $prep, array());
            $result = $select->fetch(\PDO::FETCH_ASSOC); // A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY ASSOCIATIVO.
            echo json_encode($result, JSON_PRETTY_PRINT);
        } else {
            $crud = new ClassModel();
            $select = 
            $crud
            ->select(
                "t1.*
                , t2.descricao
                , t2.exercicio
                , t2.numero
                , t2.tipo ", 
                "sessoes_materias t1 
                    LEFT JOIN materias t2 ON t1.id_materias = t2.id ", 
                "WHERE t1.id_sessoes = " . $_POST['id'] . " ORDER BY t1.ordem", 
                array()
            );
            $result = $select->fetchAll();  //A T E N Ç Ã O !!! AQUI O PDO MONTA UM ARRAY  >>N Ã O<<  ASSOCIATIVO
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }


    public function update() {

        $val = new ClassValidacao();
        $val->set($_POST['id_materias'], '<b>Matéria</b>')->obrigatorio();
        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if ($val->validar()) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $post['tbl'] = 'sessoes_materias';

            $crud = new ClassModel();
            $crud->update('sessoes_materias ', $post, $id);
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }


    public function insert() {

        $val = new ClassValidacao();
        $val->set($_POST['id_materias'], '<b>MAtéria</b>')->obrigatorio();

        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $post['data_cadastro'] = date("Y/m/d h:i:s");
            $post['tbl'] = 'sessoes_materias';

            $crud = new ClassModel();
            print $crud->insert($post, 'sessoes_materias ');
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function delete() {

        $val = new ClassValidacao();
        $val->set($_POST['id'], '"Id não Informado"')->obrigatorio();

        if ($val->validar()) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $crud = new ClassModel();
            $delete = $crud->delete('sessoes_materias ', ' WHERE id=?', array($id));
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function importarJson() {
        if ($_FILES['jsonFile']['error'] == UPLOAD_ERR_OK) {
            $jsonData = file_get_contents($_FILES['jsonFile']['tmp_name']);
            $jsonData = json_decode($jsonData, true);
            $db = new ClassModel();

            $exemplo = '
            {
                "id_sessao": 3,
                "id_materias": "35",
                "titulo": "MOÇÃO DE PESAR Nº 016/2016",
                "status": "FAVORÁVEL",
                "data": "",
                "autor": "",
                "link": "../materias/35"
              },
            ';

            if ($jsonData !== null) {
                
                $db->delete('sessoes_materias ', ' ', array());

                foreach($jsonData as $item){
                    $post['id_materias'] = $item['id_materias'];
                    $post['id_sessoes'] = $item['id_sessao'];            

                    $post['data_cadastro'] = date("Y/m/d h:i:s");
                    $post['tbl'] = 'sessoes_materias';
                    
                    $id = $db->insert($post, 'sessoes_materias ');
                }

                echo 'Arquivo importado com sucesso!';

            } else {
              echo "Erro ao decodificar o JSON.";
            }
          } else {
            echo "Erro ao receber o arquivo JSON.";
          }
    } 


    public function mudaOrdem() {
        $val = new ClassValidacao();
        $val->set($_POST['id'], '<b>ID do Registro</b>')->obrigatorio();
        $val->set($_POST['id_sessoes'], '<b>Sessão ID</b>')->obrigatorio();
        $val->set($_POST['nova_ordem'], '<b>Nova Ordem</b>')->obrigatorio();
    
        if ($val->validar()) {
            $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $id = $post['id'];
            $id_sessoes = $post['id_sessoes'];
            $nova_ordem = (int)$post['nova_ordem'];
    
            $databse = new ClassModel();
            $select = $databse->select("ordem", "sessoes_materias", "WHERE id = ? AND id_sessoes = ?", [$id, $id_sessoes]);
            $registro = $select->fetch(\PDO::FETCH_ASSOC);

            if (empty($registro)) {
                echo "Registro não encontrado.";
                return;
            }
    
            $ordem_atual = (int)$registro['ordem'];
            
            if ($nova_ordem == $ordem_atual) {
                echo "A nova ordem é igual à ordem atual. Nenhuma alteração necessária.";
                return;
            }
    
            if ($nova_ordem < $ordem_atual) {
                $databse->executeQuery(
                    "UPDATE sessoes_materias 
                     SET ordem = ordem + 1 
                     WHERE id_sessoes = :id_sessoes 
                     AND ordem >= :nova_ordem 
                     AND ordem < :ordem_atual",
                    [
                        ':id_sessoes' => $id_sessoes,
                        ':nova_ordem' => $nova_ordem,
                        ':ordem_atual' => $ordem_atual
                    ]
                );
            }
            
            if ($nova_ordem > $ordem_atual) {
                $databse->executeQuery(
                    "UPDATE sessoes_materias 
                     SET ordem = ordem - 1 
                     WHERE id_sessoes = :id_sessoes 
                     AND ordem <= :nova_ordem 
                     AND ordem > :ordem_atual",
                    [
                        ':id_sessoes' => $id_sessoes,
                        ':nova_ordem' => $nova_ordem,
                        ':ordem_atual' => $ordem_atual
                    ]
                );
            }
    
            $databse->update('sessoes_materias', ['ordem' => $nova_ordem], $id);
            echo "Ordem atualizada com sucesso!";
        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function abrirVotacao(){
        $val = new ClassValidacao();
        $val->set($_POST['id'], '<b>ID do Registro</b>')->obrigatorio();

        if ($val->validar()) {
            
            $databse = new ClassModel();
            $databse->executeQuery("UPDATE sessoes_materias SET aberto = :aberto", array(':aberto' => 'N'));
            $databse->executeQuery("UPDATE sessoes_materias SET aberto = :aberto WHERE id = :id", array(':aberto' => 'S', ':id' => $_POST['id']));
            
            echo "Operação realizada com sucesso!";

        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

    public function fecharVotacao(){
        $val = new ClassValidacao();
        $val->set($_POST['id'], '<b>ID do Registro</b>')->obrigatorio();

        if ($val->validar()) {
            
            $databse = new ClassModel();
            $databse->executeQuery("UPDATE sessoes_materias SET aberto = 'N' WHERE id = :id", array(':id' => $_POST['id']));
            
            echo "Operação realizada com sucesso!";

        } else {
            foreach ($val->getErrors() as $erro) {
                echo "$erro <br />";
            }
        }
    }

}
