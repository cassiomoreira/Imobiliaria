<?php

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);

$arrayPaginas = array(
    "home" => "Paginas/home.php", //Página inicial
    "sobre" => "Paginas/Sobre/Sobre.php",
    "contato" => "Paginas/Contato/Contato.php",
    "alterarsenha" => "Paginas/Cliente/AlterarSenha.php",
    "imoveis" => "Paginas/Imoveis/imoveis.php",
    "cliente" => "Paginas/Cliente/Cliente.php",
 
    //##ACESSOS##
    "acessos" => "Paginas/Log/Log.php",
    //##SCRIPTER##
    "scripterca" => "Paginas/Scripter/Cadastrar.php",
    "scripterco" => "Paginas/Scripter/Consultar.php",
    "scriptercc" => "Paginas/Scripter/ConsultaCompleta.php",

    //##ARTIGOS##
    "categoria" => "Paginas/Artigos/Categoria.php",
    "alterarcategoria" => "Paginas/Artigos/AlterarImagemCategoria.php",
    "tipoartigo" => "Paginas/Artigos/TipoArtigo.php",
    "capa" => "Paginas/Artigos/Capa.php",
    "alterarcapa" => "Paginas/Artigos/AlterarImagemCapa.php",
    "artigo" => "Paginas/Artigos/Artigo.php",
    "buscarartigo" => "Paginas/Artigos/BuscarArtigo.php",
    "alterarthumbartigo" => "Paginas/Artigos/AlterarImagemArtigo.php",
    "alterarartigocodigo" => "Paginas/Artigos/EditarArtigo.php",
    "inserirdownloadartigo" => "Paginas/Artigos/DownloadArtigo.php",
    "visualizarartigo" => "Paginas/Artigos/VisualizarArtigo.php",
    //##DOWNLOADS##
    "categoriadownload" => "Paginas/Downloads/Categoria.php",
    "downloads" => "Paginas/Downloads/Downloads.php",
    "VisualizarDownload" => "Paginas/Downloads/VisualizarDownload.php",
    "alterarImagemDownload" => "Paginas/Downloads/AlterarImagemDownload.php"
);

if ($pagina) {
    $encontrou = false;

    foreach ($arrayPaginas as $page => $key) {
        if ($pagina == $page) {
            $encontrou = true;
            require_once($key);
        }
    }

    if (!$encontrou) {
        require_once("Paginas/home.php");
    }
} else {
    require_once("Paginas/home.php");
}
?>