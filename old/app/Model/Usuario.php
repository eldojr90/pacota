<?php

namespace App\Model;

class Usuario {
    
    private $id;
    private $nome;
    private $nome_de_usuario;
    private $email;
    private $senha;
    
    public function __construct($id, $nome, $nome_de_usuario, $email, $senha) {
        $this->id = $id;
        $this->nome = $nome;
        $this->nome_de_usuario = $nome_de_usuario;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getNome_de_usuario() {
        return $this->nome_de_usuario;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setNome_de_usuario($nome_de_usuario) {
        $this->nome_de_usuario = $nome_de_usuario;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }



}
