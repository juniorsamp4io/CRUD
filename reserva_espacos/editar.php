<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar a consulta SQL para obter os dados
    $sql = "SELECT * FROM espacos WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id); // "i" para integer
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $espaco = mysqli_fetch_assoc($result);
    } else {
        echo "Erro ao consultar o espaço.";
        exit;
    }
} else {
    echo "ID do espaço não informado!";
    exit;
}

if (isset($_POST['submit'])) {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $capacidade = $_POST['capacidade'];
    $descricao = $_POST['descricao'];

    // Preparar a consulta SQL para atualizar os dados
    $update_sql = "UPDATE espacos SET nome = ?, tipo = ?, capacidade = ?, descricao = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $update_sql);

    // Vincular os parâmetros
    mysqli_stmt_bind_param($stmt, "ssisi", $nome, $tipo, $capacidade, $descricao, $id);

    // Executar a consulta
    if (mysqli_stmt_execute($stmt)) {
        echo "Espaço atualizado com sucesso!";
        header("Location: listar.php");
        exit;
    } else {
        echo "Erro ao atualizar o espaço: " . mysqli_error($conexao);
    }

    // Fechar a consulta preparada
    mysqli_stmt_close($stmt);
}
?>
