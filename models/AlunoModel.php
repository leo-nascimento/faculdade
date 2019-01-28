<?php

include_once 'lib/PersistModelAbstract.php';

// Responsável por gerenciar e persistir os dados dos alunos

class AlunoModel extends PersistModelAbstract {
    private $in_matricula;
    private $st_nome;
    private $st_email;
    private $st_dt_nascimento;
    private $st_telefone;

// Setters e Getters
    public function setId( $in_id ) {
        $this->in_matricula = $in_id;
        return $this;
    }

    public function getId() {
        return $this->in_matricula;
    }

    public function setNome( $st_nome ) {
        $this->st_nome = $st_nome;
        return $this;
    }

    public function getNome() {
        return $this->st_nome;
    }

    public function setEmail( $st_email ) {
        $this->st_email = $st_email;
        return $this;
    }

    public function getEmail() {
        return $this->st_email;
    }

    public function setTelefone( $st_telefone ) {
        $this->st_telefone = $st_telefone;
        return $this;
    }

    public function getTelefone() {
        return $this->st_telefone;
    }

    public function setDtNascimento( $st_dt_nascimento ) {
        $this->st_dt_nascimento = $st_dt_nascimento;
        return $this;
    }

    public function getDtNascimento() {
        return $this->st_dt_nascimento;
    }

    /**
     * Retorna um array contendo os alunos
     * @return Array
     */
    public function _list( $in_matricula = null ) {
        if(!is_null($in_matricula))
            $st_query = "SELECT * FROM aluno WHERE matricula = $in_matricula;";
        else
            $st_query = 'SELECT * FROM aluno;';

        $v_alunos = array();
        try {
            $o_data = $this->o_db->query($st_query);
            while($o_ret = $o_data->fetchObject()) {
                $o_aluno = new AlunoModel();
                $o_aluno->setId($o_ret->matricula);
                $o_aluno->setNome($o_ret->nome);
                $o_aluno->setEmail($o_ret->email);
                $o_aluno->setTelefone($o_ret->telefone);
                $o_aluno->setDtNascimento($o_ret->dt_nascimento);
                array_push($v_alunos, $o_aluno);
            }
        }
        catch(PDOException $e)
        {}
        return $v_alunos;
    }

//    Retorna os dados de um aluno  especifíco
    public function loadById( $in_matricula ) {
        $v_alunos = array();
        $st_query = "SELECT * FROM aluno WHERE matricula = $in_matricula;";
        $o_data = $this->o_db->query($st_query);
        $o_ret = $o_data->fetchObject();
        $this->setId($o_ret->matricula);
        $this->setNome($o_ret->nome);
        $this->setEmail($o_ret->email);
        $this->setDtNascimento($o_ret->dt_nascimento);
        $this->setTelefone($o_ret->telefone);
        return $this;
    }

    /**
     * Salva dados contidos na instancia da classe
     * na tabela de alunos. Se a matricula for passada,
     * um UPDATE será executado, caso contrário, um
     * INSERT será executado
     * @throws PDOException
     * @return integer
     */
    public function save() {
        if(is_null($this->in_matricula))
            $st_query = "INSERT INTO aluno
                        (
                            nome,
                            email,
                            dt_nascimento,
                            telefone
                        )
                        VALUES
                        (
                            '$this->st_nome',
                            '$this->st_email',
                            '$this->st_dt_nascimento',
                            '$this->st_telefone'
                        );";
        else
            $st_query = "UPDATE
                            aluno
                        SET
                            nome = '$this->st_nome',
                            email = '$this->st_email',
                            dt_nascimento = '$this->st_dt_nascimento',
                            telefone = '$this->st_telefone'
                        WHERE
                            matricula = $this->in_matricula";
        try {

            if($this->o_db->exec($st_query) > 0)
                if(is_null($this->in_matricula))
                {
                    /*
                     * verificando se o driver usado é sqlite e pegando o ultimo id inserido
                     * por algum motivo, a função nativa do PDO::lastInsertId() não funciona com sqlite
                     */
                    if($this->o_db->getAttribute(PDO::ATTR_DRIVER_NAME) === 'sqlite')
                    {
                        $o_ret = $this->o_db->query('SELECT last_insert_rowid() AS matricula')->fetchObject();
                        return $o_ret->matricula;
                    }
                    else
                        return $this->o_db->lastInsertId();
                }
                else
                    return $this->in_matricula;
        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return false;
    }

    /**
     * Deleta os dados persistidos na tabela de
     * aluno usando como referencia a matricula.
     */
    public function delete() {
        if(!is_null($this->in_matricula))
        {
            $st_query = "DELETE FROM
                            aluno
                        WHERE matricula = $this->in_matricula";
            if($this->o_db->exec($st_query) > 0)
                return true;
        }
        return false;
    }
}