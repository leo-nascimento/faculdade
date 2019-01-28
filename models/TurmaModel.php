<?php

include_once 'lib/PersistModelAbstract.php';

// Responsável por gerenciar e persistir os dados das turmas

class TurmaModel extends PersistModelAbstract {
    private $in_id;
    private $st_disciplina;
    private $st_turma;
    private $st_professorId = null;
    private $st_professorName;

// Setters e Getters
    public function setId( $in_id ) {
        $this->in_id = $in_id;
        return $this;
    }

    public function getId() {
        return $this->in_id;
    }

    public function setDisciplina( $st_disciplina ) {
        $this->st_disciplina = $st_disciplina;
        return $this;
    }

    public function getDisciplina() {
        return $this->st_disciplina;
    }

    public function setTurma( $st_turma ) {
        $this->st_turma = $st_turma;
        return $this;
    }


    public function getTurma() {
        return $this->st_turma;
    }

    public function setProfessorId( $st_profId ) {
        $this->st_professorId = $st_profId;
        return $this;
    }

    public function getProfessorId() {
        return $this->st_professorId;
    }

    public function getProfessorName(){
        return $this->st_professorName;
    }

    public function setProfessorName($st_professorName){
        $this->st_professorName = $st_professorName;
    }

    /**
     * Retorna um array contendo todas as turmas
     * @param string $st_nome
     * @return Array
     */
    public function _list( $in_id = null ) {
        if(!is_null($in_id))
            $st_query = "SELECT * FROM turma WHERE id = $in_id;";
        else
            $st_query = 'SELECT * FROM turma;';

        $v_turmas = array();
        try {
            $o_data = $this->o_db->query($st_query);
            while($o_ret = $o_data->fetchObject()) {
                $o_turma = new TurmaModel();
                $o_turma->setId($o_ret->id);
                $o_turma->setTurma($o_ret->turma);
                $o_turma->setDisciplina($o_ret->disciplina);
                $o_turma->setProfessorId($o_ret->professorId);
                array_push($v_turmas, $o_turma);
            }
        }
        catch(PDOException $e)
        {}
        return $v_turmas;
    }

//    Retorna os dados de uma turma  especifíca
    public function loadById( $in_id ) {
        $v_turmas = array();
        $st_query = "SELECT * FROM turma WHERE id = $in_id;";
        $o_data = $this->o_db->query($st_query);
        $o_ret = $o_data->fetchObject();
        $this->setId($o_ret->id);
        $this->setTurma($o_ret->turma);
        $this->setDisciplina($o_ret->disciplina);
        $this->setProfessorId($o_ret->professorId);
        return $this;
    }

    /**
     * Salva dados contidos na instancia da classe
     * na tabela de contato. Se o ID for passado,
     * um UPDATE será executado, caso contrário, um
     * INSERT será executado
     * @throws PDOException
     * @return integer
     */
    public function save() {
        if(is_null($this->in_id))
            $st_query = "INSERT INTO turma
                        (
                            disciplina,
                            turma,
                            professorId
                        )
                        VALUES
                        (
                            '$this->st_disciplina',
                            '$this->st_turma',
                            '$this->st_professorId'
                        );";
        else
            $st_query = "UPDATE
                            turma
                        SET
                            disciplina = '$this->st_disciplina',
                            turma = '$this->st_turma',
                            professorId = '$this->st_professorId',
                        WHERE
                            id = $this->in_id";
        try {

            if($this->o_db->exec($st_query) > 0)
                if(is_null($this->in_id))
                {
                    /*
                     * verificando se o driver usado é sqlite e pegando o ultimo id inserido
                     * por algum motivo, a função nativa do PDO::lastInsertId() não funciona com sqlite
                     */
                    if($this->o_db->getAttribute(PDO::ATTR_DRIVER_NAME) === 'sqlite')
                    {
                        $o_ret = $this->o_db->query('SELECT last_insert_rowid() AS id')->fetchObject();
                        return $o_ret->id;
                    }
                    else
                        return $this->o_db->lastInsertId();
                }
                else
                    return $this->in_id;
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
        if(!is_null($this->in_id))
        {
            $st_query = "DELETE FROM
                            turma
                        WHERE id = $this->in_id";
            if($this->o_db->exec($st_query) > 0)
                return true;
        }
        return false;
    }
}