<?php
// Incluir a conexão com o banco de dados
include('conexao.php');

if (isset($_POST['submit'])) {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $capacidade = $_POST['capacidade'];
    $descricao = $_POST['descricao'];

    // Preparar a consulta SQL para evitar SQL Injection
    $sql = "INSERT INTO espacos (nome, tipo, capacidade, descricao) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    // Vincular os parâmetros
    mysqli_stmt_bind_param($stmt, "ssis", $nome, $tipo, $capacidade, $descricao);

    // Executar a consulta
    if (mysqli_stmt_execute($stmt)) {
        echo "Espaço cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o espaço: " . mysqli_error($conexao);
    }

    // Fechar a consulta preparada
    mysqli_stmt_close($stmt);
}
?>
