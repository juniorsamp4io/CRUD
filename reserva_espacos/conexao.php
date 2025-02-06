<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "reserva_espacos";


$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);


if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}
?>
