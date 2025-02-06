<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "reserva_espacos";

// Criar a conexão
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verificar a conexão
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}
?>
