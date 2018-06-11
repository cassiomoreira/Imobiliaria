<?php /*
session_start();

if(isset($_SESSION["logado"])){
    if(!$_SESSION["logado"]){
        header("Location: index.php?msg=1");
    }
}else{
    header("Location: index.php?msg=1");
}  */
?>

<html lang="pt-br">
    <head>
        <title>Imobil</title>
        <meta charset="utf-8" />
        <link href="../bootstrap/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="../bootstrap/bootstrap-3.3.7-dist/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../img/logo-imobil.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
        <script src="js/script.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="dvPainel" class="centralizada">
            <div class="row">
                <div class="col-xs-12 alignCenter"  id="dvTopo">
                    <a href="painel.php"><img src="../img/logoFundoImobil.png" alt=""/></a>
                </div>
                <div id="dvMenu" class="alignCenter">
                    <ul id="ulMenu">
                        <li><a href="painel.php">Início</a></li>
                        <li><a href="?pagina=sobre">Sobre nós</a></li>
                        <li><a href="?pagina=contato">Contato</a></li>
                         <li><a href="?pagina=cliente">Cadastrar-se</a></li>
                   ><!--      <li><a href="logout.php">Sair</a></li>  -->
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 alignCenter"  id="dvConteudo">
                    <?php
                        require_once("../util/RequestPage.php");
                    ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div id="dvRodape" classe="col-lg-12">
            <div class="centralizada">
                <div class="col-xs-12">
                    <a href="#"> Facebook</a><br>
                    <a href="#"> Grupo whatsapp</a><br>
                    <a href="#"> Twitter</a><br>
                    <a href="#"> youtube</a><br>
                    <a href="#"> Instagram</a><br>

                    <p><center>&copy; Sistemas de Informação (UFU) - Todos os Diretos Reservados</center> </p>
                </div>
            </div>
        </div>
    </body>
</html>

