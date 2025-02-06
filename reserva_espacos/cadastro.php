<?php
session_start();
include('conexao.php');

if (isset($_POST['submit'])) {
    
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $capacidade = $_POST['capacidade'];
    $descricao = $_POST['descricao'];

    
    if (empty($nome) || empty($tipo) || empty($capacidade) || empty($descricao)) {
        $_SESSION['mensagem'] = "Todos os campos são obrigatórios!";
        header("Location: cadastro.php");
        exit;
    }

    
    $sql = "INSERT INTO espacos (nome, tipo, capacidade, descricao) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    
    mysqli_stmt_bind_param($stmt, "ssis", $nome, $tipo, $capacidade, $descricao);

    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['mensagem'] = "Espaço cadastrado com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar o espaço: " . mysqli_error($conexao);
    }

    
    mysqli_stmt_close($stmt);

    
    header("Location: listar.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Espaço</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Cadastrar Espaço</h1>
    </header>

    <div>
        <?php
        
        if (isset($_SESSION['mensagem'])) {
            echo "<div class='";
            echo ($_SESSION['mensagem'] == "Espaço cadastrado com sucesso!") ? 'success' : 'error';
            echo "'>" . $_SESSION['mensagem'] . "</div>";
            unset($_SESSION['mensagem']);
        }
        ?>
    </div>

    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" id="tipo" required><br><br>

        <label for="capacidade">Capacidade:</label>
        <input type="number" name="capacidade" id="capacidade" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" required></textarea><br><br>

        <input type="submit" name="submit" value="Cadastrar Espaço">
    </form>
</body>
</html>

