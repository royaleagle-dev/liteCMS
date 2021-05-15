<?php

class Database{
    
    //change this when in production
    private static $host = 'localhost';
    public static $database = '';
    private static $username = 'root';
    private static $password = '';
    //-------------------------------
    
    public static function connect(){
        $settings = parse_ini_file("settings.ini");
        $dbase_name = $settings['dbase_name'];
        self::$database = $dbase_name;
        $dsn = "mysql:host=".self::$host.";dbname=".self::$database;
        $pdo = new PDO($dsn, self::$username, self::$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
        return $pdo;
        
    }
    
    public static function query($query, $params, $fetchmode=''){

        $query = self::connect()->prepare($query);
        $query->execute($params);

        if ($fetchmode){
            return $query->$fetchmode();
        }

    }
}

?>