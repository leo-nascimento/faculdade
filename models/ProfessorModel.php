<?php

include_once 'lib/PersistModelAbstract.php';

// Responsável por gerenciar e persistir os dados dos professores

class ProfessorModel extends PersistModelAbstract {
    private $in_id;
    private $st_nome;
    private $st_email;

// Setters e Getters
    public function setId( $in_id ) {
        $this->in_id = $in_id;
        return $this;
    }

    public function getId() {
        return $this->in_id;
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

    /**
     * Retorna um array contendo todas as turmas
     * @param string $st_nome
     * @return Array
     */
    public function _list( $in_id = null ) {
        if(!is_null($in_id))
            $st_query = "SELECT * FROM professor WHERE id = $in_id;";
        else
            $st_query = 'SELECT * FROM professor;';

        $v_professores = array();
        try {
            $o_data = $this->o_db->query($st_query);
            while($o_ret = $o_data->fetchObject()) {
                $o_professor = new ProfessorModel();
                $o_professor->setId($o_ret->id);
                $o_professor->setNome($o_ret->nome);
                $o_professor->setEmail($o_ret->email);
                array_push($v_professores, $o_professor);
            }
        }
        catch(PDOException $e)
        {}
        return $v_professores;
    }

//    Retorna os dados de uma turma  especifíca
    public function loadById( $in_id ) {
        $v_professores = array();
        $st_query = "SELECT * FROM professor WHERE id = $in_id;";
        $o_data = $this->o_db->query($st_query);
        $o_ret = $o_data->fetchObject();
        $this->setId($o_ret->id);
        $this->setNome($o_ret->nome);
        $this->setEmail($o_ret->email);
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
            $st_query = "INSERT INTO professor
                        (
                            nome,
                            email
                        )
                        VALUES
                        (
                            '$this->st_nome',
                            '$this->st_email'
                        );";
        else
            $st_query = "UPDATE
                            turma
                        SET
                            nome = '$this->st_nome',
                            email = '$this->st_email'
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
                            professor
                        WHERE id = $this->in_id";
            if($this->o_db->exec($st_query) > 0)
                return true;
        }
        return false;
    }
}