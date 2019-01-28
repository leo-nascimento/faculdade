<?php

//incluindo classes da camada Model
require_once 'models/AlunoModel.php';
require_once 'lib/View.php';

/**
 * Responsável por gerenciar o fluxo de dados entre
 * a camada de model e a de view*
 */
class AlunoController {
    /**
     * Efetua a manipulação dos modelos necessários
     * para a apresentação da lista de alunos
     */
    public function listarAlunoAction() {
        $o_aluno = new AlunoModel();

        // Listando os alunos cadastrados
        $v_alunos = $o_aluno->_list();

        // definindo qual o arquivo HTML que será usado para mostrar a lista de alunos
        $o_view = new View('views/screens/aluno/ListarAlunos.php');

        // Passando os dados do aluno para a View
        $o_view->setParams(array('v_alunos' => $v_alunos));

        // Imprimindo código HTML
        $o_view->showContents();
    }

    /**
     * Gerencia a requisiçães de criação
     * e edição dos alunos
     */
    public function manterAlunoAction() {
        $o_aluno = new AlunoModel();

        //verificando se o id do aluno foi passado
        if( isset($_REQUEST['in_matricula']) )
            //verificando se o id passado é valido
            if( is_integer($_REQUEST['in_matricula']) )
                //buscando dados do aluno
                $o_aluno->loadById($_REQUEST['in_matricula']);

        if(isset($_POST)) {

            $nome = $_POST['st_nome'];
            $email = $_POST['st_email'];
            $nascimento = $_POST['st_dt_nascimento'];
            $telefone = $_POST['st_telefone'];

            // Verificando se os campos não estão vazios
            if( DataValidator::isEmpty($nome) || DataValidator::isEmpty($email) ||
                DataValidator::isEmpty($nascimento) || DataValidator::isEmpty($telefone) ){

                echo json_encode(array(
                    "error" => true,
                    "message" => 'Há campos em branco.'
                ));
            }

            // Validando dados
            if( strlen($nome) < 5 || !DataValidator::validateMail($email) ||
                !DataValidator::isNumeric($nascimento) || !DataValidator::validateDate($nascimento) ||
                strlen($telefone) < 10 || strlen($telefone) > 11 ){

                echo json_encode(array(
                    "error" => true,
                    "message" => 'Há campos com dados inválidos.'
                ));
            }

            $o_aluno->setNome($nome);
            $o_aluno->setEmail($email);
            $o_aluno->setDtNascimento($nascimento);
            $o_aluno->setTelefone($telefone);

            /**
             * Validando se foi salvo, caso não seja informará um erro
             * Caso seja edição voltará à lista
             * Caso seja adição retornará uma mensagem de sucesso
             */
            if($o_aluno->save() > 0){
                if( isset($_REQUEST['in_matricula']) )
                    Application::redirect('?controle=Aluno&acao=ListarAlunos');

                echo json_encode(array(
                    "error" => false,
                    "message" => 'Salvo com sucesso.'
                ));
            }
            echo json_encode(array(
                "error" => true,
                "message" => 'Houve um erro inesperado. Tente novamente.'
            ));
        }
    }

//      Gerencia a requisições de exclusão dos alunos
    public function apagarAlunoAction() {
        if( is_string($_POST['in_matricula']) )
        {
            //apagando o aluno
            $o_aluno = new AlunoModel();
            $o_aluno->loadById($_POST['in_matricula']);
            $o_aluno->delete();

            Application::redirect('?controle=Aluno&acao=ListarAlunos');
        }
    }

    // Rota para tela de novo aluno
    public function redirectNovoAlunoAction() {
        $o_view = new View('views/screens/aluno/NovoAluno.php');
        $o_view->showContents();
    }
}