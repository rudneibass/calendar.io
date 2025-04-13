<?php

session_start();

require_once '../../config/header.php';
require_once '../../app/model/ClassModel.php';
require_once '../../app/model/MasterClassModel.php';
require_once '../../app/model/ClassAbstractDB.php';

class ControllerMigrate {

    public function migrate()
    {
        $db = new ClassModel();
        $master_db = new MasterClassModel();
        $abstract_db = new ClassAbstractDB();
        $output = 'Atualizações concluidas!<br/>';
        
        $selectEntidade = $db->select('*', 'entidade ', '', array());
        $entidade = $selectEntidade->fetch(\PDO::FETCH_ASSOC);

        $selectMasterEntidade = $master_db->select('* ', 'master_entidade ', 'WHERE cnpj=?', array($entidade['cnpj']));
        $masterEntidade = $selectMasterEntidade->fetch(\PDO::FETCH_ASSOC);

        $selectMigrations = $master_db
        ->select('* ', 
                'master_migrations ', 
                'WHERE ativo = "S" 
                 AND id NOT IN 
                 (SELECT id_migration FROM master_migrations_entidades WHERE cnpj_entidade = '.$entidade['cnpj'].') 
                 ORDER BY criado_em', 
                array()
            );
           
        $migrations = $selectMigrations->fetchAll();

        if(count($migrations) == 0){
            echo json_encode(array('output' => 'Não há atualizações pendentes.<br/> Clique em OK para continuar.'));
            return true;
        }

        foreach ($migrations as $data) {
            try {

                $abstract_db->query($data['query']);

                $master_db->
                insert(array(
                        'id_migration' => $data['id'],  
                        'id_entidade' => $masterEntidade['id'],
                        'cnpj_entidade' => $entidade['cnpj'],
                        'nome_entidade' => $entidade['razao_social'],
                        'atualizado' => 'S' 
                        ), 
                        'master_migrations_entidades'
                    );

            } catch (\PDOException $e) {
                $output .= '<hr/><h6>Erro ao tentar executar a seguinte atualização. (Clique em OK para ignorar)</h6><hr/><b>Id da consulta: </b>'.$data['id'].'<br/><b style="display: none">Consulta: </b><p style="display: none">'.$data['query'].'</p><br/> <br/><b>Erro: </b> '.$e->getCode().$e->getMessage().'<br/><br/>';
            }

       };
       
       $output .= 'Clique em OK para continuar.';

       echo json_encode(array('output' => $output), JSON_PRETTY_PRINT);
       return true;
    }
}

