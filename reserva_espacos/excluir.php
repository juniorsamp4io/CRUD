<?php

include('conexao.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "DELETE FROM espacos WHERE id = $id";
    
    if (mysqli_query($conexao, $sql)) {
        
        header("Location: cadastro.php");  
        exit(); 
    } else {
        echo "Erro ao excluir o espaço: " . mysqli_error($conexao);
    }
} else {
    echo "ID não fornecido.";
}
?>
