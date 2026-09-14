<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h1>Editar Aluno</h1>

<?php
require_once __DIR__ . '/../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formulário enviado - faz o UPDATE
    $matricula_original = $_POST["matricula_original"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $sql = "UPDATE Aluno SET nome = ?, email = ? WHERE matricula = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $matricula_original);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Aluno atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar Aluno: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);

} elseif (isset($_GET["matricula"])) {
    // Veio da listagem - busca os dados atuais e mostra o form
    $matricula = $_GET["matricula"];

    $sql = "SELECT * FROM Aluno WHERE matricula = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $matricula);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $aluno = mysqli_fetch_assoc($result);

    if ($aluno) {
        ?>
        <form method="POST" action="editar.php">
            <input type="hidden" name="matricula_original" value="<?= htmlspecialchars($aluno['matricula']) ?>">

            <label for="matricula">Matrícula:</label>
            <input type="text" value="<?= htmlspecialchars($aluno['matricula']) ?>" disabled><br><br>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($aluno['nome']) ?>" required><br><br>

            <label for="email">Email:</label>
            <input type="text" name="email" value="<?= htmlspecialchars($aluno['email']) ?>" required><br><br>

            <input type="submit" value="Salvar Alterações">
        </form>
        <?php
    } else {
        echo "Aluno não encontrado.";
    }

    mysqli_stmt_close($stmt);

} else {
    echo "Nenhuma matrícula informada.";
}
?>

<br><a href="listar.php">Voltar para a lista de Alunos</a>

</body>
</html>