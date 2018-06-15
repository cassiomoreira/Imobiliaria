<?php
require_once ("../controller/ClienteController.php");
require_once ("../model/Cliente.php");

$clienteController = new ClienteController();

$id_cliente = 0;
$nome = "";
$email = "";
$email2 = "";
$telefone = "";
$senha = "";
$senha2 = "";

$resultado = "";
$spResultadoBusca = "";
$listaClienteBusca = [];

if (filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)) {
    $cliente = new Cliente();

    $cliente->setNome(filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING));
    $cliente->setEmail(filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_STRING));
    $cliente->setTelefone(filter_input(INPUT_POST, "txtTelefone", FILTER_SANITIZE_STRING));
    $cliente->setSenha(filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING));

    if (!filter_input(INPUT_GET, "id_cliente", FILTER_SANITIZE_NUMBER_INT)) {        //Cadastrar
        //Cadastrar
        if ($clienteController->Cadastrar($cliente)) {
            ?>
            <script>
                document.cookie = "msg=1";
                document.location.href = "?pagina=cliente";
            </script>
            <?php
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar cadastrar cliente.</div>";
        }
    } else {
        //Editar
        $cliente->setId_cliente(filter_input(INPUT_GET, "id_cliente", FILTER_SANITIZE_NUMBER_INT));
        if ($clienteController->Alterar($cliente)) {
            ?>
            <script>
                document.cookie = "msg=2";
                document.location.href = "?pagina=cliente";
            </script>
            <?php
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar alterar cliente.</div>";
        }
    }
}

//Buscar usuários

if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {

    $termo = filter_input(INPUT_POST, "txtTermo", FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, "slTipoBusca", FILTER_SANITIZE_NUMBER_INT);
    $listaClienteBusca = $clienteController->RetornarCliente($termo, $tipo);

    if ($listaClienteBusca != null) {
        $spResultadoBusca = "Exibindo dados";
    } else {
        $spResultadoBusca = "Dados não encontrado";
    }
}

if (filter_input(INPUT_GET, "id_cliente", FILTER_SANITIZE_NUMBER_INT)) {
    $retornoCliente = $clienteController->RetornaId_cliente(filter_input(INPUT_GET, "id_cliente", FILTER_SANITIZE_NUMBER_INT));

    $id_cliente = filter_input(INPUT_GET, "id_cliente", FILTER_SANITIZE_NUMBER_INT);
    $nome = $retornoCliente->getNome();
    $email = $retornoCliente->getEmail();
    $telefone = $retornoCliente->getTelefone();
    $senha = "-";
    $senha2 = "-";
}
?>
<div id="dvCliente">
    <h1>Gerenciar Cliente</h1>
    <br />
    <div class="controlePaginas">
        <a href="?pagina=cliente"><img src="img/icones/editar.png" alt=""/></a>
        <a href="?pagina=cliente&consulta=s"><img src="img/icones/buscar.png" alt=""/></a>
    </div>

    <br />
    <!--DIV CADASTRO -->
    <?php
    if (!filter_input(INPUT_GET, "consulta", FILTER_SANITIZE_STRING)) {
        ?>
        <div class="panel panel-default maxPanelWidth">
            <div class="panel-heading"><h2>Cadastrar e editar</h2></div>
            <div class="panel-body">
                <form method="post" id="frmGerenciarCliente" name="frmGerenciarCliente" novalidate>

                    <div class="form-group">
                        <input type="hidden" id="txtId_cliente" value="<?= $id_cliente; ?>" />
                        <label for="txtNome">Nome completo</label>
                        <input type="nome" class="form-control" id="txtNome" name="txtNome" placeholder="Nome e sobrenome" value="<?= $nome; ?>"/>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-xs-12"> 
                            <div class="form-group">
                                <label for="txtEmail">E-mail</label>
                                <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="exemplo@email.com" value="<?= $email; ?>"/>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12"> 
                            <div class="form-group">
                                <label for="txtEmail2">Confirmar E-mail</label>
                                <input type="text" class="form-control" id="txtEmail2" placeholder="exemplo@email.com"/>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6 col-xs-12"> 
                            <div class="form-group">
                                <label for="txtTelefone">Telefone</label>
                                <input type="text" class="form-control" id="txtTelefone" name="txtTelefone" placeholder="(99) 9 9999-9999" pattern="\([0-9]{2}\)[\s][0-9]{4,5}-[0-9]{4}" value="<?= $telefone; ?>"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-xs-12"> 
                            <div class="form-group">
                                <label for="txtSenha">Senha <span class="vlSenha"></span></label>
                                <input type="text" class="form-control" id="txtSenha" name="txtSenha" placeholder="********" <?= ($senha) == "" ? "" : "disabled='disabled'"; ?>/>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12"> 
                            <div class="form-group">
                                <label for="txtSenha2">Confirmar senha <span class="vlSenha"></span> </label>
                                <input type="text" class="form-control" id="txtSenha2" name="txtSenha2" placeholder="********" <?= ($senha2) == "" ? "" : "disabled='disabled'"; ?>/>
                            </div>
                        </div>
                    </div>					
                    <div class="row">
                        <div class="col-lg-12"> 
                            <p id="pResultado"><?= $resultado; ?></p>
                        </div>
                    </div>
                    <input class="btn btn-success" type="submit" name="btnGravar" value="Cadastrar">
                    <a href="?pagina=cliente" class="btn btn-danger">Cancelar</a>

                    <br />
                    <br />
                    <div class="row">
                        <div class="col-lg-12"> 
                            <ul id="ulErros"></ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {
        ?>
        <br />
        <!--DIV CONSULTA -->
        <div class="panel panel-default maxPanelWidth">
            <div class="panel-heading">Consultar</div>
            <div class="panel-body">
                <form method="post" name="frmBuscarCliente" id="frmBuscarCliente">
                    <div class="row">
                        <div class="col-lg-8 col-xs-12">
                            <div class="form-group">
                                <label for="txtTermo">Termo de busca</label>
                                <input type="text" class="form-control" id="txtTermo" name="txtTermo" placeholder="Ex: fulano de tal" />
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-12">
                            <div class="form-group">
                                <label for="slTipoBusca">Tipo</label>
                                <select class="form-control" id="slTipoBusca" name="slTipoBusca">
                                    <option value="1">Nome</option>
                                    <option value="2">Email</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <input class="btn btn-info" type="submit" name="btnBuscar" value="Buscar"> 
                            <span><?= $spResultadoBusca; ?></span>
                        </div>
                    </div>
                </form>

                <hr />
                <br />

                <table class="table table-responsive table-hover table-striped">
                    <thead>
                        <tr>  <!--   Lista de usuarios e seus atributos-->
                            <th>Nome</th>
                            <th>E-email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($listaClienteBusca != null) {
                            foreach ($listaClienteBusca as $user) {
                                ?>
                                <tr>
                                    <td><?= $user->getNome(); ?></td>
                                    <td><?= $user->getEmail(); ?></td>
                                    <td><a href="?pagina=cliente&id_cliente=<?= $user->getId_cliente(); ?>" class="btn btn-warning">Editar</a></td> <!--cod por id_cliente-->
                                    <td><a href="?pagina=alterarsenha&id_cliente=<?= $user->getId_cliente(); ?>" class="btn btn-warning">Alterar senha</a></td>
                                    <?php
                                }
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<script src="../js/mask.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        if (getCookie("msg") == 1) {
            document.getElementById("pResultado").innerHTML = "<div class=\"alert alert-success\" role=\"alert\">Cliente cadastrado com sucesso.</div>";
            document.cookie = "msg=d";
        } else if (getCookie("msg") == 2) {
            document.getElementById("pResultado").innerHTML = "<div class=\"alert alert-success\" role=\"alert\">Cliente alterado com sucesso.</div>";
            document.cookie = "msg=d";
        }
        type = "text/javascript" > $("#txtTelefone").mask("(00) 00000-0009");
        //$('#txtTelefone').mask('(00) 0 0000-0000'); //Telefone

        $("#frmGerenciarCliente").submit(function (e) {
            if (!ValidarFormulario()) {
                e.preventDefault();
            }
        });

        var vlSenhas = document.getElementsByClassName("vlSenha");

        $("#txtSenha").keyup(function () {

            if (ValidarSenha()) {
                for (var i = 0; i < vlSenhas.length; i++) {
                    vlSenhas[i].style.color = "green";
                    vlSenhas[i].innerHTML = "válido";
                }
            } else {
                for (var i = 0; i < vlSenhas.length; i++) {
                    vlSenhas[i].style.color = "red";
                    vlSenhas[i].innerHTML = "inválido";
                }
            }
        });

        $("#txtSenha2").keyup(function () {

            if (ValidarSenha()) {
                for (var i = 0; i < vlSenhas.length; i++) {
                    vlSenhas[i].style.color = "green";
                    vlSenhas[i].innerHTML = "válido";
                }
            } else {
                for (var i = 0; i < vlSenhas.length; i++) {
                    vlSenhas[i].style.color = "red";
                    vlSenhas[i].innerHTML = "inválido";
                }
            }
        });

    });

    function ValidarSenha() {
        var senha1 = $("#txtSenha").val();
        var senha2 = $("#txtSenha2").val();

        if (senha1.length >= 7 && senha2.length >= 7) {
            if (senha1 == senha2) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function ValidarFormulario() {
        var erros = 0;
        var ulErros = document.getElementById("ulErros");
        ulErros.style.color = "red";
        ulErros.innerHTML = "";

        //Javascript nativo
        if (document.getElementById("txtNome").value.length < 4) {
            var li = document.createElement("li");
            li.innerHTML = "- Informe um nome válido";
            ulErros.appendChild(li);
            erros++;
        }

        if (document.getElementById("txtEmail").value.indexOf("@") < 0 || document.getElementById("txtEmail").value.indexOf(".") < 0) {
            var li = document.createElement("li");
            li.innerHTML = "- Informe um e-mail válido";
            ulErros.appendChild(li);
            erros++;
        }

        //JQuery
        if (!ValidarSenha() && $("#txtId_cliente").val() == "0") {
            var li = document.createElement("li");
            li.innerHTML = "- Senhas inválidas";
            $("#ulErros").append(li);
            erros++;
        }

        if (erros === 0) {
            return true;
        } else {
            return false;
        }
    }
</script>