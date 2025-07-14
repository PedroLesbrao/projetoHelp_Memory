<?php
$bdServidor = getenv('DB_HOST');
$bdUsuario  = getenv('DB_USER');
$bdPassword = getenv('DB_PASS');
$dbBanco    = getenv('DB_NAME');

$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdPassword, $dbBanco)
    or die('Erro de conexão: ' . mysqli_connect_error());       
?>