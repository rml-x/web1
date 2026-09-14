

<link rel="stylesheet" href="../../css/style.css">

<?php
require_once __DIR__ . '/../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["matricula"])) {
    $matricula = $_POST["matricula"];

    $sql = "DELETE FROM Aluno WHERE matricula = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $matricula);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Aluno excluído com sucesso!";
    } else {
        // Erro comum aqui: aluno tem matrícula em Faz (foreign key impede exclusão)
        echo "Erro ao excluir Aluno: " . mysqli_error($conn);
        echo "<br>Dica: verifique se este aluno ainda está matriculado em alguma disciplina.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Requisição inválida.";
}
?>

<br><a href="listar.php">Voltar para a lista de Alunos</a>