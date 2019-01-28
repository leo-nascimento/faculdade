<?php

require_once 'lib/View.php';

// Controlador que deverá ser chamado quando não for especificado nenhum outro

class IndexController {
    /**
     * Ação que deverá ser executada quando
     * nenhuma outra for especificada
     */
    public function indexAction() {
        //redirecionando para a pagina de login
        header('Location: ?controle=Login&acao=redirectApp');
    }

    public function homeAction() {
        $o_view = new View('views/screens/Main.php');
        $o_view->showContents();
    }
}