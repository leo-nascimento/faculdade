<?php

// Classe Abstrata responsável por centralizar a conexão com o banco de dados

abstract class PersistModelAbstract {
    /**
     * Variável responsável por guardar dados da conexão do banco
     * @var resource
     */

    protected $o_db;

    function __construct() {

        //Inicio de conexão com MySQL
        $st_host = 'localhost';
        $st_banco = 'faculdade';
        $st_usuario = 'teste';
        $st_senha = '12345678';


        $st_dsn = "mysql:host=$st_host;dbname=$st_banco";
        $this->o_db = new PDO
        (
            $st_dsn,
            $st_usuario,
            $st_senha
        );
        //Fim de conexão com MySQL
    }
}