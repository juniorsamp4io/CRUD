<?php

include('conexao.php');


$sql = "SELECT * FROM espacos";
$result = mysqli_query($conexao, $sql);

if (!$result) {
    die("Erro ao consultar espaços: " . mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Espaços</title>
</head>
<body>
    <h2>Espaços Cadastrados</h2>
    
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Capacidade</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['tipo'] . "</td>";
                echo "<td>" . $row['capacidade'] . "</td>";
                echo "<td>" . $row['descricao'] . "</td>";
                echo "<td><a href='editar.php?id=" . $row['id'] . "'>Editar</a> | <a href='excluir.php?id=" . $row['id'] . "'>Excluir</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
