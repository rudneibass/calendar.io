<?php
require_once 'DB.php';

class Message extends DB {
    private $table = 'messages';

    public function create($data){
        $this->rawQuery(
            'INSERT INTO '.$this->table.' (message, type) VALUES (:message, :type)', 
            array(
            ':message' => $data['message'],
            ':type' => 'text'
            )
        ); 
    }
}