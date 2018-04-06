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

        $dbname = "";
        $username = "";
        $password = "";

        return [
            'dsn'=>'mysql:host=localhost;dbname='.$dbname.';',
            'username'=>$username,
            'password'=>$password
        ];

    }
    
}
