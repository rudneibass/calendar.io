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
                    ''.$_SESSION['DB_TYPE']
                    .':host='.$_SESSION['DB_HOST']
                    .';dbname='.$_SESSION['DB_NAME']
                    .';charset=utf8', 

                    ''.$_SESSION['DB_USER'].'',

                    ''.$_SESSION['DB_PASS'].'',
                    
                    $this->exeption): 
                self::$pdo;
    }

    public function getConn() {
        return $this->setConn();
    }

}

#$pdo = new ConDB();
#$pdo ->getConn();