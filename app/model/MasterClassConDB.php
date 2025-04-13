<?php

if (file_exists('../../config/config.php')) {
    require_once '../../config/config.php';
} else {
    echo '<b>ATENÇÃO: </b>Não foi possivel localizar config.php em ClassConDB.php!';
}


 abstract class MasterClassConDB {

    private static $pdo;
    private $exeptions;
    private $exeption = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);
    private function setConn() {
        return
                is_null(self::$pdo) ?
                self::$pdo = new  \PDO(''.M_DB_TYPE.':host='.M_DB_HOST.';dbname='.M_DB_NAME.'', ''.M_DB_USER.'',''.M_DB_PASS.'',$this->exeption): 
                #PDO('pgsql:host=localhost;dbname=banco', 'postgres','1t4rg3t',$this->exeption):
                self::$pdo;
    }

    public function getConn() {
        return $this->setConn();
    }

}

#$pdo = new ConDB();
#$pdo ->getConn();