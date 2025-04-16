<?php

if (file_exists('../../config/config.php')) {
    require_once '../../config/config.php';
} else {
    echo '<b>ATENÇÃO: </b>Não foi possivel localizar config.php em ClassConDB.php!';
}


 abstract class ClassConDB {

    private static $pdo;
    private $exeptions;
    private $exeption = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);
    private function setConn() {
        return
                is_null(self::$pdo) ?
                self::$pdo = new  \PDO(
                    ''.DB_TYPE
                    .':host='.DB_HOST
                    .';dbname='.DB_NAME
                    .';charset=utf8', 

                    ''.DB_USER.'',

                    ''.DB_PASS.'',
                    
                    $this->exeption): 
                self::$pdo;
    }

    public function getConn() {
        return $this->setConn();
    }

}

#$pdo = new ConDB();
#$pdo ->getConn();