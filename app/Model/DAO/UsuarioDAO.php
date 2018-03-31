<?php

namespace App\Model\DAO;


use App\Aux\Connection,
    App\Model\Usuario,
    PDO;

class UsuarioDAO {

    private $con;
    
    function __construct(){
        $this->con = Connection::getConnection();
    }
    
    public function updateUser(Usuario $u){

        $sql = "UPDATE usuario set 
                u_nome_de_usuario = ?,
                u_email = ?,
                u_senha = ?
                WHERE u_id = ?";

        $username = $u->getNome_de_usuario();
        $email = $u->getEmail();
        $password = $u->getSenha();
        $id = $u->getId();

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$username);
        $ps->bindParam(2,$email);
        $ps->bindParam(3,$password);
        $ps->bindParam(4,$id);
        
        return $ps->execute();


    }

    public function findUser($id){
        
        $usuario = null;
        
        $sql = "select u_nome, u_nome_de_usuario, u_email
                from usuario where u_id = ?";
        
        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$id);
        
        if($ps->execute()){
        
            if($row = $ps->fetch(PDO::FETCH_OBJ)){
                    
                $usuario = new Usuario($id, $row->u_nome, $row->u_nome_de_usuario, $row->u_email, null);
            
            }
        }
        
        return $usuario;
        
    }
    
    public function existsUserName($id,$userName){

        $sql = "SELECT count(*) total
                FROM usuario 
                WHERE u_nome_de_usuario = ? and 
                u_id <> ? ";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$userName);
        $ps->bindParam(2,$id);
        $ps->execute();

        return ($ps->fetch(PDO::FETCH_OBJ))->total == 1;
        

    }

    public function existsEmail($id,$email){

        $sql = "SELECT count(*) total
                FROM usuario 
                WHERE u_email = ? and 
                u_id <> ? ";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$email);
        $ps->bindParam(2,$id);
        $ps->execute();

        return ($ps->fetch(PDO::FETCH_OBJ))->total == 1;
        

    }

    public function verifyPassword($id,$pwd){

        $sql = "SELECT count(*) total
                FROM usuario 
                WHERE u_senha = ? and 
                u_id = ? ";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$pwd);
        $ps->bindParam(2,$id);
        $ps->execute();

        return ($ps->fetch(PDO::FETCH_OBJ))->total == 1;

    }
}
