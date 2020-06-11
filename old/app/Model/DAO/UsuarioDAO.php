<?php

namespace App\Model\DAO;


use App\Aux\Connection,
    App\Model\Usuario,
    App\Util\Crypt,
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

    public function login($usemail,$pwd){
        
        $email2 = $usemail.".br";
        
        $sql = "SELECT u_id 
                FROM usuario 
                WHERE ( u_nome_de_usuario = ? or (u_email = ? or u_email = ?) ) 
                and u_senha = ?";
        
        $ps = $this->con->prepare($sql);
        $ps->bindParam(1, $usemail);
        $ps->bindParam(2, $usemail);
        $ps->bindParam(3, $email2);
        $ps->bindParam(4, $pwd);
        $ps->execute();

        return $ps;

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

    public function findUserByUsEmail($usemail){
        
        $usuario = null;
        
        $usemailbr = "$usemail.br";

        $sql = "SELECT * 
                FROM usuario
                WHERE u_nome_de_usuario = ? or 
                (u_email = ? or u_email = ?)";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$usemail);
        $ps->bindParam(2,$usemail);
        $ps->bindParam(3,$usemailbr);
        $ps->execute();

        $row = $ps->fetch(PDO::FETCH_OBJ);

        
        if($ps->execute()){
        
            if($row = $ps->fetch(PDO::FETCH_OBJ)){
                    
                $usuario = new Usuario($row->u_id, $row->u_nome, $row->u_nome_de_usuario, $row->u_email, null);
            
            }
        }
        
        return $usuario;
        
    }

    public function findUserBytoken($token){

        $u = null;

        $sql = "SELECT * FROM usuario;";
        
        $st = $this->con->query($sql);

        while($rs = $st->fetch(PDO::FETCH_OBJ)){

            $id = $rs->u_id;
            $un = $rs->u_nome_de_usuario;
            $em = $rs->u_email;

            $str = $id.":".$un.":".$em;

            if($token == Crypt::encryptMD5($str)){

                $u = new Usuario($rs->u_id,$rs->u_nome,$rs->u_nome_de_usuario,$rs->u_email,null);
                break;
                
            }

        }

        return $u;

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

        $email2 = $email.".br";

        $sql = "SELECT count(*) total
                FROM usuario 
                WHERE (u_email = ? or u_email = ?) and 
                u_id <> ? ";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$email);
        $ps->bindParam(2,$email2);
        $ps->bindParam(3,$id);
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

    public function verifyUserEmail($usemail){

        $usemailbr = "$usemail.br";

        $sql = "SELECT count(*) total 
                FROM usuario
                WHERE u_nome_de_usuario = ? or 
                (u_email = ? or u_email = ?)";

        $ps = $this->con->prepare($sql);
        $ps->bindParam(1,$usemail);
        $ps->bindParam(2,$usemail);
        $ps->bindParam(3,$usemailbr);
        $ps->execute();

        return ($ps->fetch(PDO::FETCH_OBJ))->total == 1;

    }
    
    public function genTokenByUser(Usuario $u){

        $str = $u->getId().":".$u->getNome_de_usuario().":".$u->getEmail();

        return Crypt::encryptMD5($str);
    }
}

