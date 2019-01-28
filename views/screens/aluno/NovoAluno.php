<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Novo aluno</title>
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
                            <li>Inserir aluno</li>
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
        </div
        <div class="col-sm-offset-1">
            <h2 style="margin-left: 12px; color: #fff">Novo aluno</h2>
        </div>
        <form style="float: right; width: 70%" method="post" action="?controle=Aluno&acao=manterAluno">
            <div class="alert alert-danger" role="alert" id="alert-danger" style="display: none">
                <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-success" role="alert" id="alert-success" style="display: none">
                Aluno inserido com sucesso.
                <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="name">Nome do aluno</label>
                <div class="col-md-12">
                    <input id="name" name="st_nome" type="text"
                           class="form-control input-md" required />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="dtbirth">Data de nascimento</label>
                <div class="col-md-12">
                    <input id="dtbirth" name="st_dt_nascimento" type="text" placeholder="XX/XX/XXXX"
                           class="form-control input-md" required />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="email">E-mail</label>
                <div class="col-md-12">
                    <input id="email" name="st_email" type="email" placeholder="exemple@mail.com"
                           class="form-control input-md" required />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12 control-label" for="phone">Telefone</label>
                <div class="col-md-12">
                    <input id="phone" name="st_telefone" type="text" placeholder="(XX) XXXXX-XXXX"
                           class="form-control input-md" required >
                </div>
            </div>
            <button type="button" class="btn btn-success btn-sm" id="insert_aluno" onclick="submitData()" disabled="disabled">Inserir</button>
            <button type="reset" class="btn btn-danger btn-sm">Limpar</button>
            <a href="?controle=Aluno&acao=ListarAluno"><button type="button" class="btn btn-primary btn-sm">Listar alunos</button></a>
        </form>
    </div>
</div>
</body>
<script src="views/js/bootstrap_jquery/jquery-3.3.1.min.js" type="text/javascript"></script>
<script src="views/js/bootstrap_jquery/jquery.mask.min.js" type="text/javascript"></script>
<script src="views/js/bootstrap_jquery/popper.min.js" type="text/javascript"></script>
<script src="views/js/bootstrap_jquery/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="views/js/aluno.js"></script>
</html>