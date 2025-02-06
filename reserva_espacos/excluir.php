<?php
session_start(); 
include('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "DELETE FROM espacos WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['mensagem'] = "Espaço excluído com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir o espaço: " . mysqli_error($conexao);
    }

    
    mysqli_stmt_close($stmt);

    
    header("Location: listar.php");
    exit;
} else {
    $_SESSION['mensagem'] = "ID do espaço não informado!";
    header("Location: listar.php");
    exit;
}
?>
