<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Disciplina</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h1>Editar Disciplina</h1>

<?php
require_once __DIR__ . '/../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $sala = $_POST["sala"];
    $id_professor = !empty($_POST["id_professor"]) ? $_POST["id_professor"] : null;

    $sql = "UPDATE Disciplina SET nome = ?, sala = ?, id_professor = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssii", $nome, $sala, $id_professor, $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Disciplina atualizada com sucesso!";
    } else {
        echo "Erro ao atualizar Disciplina: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);

} elseif (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM Disciplina WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $disciplina = mysqli_fetch_assoc($result);

    if ($disciplina) {
        $professores = mysqli_query($conn, "SELECT id, nome FROM Professor ORDER BY nome");
        ?>
        <form method="POST" action="editar.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($disciplina['id']) ?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($disciplina['nome']) ?>" required><br><br>

            <label for="sala">Sala:</label>
            <input type="text" name="sala" value="<?= htmlspecialchars($disciplina['sala']) ?>" required><br><br>

            <label for="id_professor">Professor:</label>
            <select name="id_professor">
                <option value="">-- Sem professor --</option>
                <?php while ($professor = mysqli_fetch_assoc($professores)): ?>
                    <option value="<?= htmlspecialchars($professor['id']) ?>"
                        <?= ($professor['id'] == $disciplina['id_professor']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($professor['nome']) ?>
                    </option>
                <?php endwhile; ?>
            </select><br><br>

            <input type="submit" value="Salvar Alterações">
        </form>
        <?php
    } else {
        echo "Disciplina não encontrada.";
    }

    mysqli_stmt_close($stmt);

} else {
    echo "Nenhum id informado.";
}
?>

<br><a href="listar.php">Voltar para a lista de Disciplinas</a>

</body>
</html>