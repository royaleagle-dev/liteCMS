<?php

class Database {
    private $host = HOST;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $database = DATABASE;
    private $dbObject;

    public function __construct(){

        $dsn = "mysql:host=".$this->host.";dbname=".$this->database;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];
        try{
            $this->dbObject = new PDO($dsn, $this->username, $this->password, $options);
        }catch(PDOException $e){
            print "<b>Database Error: </b> ".$e->getMessage();
        }
    }

    public function query($sql, $params = array(), $fetchMode = ''){
        $handler = $this->dbObject;
        $statement = $handler->prepare($sql);
        $statement->execute($params);
        if($fetchMode == ''){
            return $statement;
        }
        return $statement->$fetchMode();
        //return $result;
    }
}
?>