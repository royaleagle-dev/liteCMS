<?php 

class Church{

    private $db;

    public function __construct(){
        require_once "../application/Core/Database.php";
        $this->db = new Database();
        //var_dump($this->db);
    }

    public function getChurches(){
        $statement = $this->db->query("SELECT * FROM churches", $params = array(), $fetchMode = 'fetchAll');
        return $statement;
    }
}

?>