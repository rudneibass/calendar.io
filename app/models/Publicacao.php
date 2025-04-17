<?php
require_once 'DB.php';

class Publicacao extends DB {
    private $table = 'publicacoes';

    public function getMessages(string $dataInicio, string $dataFim) {
        return $this->rawQuery(
            "SELECT *, DATE_FORMAT(data_publicacao, '%d/%m/%Y') as data_formatada FROM {$this->table} ", 
            array($dataInicio, $dataFim)
        );
    }
}