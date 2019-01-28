<?php
$params = $this->getParams();
$error = $params['error'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">-->
<!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>-->
<!--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>-->
<!--    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="views/styles/bootstrap/bootstrap.min.css" type="text/css"/>
    <script src="views/js/bootstrap_jquery/jquery-3.3.1.slim.min.js" type="text/javascript"></script>
    <script src="views/js/bootstrap_jquery/popper.min.js" type="text/javascript"></script>
    <script src="views/js/bootstrap_jquery/bootstrap.min.js" type="text/javascript"></script>
    <link href="views/styles/bootstrap/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="views/styles/login.css" rel="stylesheet">
</head>
<body>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div class="login-box col-md-12"  style="border-radius: 8px">
                    <form id="login-form" class="form" method="post" action="?controle=Login&acao=realizarLogin">
                        <?php
                        if (isset($_SESSION["expirado"])){
                            echo '<div class="alert alert-danger" role="alert">';
                            echo $_SESSION["expirado"];
                            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">';
                            echo '<span aria-hidden="true">&times;</span>';
                            echo '</button>';
                            echo '</div>';
                            unset($_SESSION['expirado']);
                        }
                        ?>
                        <h3 class="text-center">ACESSO</h3>
                        <div class="form-group">
                            <label for="username">Usuário:</label><br>
                            <input type="text" name="st_usuario" id="st_usuario" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Senha:</label><br>
                            <input type="text" name="st_senha" id="st_senha" class="form-control">
                        </div>
                        <?php
                        if(!is_null($params['error'])){
                            echo '<div class="alert alert-danger" role="alert">';
                            echo $params['error'];
                            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">';
                            echo '<span aria-hidden="true">&times;</span>';
                            echo '</button>';
                            echo '</div>';
                        }
                        ?>
                        <div class="form-group">
                            <label for="remember-me"><span>Lembrar-me</span> <span><input id="remember-me" name="lembrar" type="checkbox"></span></label><br>
                            <input type="submit" class="btn btn-info btn-md" value="Entrar"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>