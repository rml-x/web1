<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Aluno</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php
require_once __DIR__ . '/../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["matricula"])) {
    $matricula = $_POST["matricula"];

    try {
        $sql = "DELETE FROM Aluno WHERE matricula = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $matricula);
        mysqli_stmt_execute($stmt);

        echo "<p class='mensagem-sucesso'>Aluno excluído com sucesso!</p>";

        mysqli_stmt_close($stmt);

    } catch (mysqli_sql_exception $e) {
        // Código 1451 = tentativa de excluir linha "pai" que ainda tem filhos (FK constraint)
        if ($e->getCode() == 1451) {
            echo "<p class='mensagem-erro'>Não é possível excluir este aluno: ele ainda está matriculado em uma ou mais disciplinas.</p>";
            echo "<p>Exclua primeiro as matrículas dele na tela de Matrículas.</p>";
        } else {
            echo "<p class='mensagem-erro'>Erro ao excluir Aluno: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

} else {
    echo "<p class='mensagem-erro'>Requisição inválida.</p>";
}
?>

<br><a href="listar.php" class="btn-link">Voltar para a lista de Alunos</a>

</body>
</html>