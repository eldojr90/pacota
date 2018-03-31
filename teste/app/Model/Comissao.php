<?php

namespace App\Model;

class Comissao {
    
    private $id;
    private $data;
    private $valor;
    private $id_user;
    
    function __construct($id, $data, $valor, $id_user) {
        $this->id = $id;
        $this->data = $data;
        $this->valor = $valor;
        $this->id_user = $id_user;
    }
    
    function getId() {
        return $this->id;
    }

    function getData() {
        return $this->data;
    }

    function getValor() {
        return $this->valor;
    }

    function getId_user() {
        return $this->id_user;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    
        

    
    
}
