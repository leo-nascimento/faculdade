<?php
$v_params = $this->getParams();
$v_turmas = $v_params['v_turmas'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Main - Prova</title>
    <link rel="stylesheet" href="views/styles/bootstrap/bootstrap.min.css" type="text/css"/>
    <script src="views/js/bootstrap_jquery/jquery-3.3.1.slim.min.js" type="text/javascript"></script>
    <script src="views/js/bootstrap_jquery/popper.min.js" type="text/javascript"></script>
    <script src="views/js/bootstrap_jquery/bootstrap.min.js" type="text/javascript"></script>
    <link href="views/styles/bootstrap/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="views/styles/main.css" rel="stylesheet">
</head>
<body>
<div  class="container-fluid" style="background-color: #23282e;">
    <div class="row">
        <div class="col-sm-3">
            <div class="nav-side-menu">
                <div class="brand">Brand Logo</div>
                <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
                <div class="menu-list">
                    <ul id="menu-content" class="menu-content collapse out">
                        <li>
                            <a href="?controle=Index&acao=home">
                                <i class="fa fa-home fa-lg"></i> Home
                            </a>
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
                            <li>Listar professores</li>
                        </ul>
                        <li data-toggle="collapse" class="collapsed" data-target=".class">
                            <i class="fa fa-group fa-lg"></i> Turmas <span class="arrow"></span>
                        </li>
                        <ul class="sub-menu collapse class">
                            <a href="?controle=Turma&acao=redirectCriarTurma"><li>Criar turma</li></a>
                        </ul>
                        <ul class="sub-menu collapse class">
                            <li>Listar turmas</li>
                        </ul>
                        <li data-toggle="collapse" class="collapsed">
                            <a href="?controle=Index&acao=index"><i class="fa fa-window-close fa-lg"></i> Sair da aplicação </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div
        <div class="col-sm-offset-1">
            <h2 style="margin-left: 12px; color: #fff">Turmas</h2>
        </div>
        <table class="table text-center" style="float: right; width: 75%; background-color: #fff">
            <thead>
            <tr style="font-size: smaller">
                <th>Turma</th>
                <th>Disciplina</th>
                <th>Professor(a)</th>
                <th>Ver alunos</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($v_turmas AS $a_turma) {
            ?>
            <tr style="font-size: small">
                <td><?php echo $a_turma->getTurma(); ?></td>
                <td><?php echo $a_turma->getDisciplina(); ?></td>
                <td><?php echo $a_turma->getProfessorName(); ?></td>
                <td><button type="button" class="btn btn-secondary btn-sm">Listar alunos</button></td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" title="Editar dados"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" title="Excluir turma"><i class="fa fa-remove"></i></button>
                </td>
            </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>