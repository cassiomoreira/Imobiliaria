<?php
require_once("../model/Imoveis.php");
require_once("../controller/ImoveisController.php");
require_once ("../util/UploadFile.php");

$imoveisController = new ImoveisController();

$nome_prop = "";
$tipo_imovel = 1;
$valor = "";
$tipo = 1;
$descricao = "";
$imagem = "";
$telefone = "";
$cidade = "";
$bairro = "";
$rua = "";
$numero = "";

$resultado = "";
$spResultadoBusca = "";
$listaImoveisBusca = [];


if (filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)) {
    $imoveis = new Imoveis();

    $imoveis->setNome_prop(filter_input(INPUT_POST, "txtNome_prop", FILTER_SANITIZE_STRING));
    $imoveis->setTelefone(filter_input(INPUT_POST, "txtTelefone", FILTER_SANITIZE_STRING));
    $imoveis->setValor(filter_input(INPUT_POST, "txtValor", FILTER_SANITIZE_STRING));
    $imoveis->setTipo_imovel(filter_input(INPUT_POST, "slTipo_imovel", FILTER_SANITIZE_NUMBER_INT));
    $imoveis->setTipo(filter_input(INPUT_POST, "slTipo", FILTER_SANITIZE_NUMBER_INT));
    $imoveis->setDescricao(filter_input(INPUT_POST, "txtDescricao", FILTER_SANITIZE_STRING));
    $imoveis->setCidade(filter_input(INPUT_POST, "txtCidade", FILTER_SANITIZE_STRING));
    $imoveis->setBairro(filter_input(INPUT_POST, "txtBairro", FILTER_SANITIZE_STRING));
    $imoveis->setRua(filter_input(INPUT_POST, "txtRua", FILTER_SANITIZE_STRING));
    $imoveis->setNumero(filter_input(INPUT_POST, "txtNumero", FILTER_SANITIZE_STRING));

    if (!filter_input(INPUT_GET, "id_imovel", FILTER_SANITIZE_NUMBER_INT)) {        //Cadastrar
        //Cadastrar
        $upload = new Upload();
        $nomeImagem = $upload->LoadFile("../img/Imoveis/", "img", $_FILES["fImagem"]);
        $imoveis->setImagem($nomeImagem);

        if ($nomeImagem != "" && $nomeImagem != "invalid") {
            //Metodo de Cadastrar
            $resultado = "Imagem Carregada";
            if ($imoveisController->Cadastrar($imoveis)) {
                ?>
                <script>
                    document.cookie = "msg=1";
                    document.location.href = "?pagina=imoveis";
                </script>
                <?php
            } else {
                $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar cadastrar imoveis.</div>";
            }
        } else if ($nomeImagem == "invalid") {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Formato de imagem inválido.</div>";
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar carregar a imagem.</div>";
        }
    } else {
        //Editar
        $imoveis->setId_imovel(filter_input(INPUT_GET, "id_imovel", FILTER_SANITIZE_NUMBER_INT));
        if ($imoveisController->Alterar($imoveis)) {
            ?>
            <script>
                document.cookie = "msg=2";
                document.location.href = "?pagina=imoveis";
            </script>
            <?php
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar alterar imoveis.</div>";
        }
    }
}

//Buscar imoveis
if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {

    $termo = filter_input(INPUT_POST, "txtTermo", FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, "slTipoBusca", FILTER_SANITIZE_NUMBER_INT);
    $listaImoveisBusca = $imoveisController->RetornarImoveis($termo, $tipo);

    if ($listaImoveisBusca != null) {
        $spResultadoBusca = "Exibindo dados";
    } else {
        $spResultadoBusca = "Dados não encontrado";
    }
}

if (filter_input(INPUT_GET, "id_imovel", FILTER_SANITIZE_NUMBER_INT)) {
    $imoveis = $imoveisController->RetornaId_imovel(filter_input(INPUT_GET, "id_imovel", FILTER_SANITIZE_NUMBER_INT));

    $id_imovel = filter_input(INPUT_GET, "id_imovel", FILTER_SANITIZE_NUMBER_INT);
    $nome_prop = $imoveis->getNome_prop();
    $telefone = $imoveis->getTelefone();
    $tipo_imovel = $imoveis->getTipo_imovel();
    $tipo = $imoveis->getTipo();
    $valor = $imoveis->getValor();
    $descricao = $imoveis->getDescricao();
    $imagem = "img";
    $cidade = $imoveis->getCidade();
    $bairro = $imoveis->getBairro();
    $rua = $imoveis->getRua();
    $numero = $imoveis->getNumero();
}
?>
<div id="dvImoveis">
    <h1>Gerenciar Imóveis</h1>
    <br />
    <div class="controlePaginas">
        <a href="?pagina=imoveis"><img src="img/icones/editar.png" alt=""/></a>
        <a href="?pagina=imoveis&consulta=s"><img src="img/icones/buscar.png" alt=""/></a>
    </div>

    <br />
    <!--DIV CADASTRO -->
    <?php
    if (!filter_input(INPUT_GET, "consulta", FILTER_SANITIZE_STRING)) {
        ?>
        <div class="panel panel-default maxPanelWidth">
            <div class="panel-heading"><h4>Cadastro e edição dos dados do proprietário do imóvel</h4></div>
            <div class="panel-body">
                <form method="post" id="frmHome" name="frmHome" novalidate enctype="multipart/form-data">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <input type="hidden" id="txtId_imovel" value="<?= $id_imovel; ?>" />
                            <label for="txtNome_prop">Nome do proprietario</label>
                            <input type="text" class="form-control" id="txtNome_prop" name="txtNome_prop" placeholder="Nome e sobrenome" value="<?= $nome_prop; ?>"/>
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
                        <div class="col-lg-12">
                            <ul id="ulErros"></ul>
                        </div>
                    </div>

                    <br />
                    <hr>
                    <div class="panel panel-default maxPanelWidth">
                        <div class="panel-heading"><h4>Cadastro e edição dos dados do imóvel</h4></div>
                        <br />
                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
                                <label for="slTipo_imovel">Tipo de Imóvel</label>
                                <select class="form-control" id="slTipo_imovel" name="slTipo_imovel">
                                    <option value="1" <?= ($tipo_imovel == "1" ? "selected='selected'" : ""); ?>>Apartamento</option>
                                    <option value="2" <?= ($tipo_imovel == "2" ? "selected='selected'" : ""); ?>>Casa</option>
                                    <option value="3" <?= ($tipo_imovel == "3" ? "selected='selected'" : ""); ?>>Condominio</option>
                                    <option value="4" <?= ($tipo_imovel == "4" ? "selected='selected'" : ""); ?>>Cobertura</option>
                                    <option value="5" <?= ($tipo_imovel == "5" ? "selected='selected'" : ""); ?>>Kitnet</option>
                                    <option value="6" <?= ($tipo_imovel == "6" ? "selected='selected'" : ""); ?>>Sobrado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
                                <label for="slTipo">Vai alugar ou Comprar</label>
                                <select class="form-control" id="slTipo" name="slTipo">
                                    <option value="1" <?= ($tipo == "1" ? "selected='selected'" : ""); ?>>Aluguel</option>
                                    <option value="2" <?= ($tipo == "2" ? "selected='selected'" : ""); ?>>Compra</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label for="txtValor">Valor</label>
                                    <input type="text" class="form-control" id="txtValor" name="txtValor" placeholder="R$ 000.000,00" value="<?= $valor; ?>">
                                </div>
                            </div>
                        </div>
                        <br />
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="fImagem">Selecione uma imagem</label>
                                    <input type="file" id="fImagem" name="fImagem" <?= ($imagem != "" ? "disabled='disabled'" : "") ?> accept="image/*" />
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p style="font-weight: 900;">Descrição</p>
                                    <textarea class="form-control" id="txtDescricao" name="txtDescricao"><?= $descricao; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <div class="row">
                            <div class="col-lg-12">
                                <ul id="ulErros"></ul>
                            </div>
                        </div>
                    </div>

                    <br />

                    <div class="panel panel-default maxPanelWidth">
                        <div class="panel-heading"><h4>Cadastro e edição do endereço do imóvel</h4></div>
                        <br />
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label for="txtCidade">Nome da Cidade</label>
                                    <input type="text" class="form-control" id="txtCidade" name="txtCidade" placeholder="Abadia dos Dourados" value="<?= $cidade; ?>"/>
                                </div>
                            </div>

                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label for="txtBairro">Nome do bairro</label>
                                    <input type="text" class="form-control" id="txtBairro" name="txtBairro" placeholder="Nome do bairro" value="<?= $bairro; ?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label for="txtRua">Nome da rua</label>
                                    <input type="text" class="form-control" id="txtRua" name="txtRua" placeholder="Nome da Rua" value="<?= $rua; ?>"/>
                                </div>
                            </div>


                            <div class="col-lg-6 col-xs-12"> 
                                <div class="form-group">
                                    <label for="txtNumero">Número</label>
                                    <input type="text" class="form-control" id="txtNumero" name="txtNumero" placeholder="0000" value="<?= $numero; ?>"/>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12"> 
                                <p id="pResultado"><?= $resultado; ?></p>
                            </div>
                        </div>
                        <input class="btn btn-success" type="submit" name="btnGravar" value="Cadastrar">
                        <a href="?pagina=imoveis" class="btn btn-danger">Cancelar</a>

                        <br />
                        <br />
                        <div class="row">
                            <div class="col-lg-12"> 
                                <ul id="ulErros"></ul>
                            </div>
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
                <form method="post" name="frmBuscarImovel" id="frmBuscarImovel">
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
                                    <option value="1">Nome do Proprietário</option>
                                    <option value="2">Cidade do imóvel</option>
                                    <option value="3">Bairro do imóvel</option>
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
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Cidade</th>
                            <th>Bairro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($listaImoveisBusca != null) {
                            foreach ($listaImoveisBusca as $user) {
                                ?>
                                <tr>
                                    <td><?= $user->getId_imovel(); ?></td>
                                    <td><?= $user->getNome_prop(); ?></td>
                                    <td><?= $user->getCidade(); ?></td>
                                    <td><?= $user->getBairro(); ?></td>
                                    <td><a href="?pagina=imoveis&id_imovel=<?= $user->getId_imovel(); ?>" class="btn btn-warning">Editar</a></td>
                                    <td><a href="?pagina=alterarImagem&id_imovel=<?= $user->getId_imovel(); ?>" class="btn btn-warning">Alterar imagem</a></td>
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
<script src="../ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('txtDescricao');
    $('txtTelefone').mask('(00) 00000-0000'); //telefone
    $('txtValor').mask('000.000.000.000.000,00', {reverse: true}); //Dinheiro
</script>
<script>
    $(document).ready(function () {
        if (getCookie("msg") == 1) {
            document.getElementById("pResultado").innerHTML = "<div class=\"alert alert-success\" role=\"alert\">Imovel cadastrado com sucesso.</div>";
            document.cookie = "msg=d";
        } else if (getCookie("msg") == 2) {
            document.getElementById("pResultado").innerHTML = "<div class=\"alert alert-success\" role=\"alert\">Imovel alterado com sucesso.</div>";
            document.cookie = "msg=d";
        }

        $("#frmHome").submit(function (e) {
            if (!ValidarFormulario()) {
                e.preventDefault();
            }
        });

        function ValidarFormulario() {
            var erros = 0;
            var ulErros = document.getElementById("ulErros");
            ulErros.style.color = "red";
            ulErros.innerHTML = "";


//Javascript nativo
            if (document.getElementById("txtNome_prop").value.length < 2) {
                var li = document.createElement("li");
                li.innerHTML = "- Informe um nome válido";
                ulErros.appendChild(li);
                erros++;
            }

            if (document.getElementById("txtLink").value.length < 2) {
                var li = document.createElement("li");
                li.innerHTML = "- Informe um link válido";
                ulErros.appendChild(li);
                erros++;
            }

            if ($("#txtId_imovel").val() == "") {
                if (document.getElementById("fImagem").value == "") {
                    var li = document.createElement("li");
                    li.innerHTML = "- Selecione uma imagem";
                    ulErros.appendChild(li);
                    erros++;
                }
            }

            var value = CKEDITOR.instances['txtDescricao'].getData();
            if (value.length < 2) {
                var li = document.createElement("li");
                li.innerHTML = "- Informe uma descrição";
                ulErros.appendChild(li);
                erros++;
            }

            if (erros === 0) {
                return true;
            } else {
                return false;
            }
        }
    });

</script>