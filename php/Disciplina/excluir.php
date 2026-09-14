
<link rel="stylesheet" href="../../css/style.css">

<?php
require_once __DIR__ . '/../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM Disciplina WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Disciplina excluída com sucesso!";
    } else {
        // Erro comum aqui: existem matrículas (Faz) apontando pra essa disciplina
        echo "Erro ao excluir Disciplina: " . mysqli_error($conn);
        echo "<br>Dica: exclua primeiro as matrículas (Faz) ligadas a esta disciplina.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Requisição inválida.";
}
?>

<br><a href="listar.php">Voltar para a lista de Disciplinas</a>