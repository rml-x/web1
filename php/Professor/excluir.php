<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Matrícula</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php
require_once __DIR__ . '/../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    try {
        $sql = "DELETE FROM Faz WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        echo "<p class='mensagem-sucesso'>Matrícula excluída com sucesso!</p>";

        mysqli_stmt_close($stmt);

    } catch (mysqli_sql_exception $e) {
        echo "<p class='mensagem-erro'>Erro ao excluir Matrícula: " . htmlspecialchars($e->getMessage()) . "</p>";
    }

} else {
    echo "<p class='mensagem-erro'>Requisição inválida.</p>";
}
?>

<br><a href="listar.php" class="btn-link">Voltar para a lista de Matrículas</a>

</body>
</html>