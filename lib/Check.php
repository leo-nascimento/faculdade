<?php

/**
 * A Class Check é responsável por controlar o tempo do usuário na aplicação
 * Se o usuário passar 20 minutos sem executar uma ação na aplicação, assim que fizer algo ele será redirecionado ao login
 * Caso o usuário selecione a função de "Lembre-me" ele poderá continuar logado sem contagem de tempo.
 */

session_start();

class Check {

    static public function checkTimeApp(){
        if ($_REQUEST['controle'] !== 'Login') {
            if (isset($_SESSION["sessiontime"])) {
                if ($_SESSION["sessiontime"] < time()) {
                    $_SESSION['expirado'] = 'Sua sessão expirou!';
                    return false;
                } else {
                    $_SESSION["sessiontime"] = time() + 1200;
                    return true;
                }
            }else{
                if (!isset($_SESSION['online']))
                    return false;
            }
        }
    }
}