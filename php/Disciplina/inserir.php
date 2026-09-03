<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Aluno</title>
</head>
<body>

<?php
echo "<h1>Adicionar Disciplina</h1>";
?>

<form method="POST" action="inserir.php">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" required><br><br>

    <label for="sala">Sala:</label>
    <input type="text" name="sala" required><br><br>

    <input type="submit" value="Adicionar">
</form>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];

        require_once 'conexao.php';

        // Prepared statement - evita SQL Injection
        $sql = "INSERT INTO Aluno (matricula, nome, email) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $matricula, $nome, $email);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Aluno adicionado com sucesso!";
            echo "<br><a href='listar.php'>Voltar para a lista de Alunos</a>";
        } else {
            echo "Erro ao adicionar Aluno: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }

?>

</body>
</html>