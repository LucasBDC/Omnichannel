<?php

class DatabaseHelper{
    private static $servername = 'localhost';
    private static $username = 'root';
    private static $password = '';  
    private static $dbname = 'omni';

    public static $conn;

    public static function init(){
        if(self::$conn == null){
            try{
                self::$conn = new PDO("mysql=host".self::$servername.";dbname=".self::$dbname.";", self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(Exception $ex){
                throw new Exception('something happened');
            }
        }
    }

}