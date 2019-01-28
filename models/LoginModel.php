<?php

include_once 'lib/PersistModelAbstract.php';

// Responsável por gerenciar e persistir os dados para login

class LoginModel extends PersistModelAbstract {
    private $st_usuario;
    private $st_senha;

    // Setters e Getters
    public function getUsuario() {
        return $this->st_usuario;
    }

    public function setUsuario($st_usuario): void {
        $this->st_usuario = $st_usuario;
    }

    public function getSenha() {
        return $this->st_senha;
    }

    public function setSenha($st_senha): void {
        $this->st_senha = $st_senha;
    }

    /**
     * Retorna um boolean aprovando ou não o acesso a aplicação
     * @return boolean
     */

    public function login() {
        $st_query = "SELECT * FROM usuario WHERE usuario = $this->st_usuario AND senha = $this->st_senha;";

        if($this->o_db->exec($st_query) > 0)
            return true;

        return false;
    }
}