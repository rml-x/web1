<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Professor</title>
</head>
<body>

<?php
echo "<h1>Adicionar Professor</h1>";
?>

<form method="POST" action="inserir.php">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" required><br><br>

    <label for="dia_de_atendimento">Dia de Atendimento</label>
        <select id="dia_de_atendimento" name="dia_de_atendimento">
            <option value="segunda">Segunda</option>
            <option value="terca">Terça</option>
            <option value="quarta">Quarta</option>
            <option value="quinta">Quinta</option>
            <option value="sexta">Sexta</option>
        </select>

    <label for="email">Email:</label>
    <input type="text" name="email" required><br><br>

    <input type="submit" value="Adicionar">
</form>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $dia_de_atendimento = $_POST["dia_de_atendimento"];
        $email = $_POST["email"];

        require_once __DIR__ . '/../conexao.php';

        // Prepared statement - evita SQL Injection
        $sql = "INSERT INTO Professor (nome, dia_de_atendimento, email) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $nome, $dia_de_atendimento, $email);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Professor adicionado com sucesso!";
            echo "<br><a href='listar.php'>Voltar para a lista de Professores</a>";
        } else {
            echo "Erro ao adicionar Professor: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }

?>

</body>
</html>