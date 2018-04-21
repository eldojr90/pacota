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

        $dbname = "eliana";
        $username = "root";
        $password = "";
        $charset = "utf8";

        return [
            'dsn'=>"mysql:host=localhost;dbname=$dbname;charset=$charset",
            'username'=>$username,
            'password'=>$password
        ];

    }
    
}
