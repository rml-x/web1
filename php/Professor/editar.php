<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Professor</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<h1>Editar Professor</h1>

<?php
require_once __DIR__ . '/../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $dia_de_atendimento = $_POST["dia_de_atendimento"];
    $email = $_POST["email"];

    $sql = "UPDATE Professor SET nome = ?, dia_de_atendimento = ?, email = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $nome, $dia_de_atendimento, $email, $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Professor atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar Professor: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);

} elseif (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM Professor WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $professor = mysqli_fetch_assoc($result);

    if ($professor) {
        ?>
        <form method="POST" action="editar.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($professor['id']) ?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($professor['nome']) ?>" required><br><br>

            <label for="dia_de_atendimento">Dia de Atendimento:</label>
            <select name="dia_de_atendimento" required>
                <?php
                $dias = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];
                foreach ($dias as $dia):
                ?>
                    <option value="<?= $dia ?>" <?= ($dia == $professor['dia_de_atendimento']) ? 'selected' : '' ?>>
                        <?= $dia ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="email">Email:</label>
            <input type="text" name="email" value="<?= htmlspecialchars($professor['email']) ?>" required><br><br>

            <input type="submit" value="Salvar Alterações">
        </form>
        <?php
    } else {
        echo "Professor não encontrado.";
    }

    mysqli_stmt_close($stmt);

} else {
    echo "Nenhum id informado.";
}
?>

<br><a href="listar.php">Voltar para a lista de Professores</a>

</body>
</html>