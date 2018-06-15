<?php
//session_start();

require_once ("../controller/ClienteController.php");
require_once ("../model/Cliente.php");

$retorno = "&nbsp;";

if (isset($_SESSION["entrar"])) {
    header("Location: painel.php");
}

if (filter_input(INPUT_GET, "msg", FILTER_SANITIZE_NUMBER_INT)) {
    if (filter_input(INPUT_GET, "msg", FILTER_SANITIZE_NUMBER_INT) == 1) {
        $retorno = "<div class=\"alert alert-danger\" role=\"alert\">Acesso negado!!!</div>";
    } else {
        $retorno = "<div class=\"alert alert-warning\" role=\"alert\">Você fez Logout.</div>";
    }
}

if (filter_input(INPUT_POST, "btnEntrar", FILTER_SANITIZE_STRING)) {
    $clienteController = new ClienteController();

    $email = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING);

    $resultado = $clienteController->AutenticarClientePainel($email, $senha);

    if ($resultado != null) {
        if (filter_input(INPUT_POST, "ckManterLogado", FILTER_SANITIZE_STRING)) {
            $_SESSION["entrar"] = true;
        }

        $_SESSION["id_cliente"] = $resultado->getId_cliente();
        $_SESSION["nome"] = $resultado->getNome();
        $_SESSION["logado"] = true;
        header("Location: painel.php");
    } else {
        $retorno = "<div class=\"alert alert-danger\" role=\"alert\">E-mail ou senha inválido.</div>";
    }
}
?>
<html lang="pt-br">
    <head>
        <title>Imobil</title>
        <meta charset="UFT-8">
        <link href="../bootstrap/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../bootstrap/bootstrap-3.3.7-dist/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../img/logo-imobil.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    </head>
    <body>
        <div id="dvLogin">
            <form method="post">
                <div class="row">
                    <div class="col-lg-12 alignCenter" id="dvTopo">
                        <img src="../img/logoFundoImobil.png" alt="Logo Imobil"/>
                    </div>
                    <div class="clear"></div>
                    <br/>
                    <div class="borderBottom"></div>
                    <br/>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="txtEmail">Endereço de Email</label>
                            <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <label for="txtSenha">Senha</label>
                            <input type="senha" class="form-control" name="txtSenha" id="txtSenha" placeholder="*******">
                        </div>
                        <input class="btn btn-success" type="submit" name="btnEntrar" value="Entrar">
                        <a href="#" data-toggle="modal" data-target="#myModal">Recuperar senha</a>
                        <br />
                        <label><input type="checkbox" value="s" name="ckManterLogado" /> Manter logado</label>  
                    </div>
                    <p>&nbsp;</p>
                    <div class="col-lg-12">
                        <?= $retorno; ?>
                    </div>
                </div>
            </form>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Recuperar senha</h4>
                    </div>
                    <div class="modal-body">
                        <p>Para recuperar a sua senha, por favor, dentre em contato com o administrador.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Sair</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus();
            });
        </script>
    </body>
</html>