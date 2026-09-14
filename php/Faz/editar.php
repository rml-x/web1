<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Matrícula</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h1>Editar Matrícula</h1>

<?php
require_once __DIR__ . '/../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $matricula_aluno = $_POST["matricula_aluno"];
    $id_disciplina = $_POST["id_disciplina"];

    // Evita duplicar: mesmo aluno + mesma disciplina em OUTRA linha (id diferente)
    $sqlCheck = "SELECT id FROM Faz WHERE matricula_aluno = ? AND id_disciplina = ? AND id != ?";
    $stmtCheck = mysqli_prepare($conn, $sqlCheck);
    mysqli_stmt_bind_param($stmtCheck, "sii", $matricula_aluno, $id_disciplina, $id);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_store_result($stmtCheck);

    if (mysqli_stmt_num_rows($stmtCheck) > 0) {
        echo "Este aluno já está matriculado nessa disciplina em outro registro.";
    } else {
        $sql = "UPDATE Faz SET matricula_aluno = ?, id_disciplina = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sii", $matricula_aluno, $id_disciplina, $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Matrícula atualizada com sucesso!";
        } else {
            echo "Erro ao atualizar Matrícula: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_stmt_close($stmtCheck);

} elseif (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM Faz WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $faz = mysqli_fetch_assoc($result);

    if ($faz) {
        $alunos = mysqli_query($conn, "SELECT matricula, nome FROM Aluno ORDER BY nome");
        $disciplinas = mysqli_query($conn, "SELECT id, nome FROM Disciplina ORDER BY nome");
        ?>
        <form method="POST" action="editar.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($faz['id']) ?>">

            <label for="matricula_aluno">Aluno:</label>
            <select name="matricula_aluno" required>
                <?php while ($aluno = mysqli_fetch_assoc($alunos)): ?>
                    <option value="<?= htmlspecialchars($aluno['matricula']) ?>"
                        <?= ($aluno['matricula'] == $faz['matricula_aluno']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($aluno['nome']) ?> (<?= htmlspecialchars($aluno['matricula']) ?>)
                    </option>
                <?php endwhile; ?>
            </select><br><br>

            <label for="id_disciplina">Disciplina:</label>
            <select name="id_disciplina" required>
                <?php while ($disciplina = mysqli_fetch_assoc($disciplinas)): ?>
                    <option value="<?= htmlspecialchars($disciplina['id']) ?>"
                        <?= ($disciplina['id'] == $faz['id_disciplina']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($disciplina['nome']) ?>
                    </option>
                <?php endwhile; ?>
            </select><br><br>

            <input type="submit" value="Salvar Alterações">
        </form>
        <?php
    } else {
        echo "Matrícula não encontrada.";
    }

    mysqli_stmt_close($stmt);

} else {
    echo "Nenhum id informado.";
}
?>

<br><a href="listar.php">Voltar para a lista de Matrículas</a>

</body>
</html>