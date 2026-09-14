<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Disciplina</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php
echo "<h1>Adicionar Disciplina</h1>";
?>

<?php
// Ajuste o caminho conforme a pasta onde este arquivo estiver
require_once __DIR__ . '/../conexao.php';

// Busca os professores pra popular o select (opcional na criação)
$professores = mysqli_query($conn, "SELECT id, nome FROM Professor ORDER BY nome");
?>

<form method="POST" action="inserir.php">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" required><br><br>

    <label for="sala">Sala:</label>
    <input type="text" name="sala" required><br><br>

    <label for="id_professor">Professor:</label>
    <select name="id_professor">
        <option value="">-- Sem professor --</option>
        <?php while ($professor = mysqli_fetch_assoc($professores)): ?>
            <option value="<?= htmlspecialchars($professor['id']) ?>">
                <?= htmlspecialchars($professor['nome']) ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="submit" value="Adicionar">
</form>

<a href="../../index.php">Voltar ao Menu</a>
<br>
<a href='listar.php'>Voltar para a lista de Disciplinas</a>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $sala = $_POST["sala"];
        // Se nenhum professor for escolhido, salva como NULL (campo é DEFAULT NULL)
        $id_professor = !empty($_POST["id_professor"]) ? $_POST["id_professor"] : null;

        // Prepared statement - evita SQL Injection
        $sql = "INSERT INTO Disciplina (nome, sala, id_professor) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $nome, $sala, $id_professor);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Disciplina adicionada com sucesso!";
            echo "<br><a href='listar.php'>Voltar para a lista de Disciplinas</a>";
        } else {
            echo "Erro ao adicionar Disciplina: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }

?>

</body>
</html>