<?php
$params = $this->getParams();
$error = $params['error'];
$disciplina = $params['st_disciplina'];
$turma = $params['st_turma'];
$profId = $params['st_professorId'];
$v_professores = $params['v_professores'];
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
                            <a href="#"><i class="fa fa-group fa-lg"></i> Turmas <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse class">
                            <li>Criar turma</li>
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
            <h2 style="margin-left: 12px; color: #fff">Lista de alunos</h2>
        </div>
        <form style="float: right; width: 70%">
            <?php
            if($params['error']){
                echo '<div class="alert alert-danger" role="alert">';
                echo $params['error'];
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">';
                echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
                echo '</div>';
            }
            if($params['error'] === false){
                echo '<div class="alert alert-success" role="alert">';
                echo 'Turma criada com sucesso!';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">';
                echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
                echo '</div>';
            }
            ?>
            <div class="form-group">
                <label class="col-md-12 control-label" for="class">Turma</label>
                <div class="col-md-12">
                    <input id="class" name="st_turma" type="text" class="form-control input-md" required value="<?php echo $turma; ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="discipline">Disciplina</label>
                <div class="col-md-12">
                    <input id="discipline" name="st_disciplina" type="text" class="form-control input-md" required value="<?php echo $disciplina; ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="teacher">Professor(a)</label>
                <div class="col-md-12">
                    <select id="teacher" name="st_professorId" type="text" class="form-control input-md" required>
                        <option value="null">Selecione...</option>
                        <?php
                        foreach($v_professores AS $professor) {
                            if($professor->getId() === $profId)
                                echo '<option selected value="'. $professor->getId() .'">'. $professor->getNome() .'</option>';
                            else
                                echo '<option value="'. $professor->getId() .'">'. $professor->getNome() .'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="select_students">Alunos</label>
                <div class="col-md-12">
                    <input id="select_students" name="select_students" type="text" placeholder="Pesquise pela matrícula ou nome"
                           class="form-control input-md" required/>
                </div>
            </div>
            <div class="form-group">
                    <table class="table text-center" style="background-color: #fff">
                    <thead>
                    <tr style="font-size: smaller">
                        <th>Matricula</th>
                        <th>Aluno</th>
                        <th>Remover</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="font-size: small">N
                        <td>9219491941</td>
                        <td>Leonardo nascimento</td>
                        <td><i class="fa fa-remove" style="color: red; font-size: 15px"></i></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Inserir</button>
            <button type="reset" class="btn btn-danger btn-sm">Limpar</button>
            <a href="?controle=Turma&acao=listarTurmas"><button type="button" class="btn btn-primary btn-sm">Listar turmas</button></a>
        </form>
    </div>
</div>
</body>
</html>