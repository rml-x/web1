<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Matricular Aluno em Disciplina</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h1>Matricular Aluno em Disciplina</h1>

<?php

require_once __DIR__ . '/../conexao.php';

// Busca todos os alunos e disciplinas pra popular os <select>
$alunos = mysqli_query($conn, "SELECT matricula, nome FROM Aluno ORDER BY nome");
$disciplinas = mysqli_query($conn, "SELECT id, nome FROM Disciplina ORDER BY nome");
?>

<form method="POST" action="inserir.php">

    <label for="matricula_aluno">Aluno:</label>
    <select name="matricula_aluno" required>
        <option value="">-- Selecione um aluno --</option>
        <?php while ($aluno = mysqli_fetch_assoc($alunos)): ?>
            <option value="<?= htmlspecialchars($aluno['matricula']) ?>">
                <?= htmlspecialchars($aluno['nome']) ?> (<?= htmlspecialchars($aluno['matricula']) ?>)
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="id_disciplina">Disciplina:</label>
    <select name="id_disciplina" required>
        <option value="">-- Selecione uma disciplina --</option>
        <?php while ($disciplina = mysqli_fetch_assoc($disciplinas)): ?>
            <option value="<?= htmlspecialchars($disciplina['id']) ?>">
                <?= htmlspecialchars($disciplina['nome']) ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="submit" value="Matricular">
</form>

<a href="../../index.php">Voltar ao Menu</a>
<br>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula_aluno = $_POST["matricula_aluno"];
    $id_disciplina = $_POST["id_disciplina"];

    // Evita matricular o mesmo aluno duas vezes na mesma disciplina
    $sqlCheck = "SELECT id FROM Faz WHERE matricula_aluno = ? AND id_disciplina = ?";
    $stmtCheck = mysqli_prepare($conn, $sqlCheck);
    mysqli_stmt_bind_param($stmtCheck, "si", $matricula_aluno, $id_disciplina);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_store_result($stmtCheck);

    if (mysqli_stmt_num_rows($stmtCheck) > 0) {
        echo "Este aluno já está matriculado nessa disciplina.";
    } else {
        $sql = "INSERT INTO Faz (matricula_aluno, id_disciplina) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $matricula_aluno, $id_disciplina);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Matrícula realizada com sucesso!";
        } else {
            echo "Erro ao matricular: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_stmt_close($stmtCheck);
}

?>

</body>
</html>