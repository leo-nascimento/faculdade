<?php

//incluindo classes da camada Model
require_once 'models/ProfessorModel.php';
require_once 'lib/View.php';
require_once 'lib/DataValidator.php';

/**
 * Responsável por gerenciar o fluxo de dados entre
 * a camada de model e a de view*
 */
class ProfessorController {
    /**
     * Efetua a manipulação dos modelos necessários
     * para a apresentação da lista de professores
     */
    public function listarProfessoresAction() {
        $a_Professor = new ProfessorModel();

        //Listando as Professores cadastrados
        $v_Professores= $a_Professor->_list();

        //definindo qual o arquivo HTML que será usado para mostrar a listagem
        $o_view = new View('views/screens/Professor/ListarProfessores.php');

        //Passando os dados do professor para a View
        $o_view->setParams(array('v_professores' => $v_Professores));

        //Imprimindo código HTML
        $o_view->showContents();
    }

    /**
     * Gerencia a requisiçães de criação
     * e edição das Professores
     */
    public function manterProfessorAction() {
        $a_Professor = new ProfessorModel();

        //verificando se o id da Professor foi passado
        if( isset($_REQUEST['in_id']) )
            //verificando se o id passado é valido
            if( DataValidator::isNumeric($_REQUEST['in_id']) )
                //buscando dados da Professor
                $a_Professor->loadById($_REQUEST['in_id']);

        if(count($_POST) > 0) {

            //Validações
            if(DataValidator::isEmpty($_POST['st_nome']) || DataValidator::isEmpty($_POST['st_email'])){
                $o_view = new View('views/screens/professor/NovoProfessor.php');
                $o_view->setParams(array(
                    'error' => 'Há campos em branco.',
                    'st_nome' => $_POST['st_nome'],
                    'st_email' => $_POST['st_email']));
                $o_view->showContents();
                return false;
            }

            if(!DataValidator::validateMail($_POST['st_email']) || strlen($_POST['st_nome']) < 5){
                $o_view = new View('views/screens/professor/NovoProfessor.php');
                $o_view->setParams(array(
                    'error' => 'Há campos com dados inválidos.',
                    'st_nome' => $_POST['st_nome'],
                    'st_email' => $_POST['st_email']));
                $o_view->showContents();
                return false;
            }

            $a_Professor->setNome($_POST['st_nome']);
            $a_Professor->setEmail($_POST['st_email']);

            /**
             * Validando se foi salvo, caso não seja informará um erro
             * Caso seja edição voltará à lista
             * Caso seja adição retornará uma mensagem de sucesso
             */
            if($a_Professor->save() > 0){
                if( isset($_REQUEST['in_id']) )
                    Application::redirect('?controle=Professor&acao=ListarProfessores');

                $o_view = new View('views/screens/professor/NovoProfessor.php');
                $o_view->setParams(array(
                    'error' => false,
                    'st_nome' => '',
                    'st_email' => ''));
                $o_view->showContents();
                return true;
            }
            $o_view = new View('views/screens/professor/NovoProfessor.php');
            $o_view->setParams(array('error' => 'Houve um erro inesperado. Tente novamente!'));
            $o_view->showContents();
            return false;
        }

        $o_view = new View('views/screens/Professor/ListarProfessores.php');
        $o_view->setParams(array('a_Professor' => $a_Professor));
        $o_view->showContents();
    }

//      Gerencia a requisições de exclusão dos professores
    public function apagarProfessorAction() {
        if( DataValidator::isNumeric($_GET['in_id']) )
        {
            //apagando o aluno
            $a_Professor = new AlunoModel();
            $a_Professor->loadById($_GET['in_id']);
            $a_Professor->delete();

            Application::redirect('?controle=Professor&acao=ListarProfessores');
        }
    }

    // Rota para tela de novo professor
    public function redirectNovoProfessorAction() {
        $o_view = new View('views/screens/professor/NovoProfessor.php');
        $o_view->setParams(array(
            'error' => null,
            'st_nome' => '',
            'st_email' => '',
            'st_dt_nascimento' => '',
            'st_telefone' => ''));
        $o_view->showContents();
    }
}