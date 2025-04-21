<?php
require_once 'DB.php';

class Message extends DB {
    private $table = 'messages';

    public function getMessages(string $dataInicio, string $dataFim) {
        return $this->rawQuery(
            "SELECT *, DATE_FORMAT(created_at, '%d/%m/%Y') FROM {$this->table} ", 
            array($dataInicio, $dataFim)
        );
    }

    public function findAllByParams($params = []) {
        return $this->rawQuery(
            "SELECT *, DATE_FORMAT(created_at, '%d/%m/%Y') FROM {$this->table}  WHERE group_id = :group_id AND DATE(created_at) = :created_at", 
            array(
                ':group_id' => $params['group_id'],
                ':created_at' => $params['created_at']
            )
        );
    }

    public function create($data){
        $this->rawQuery(
            'INSERT INTO '
            .$this->table
            .' (message, type, group_id, created_at) VALUES (:message, :type, :group_id, :created_at)', 
            array(
            ':message' => $data['message'],
            ':type' => $data['type'],
            ':group_id' => '1',
            ':created_at' => $data['created_at'],
            )
        ); 
    }
}