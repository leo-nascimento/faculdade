<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">-->
<!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>-->
<!--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="views/styles/bootstrap/bootstrap.min.css" type="text/css"/>
    <script src="views/js/bootstrap_jquery/jquery-3.3.1.slim.min.js" type="text/javascript"></script>
    <script src="views/js/bootstrap_jquery/popper.min.js" type="text/javascript"></script>
    <script src="views/js/bootstrap_jquery/bootstrap.min.js" type="text/javascript"></script>
<!--        <link href="views/styles/bootstrap/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <link href="views/styles/main.css" rel="stylesheet">
</head>
<body>
<div  class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <div class="nav-side-menu">
                <div class="brand">Brand Logo</div>
                <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
                <div class="menu-list">
                    <ul id="menu-content" class="menu-content collapse out">
                        <li>
                            <i class="fa fa-home fa-lg"></i> Home
                        </li>
                        <li data-toggle="collapse" data-target=".student" class="collapsed">
                            <i class="fa fa-user fa-lg"></i> Alunos <span class="arrow"></span>
                        </li>
                        <ul class="sub-menu collapse student">
                            <a href="?controle=Aluno&acao=redirectNovoAluno"> <li>Inserir aluno</li> </a>
                        </ul>
                        <ul class="sub-menu collapse student">
                            <a href="?controle=Aluno&acao=ListarAluno"><li>Listar alunos</li></a>
                        </ul>
                        <li data-toggle="collapse" data-target=".teacher" class="collapsed">
                            <i class="fa fa-user-plus fa-lg"></i> Professores <span class="arrow"></span>
                        </li>
                        <ul class="sub-menu collapse teacher">
                            <a href="?controle=Professor&acao=redirectNovoProfessor"><li>Inserir professor(a)</li></a>
                        </ul>
                        <ul class="sub-menu collapse teacher">
                            <a href="?controle=Professor&acao=listarProfessores"><li>Listar professores</li></a>
                        </ul>
                        <li data-toggle="collapse" class="collapsed" data-target=".class">
                            <i class="fa fa-group fa-lg"></i> Turmas <span class="arrow"></span>
                        </li>
                        <ul class="sub-menu collapse class">
                            <a href="?controle=Turma&acao=redirectCriarTurma"><li>Criar turma</li></a>
                        </ul>
                        <ul class="sub-menu collapse class">
                            <a href="?controle=Turma&acao=listarTurmas"><li>Listar turmas</li></a>
                        </ul>
                        <li data-toggle="collapse" class="collapsed">
                            <a href="?controle=Index&acao=index"><i class="fa fa-window-close fa-lg"></i> Sair da aplicação </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-sm-offset-1">
            <h1>Welcome To App :)</h1>
        </div>
    </div>
</div>
</body>
</html>