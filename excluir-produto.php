<?php

require 'src/conexao.php';
require 'src/Modelos/Produto.php';
require 'src/Repositorios/RepositorioProdutos.php';

$repositorioProdutos = new RepositorioProdutos($pdo);
$repositorioProdutos->deletar($_POST['id']);

header( "Location: admin.php");

?>