<?php

//incluindo classes da camada Model
require_once 'models/TurmaModel.php';
require_once 'models/ProfessorModel.php';
require_once 'lib/View.php';
require_once 'lib/DataValidator.php';

/**
 * Responsável por gerenciar o fluxo de dados entre
 * a camada de model e a de view*
 */
class TurmaController {
    /**
     * Efetua a manipulação dos modelos necessários
     * para a apresentação da listagem das turmas
     */
    public function listarTurmasAction() {
        $a_turma = new TurmaModel();

        //Listando as turmas cadastrados
        $v_turmas= $a_turma->_list();

        //definindo qual o arquivo HTML que será usado para mostrar a listagem
        $o_view = new View('views/screens/turma/ListarTurmas.php');

        //Passando os dados da turma para a View
        $o_view->setParams(array('v_turmas' => $v_turmas));

        //Imprimindo código HTML
        $o_view->showContents();
    }

    /**
     * Gerencia a requisiçães de criação
     * e edição das turmas
     */
    public function manterTurmaAction() {
        $a_turma = new TurmaModel();

        //verificando se o id da turma foi passado
        if( isset($_REQUEST['in_id']) )
            //verificando se o id passado é valido
            if( DataValidator::isNumeric($_REQUEST['in_id']) )
                //buscando dados da turma
                $a_turma->loadById($_REQUEST['in_id']);

        // Pegando dados dos professores
        $v_professores = $this->getDadosProfessores();

        if(count($_POST) > 0) {

            // Validações
            if(DataValidator::isEmpty($_POST['st_disciplina']) || DataValidator::isEmpty($_POST['st_turma'])){
                $o_view = new View('views/screens/turma/CriarTurmas.php');
                $o_view->setParams(array(
                    'error' => 'Há campos em branco.',
                    'st_disciplina' => $_POST['st_disciplina'],
                    'st_turma' => $_POST['st_turma'],
                    'st_professorId' => $_POST['st_professorId'],
                    'v_professores' => $v_professores));
                $o_view->showContents();
                return false;
            }

            if($_POST['st_disciplina'] < 3 || $_POST['st_turma'] === 0){
                $o_view = new View('views/screens/turma/CriarTurmas.php');
                $o_view->setParams(array(
                    'error' => 'Há campos com dados inválidos.',
                    'st_disciplina' => $_POST['st_disciplina'],
                    'st_turma' => $_POST['st_turma'],
                    'st_professorId' => $_POST['st_professorId'],
                    'v_professores' => $v_professores));
                $o_view->showContents();
                return false;
            }

            $a_turma->setDisciplina($_POST['st_disciplina']);
            $a_turma->setTurma($_POST['st_turma']);
            $a_turma->setProfessorId($_POST['st_professorId']);

            /**
             * Validando se foi salvo, caso não seja informará um erro
             * Caso seja edição voltará à lista
             * Caso seja adição retornará uma mensagem de sucesso
             */
            if($a_turma->save() > 0)
                if( isset($_REQUEST['in_id']) )
                    Application::redirect('?controle=Turma&acao=ListarTurmas');

            $o_view = new View('views/screens/turma/CriarTurmas.php');
            $o_view->setParams(array(
                'error' => false,
                'st_disciplina' => '',
                'st_turma' => '',
                'st_professorId' => null,
                'v_professores' => $v_professores));
            $o_view->showContents();
            return true;
        }
        $o_view = new View('views/screens/turma/CriarTurmas.php');
        $o_view->setParams(array('error' => 'Houve um erro inesperado. Tente novamente!'));
        $o_view->showContents();
        return false;
    }

    //      Gerencia a requisições de exclusão dos professores
    public function apagarTurmaAction() {
        if( DataValidator::isNumeric($_GET['in_id']) ) {
            //apagando o aluno
            $a_turma = new AlunoModel();
            $a_turma->loadById($_GET['in_id']);
            $a_turma->delete();

            Application::redirect('?controle=Turma&acao=ListarTurmas');
        }
    }

    // Rota para tela de criação de turma
    public function redirectCriarTurmaAction() {
        $v_professores = $this->getDadosProfessores();
        $o_view = new View('views/screens/turma/CriarTurma.php');
        $o_view->setParams(array(
            'error' => null,
            'st_disciplina' => '',
            'st_turma' => '',
            'st_professorId' => null,
            'v_professores' => $v_professores));
        $o_view->showContents();
    }

    // Montando a lista de professores
    private function getDadosProfessores(){
        $a_professor = new ProfessorModel();
        return $a_professor->_list();
    }
}