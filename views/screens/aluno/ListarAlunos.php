<?php
$v_params = $this->getParams();
$v_alunos = $v_params['v_alunos'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Alunos</title>
    <link rel="stylesheet" href="views/styles/bootstrap/bootstrap.min.css" type="text/css"/>
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
                            <li>Listar alunos</li>
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
        </div
        <div class="col-sm-offset-1">
            <h2 style="margin-left: 12px; color: #fff">Alunos</h2>
        </div>
        <table class="table text-center" style="float: right; width: 75%; background-color: #fff">
            <thead>
            <tr style="font-size: smaller">
                <th>Matricula</th>
                <th>Aluno</th>
                <th>E-mail</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($v_alunos AS $o_aluno) {
            ?>
            <tr style="font-size: small">
                <td><?php echo $o_aluno->getId()?></td>
                <td><?php echo $o_aluno->getNome()?></td>
                <td><?php echo $o_aluno->getEmail()?></td>
                <td><?php echo $o_aluno->getDtNascimento()?></td>
                <td><?php echo $o_aluno->getTelefone()?></td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" title="Editar dados"><i class="fa fa-edit"></i></button>
                    <a href="#delete<?php echo $o_aluno->getId(); ?>" <button type="button" class="btn btn-danger btn-sm" title="Excluir aluno"><i class="fa fa-remove"></i></button></td>
                </td>
<!--                Modal para excluir usuário-->
                <div id="delete<?php echo $o_aluno->getId(); ?>" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="?controle=Aluno&acao=apagarAluno" method="post">
                                <div class="modal-header">
                                    <h4 class="modal-title">Excluir aluno</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
<!--                                    <b><p>Deseja excluir o aluno --><?php //echo $o_aluno->getNome(); ?><!--?</p></b>-->
                                    <p class="text-warning"><small>Essa ação não poderá ser desfeita...</small></p>
                                    <input name="in_matricula" type="hidden" value="<?php echo $o_aluno->getId(); ?>" />
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                                    <input type="submit" class="btn btn-danger" value="Excluir">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
<!--                Fim modal -->
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script src="views/js/bootstrap_jquery/jquery-3.3.1.slim.min.js" type="text/javascript"></script>
<script src="views/js/bootstrap_jquery/popper.min.js" type="text/javascript"></script>
<script src="views/js/bootstrap_jquery/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>