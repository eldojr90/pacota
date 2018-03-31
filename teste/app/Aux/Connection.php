<?php

namespace App\Aux;

use PDO;

class Connection{

    public static function getConnection(){
        
        $con = null;

        $ar = Connection::argsData();

        try{
            
             $con = new PDO($ar["dsn"], $ar["username"], $ar["password"]);
            
        } catch (Exception $ex) {
            
            $ex->getMessage();
            
        }

        return $con;
    }

    public static function argsData(){

        $dbname = "id4828640_eliana";
        $username = "id4828640_eldo";
        $password = "elisa010612";

        if($_SERVER["SERVER_NAME"]=="localhost" 
        || $_SERVER["SERVER_NAME"]=="eldo-junior" 
        || $_SERVER["SERVER_NAME"]=="ELDO-JUNIOR" 
        || $_SERVER["SERVER_NAME"]=="127.0.0.1"
        || $_SERVER["SERVER_NAME"]=="192.168.0.20"
        || $_SERVER["SERVER_NAME"]=="192.168.1.4"
        || $_SERVER["SERVER_NAME"]=="192.168.25.94"){

            $dbname = "eliana";
            $username = "root";
            $password = "";
            
        }

        return [
            'dsn'=>'mysql:host=localhost;dbname='.$dbname.';',
            'username'=>$username,
            'password'=>$password
        ];

    }
    
}