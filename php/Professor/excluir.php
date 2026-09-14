
<link rel="stylesheet" href="../../css/style.css">


<?php
require_once __DIR__ . '/../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM Professor WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Professor excluído com sucesso!";
        echo "<br>Obs: disciplinas que tinham este professor ficaram sem professor (ON DELETE SET NULL).";
    } else {
        echo "Erro ao excluir Professor: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Requisição inválida.";
}
?>

<br><a href="listar.php">Voltar para a lista de Professores</a>