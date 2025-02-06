<?php
session_start(); 
include('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "SELECT * FROM espacos WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id); 
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
    
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $capacidade = $_POST['capacidade'];
    $descricao = $_POST['descricao'];

    
    $update_sql = "UPDATE espacos SET nome = ?, tipo = ?, capacidade = ?, descricao = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $update_sql);

    
    mysqli_stmt_bind_param($stmt, "ssisi", $nome, $tipo, $capacidade, $descricao, $id);

    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['mensagem'] = "Espaço atualizado com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar o espaço: " . mysqli_error($conexao);
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
    <title>Editar Espaço</title>
</head>
<body>
    <h2>Editar Espaço</h2>

    
    <?php
    if (isset($_SESSION['mensagem'])) {
        echo "<p>" . $_SESSION['mensagem'] . "</p>";
        unset($_SESSION['mensagem']); 
    }
    ?>

    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $espaco['nome']; ?>" required><br><br>

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" id="tipo" value="<?php echo $espaco['tipo']; ?>" required><br><br>

        <label for="capacidade">Capacidade:</label>
        <input type="number" name="capacidade" id="capacidade" value="<?php echo $espaco['capacidade']; ?>" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" required><?php echo $espaco['descricao']; ?></textarea><br><br>

        <input type="submit" name="submit" value="Atualizar Espaço">
    </form>
</body>
</html>
