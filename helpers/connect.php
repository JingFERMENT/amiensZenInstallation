<?php
require_once __DIR__ . '/../config/init.php';

class Database
{

    private static $pdo;

    public static function connect()
    {
        
        if(!self::$pdo){
            self::$pdo = new PDO(DSN, LOGIN, PASSWORD);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }

        return self::$pdo;
    }
}