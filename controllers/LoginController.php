<?php

//incluindo classes da camada Model
require_once 'models/LoginModel.php';
require_once 'lib/View.php';

class LoginController {
    /**
     * Efetua a manipulação dos modelos necessários
     * para a validação do acesso à aplicação
     */

    public function realizarLoginAction() {
        $login =  new LoginModel();

        // verificando e validando os dados informados pelo usuário
        if( isset($_POST['st_usuario']) && isset($_POST['st_senha']) && DataValidator::isNumeric($_POST['st_senha'])){

            // preenchendo as informações
            $login->setUsuario($_POST['st_usuario']);
            $login->setSenha($_POST['st_senha']);

            // Validando o login
            if(!$login->login()) {

                // Criando variveis de sessão
//                if($_POST['lembrar'])
                    $_SESSION['online'] = true;
//                else
//                    $_SESSION["sessiontime"] = time() + 1200;

                // Acessando a aplicação
                $a_view = new View('views/screens/Main.php');
                $a_view->showContents();
            }else{
                // Retornando erro de usuário inválido
                $o_view = new View('views/screens/Login.php');
                $o_view->setParams(array('error' => 'Usuário ou senha inválidos.'));
                $o_view->showContents();
            }
        }else{
            // Retornando erro caso os dados digitados sejam inválidos.
            $o_view = new View('views/screens/Login.php');
            $o_view->setParams(array('error' => 'Os dados digitados não são válidos.'));
            $o_view->showContents();
        }
    }

    public function redirectAppAction() {
        unset($_SESSION["sessiontime"]);
        unset($_SESSION["online"]);
        $o_view = new View('views/screens/Login.php');
        $o_view->setParams(array('error' => null));
        $o_view->showContents();
    }
}