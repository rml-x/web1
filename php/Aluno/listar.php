<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Alunos</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php

echo "<h1>Listar Alunos</h1>";

echo "<br>";
echo "<br><a href='inserir.php' class='btn-link'>Adicionar novos Alunos</a>";

require_once __DIR__ . '/../conexao.php';

$sql = "SELECT * FROM Aluno";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Matrícula</th><th>Nome</th><th>Email</th><th>#</th><th>#</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["matricula"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>

        <form method='POST' action='excluir.php'>
            <input type='hidden' name='matricula' value='" . htmlspecialchars($row["matricula"]) . "'>
            <input type='submit' value='Excluir'>
        </form>

        </td>";

        echo "<td>

        <form method='GET' action='editar.php'>
            <input type='hidden' name='matricula' value='" . htmlspecialchars($row["matricula"]) . "'>
            <input type='submit' value='Editar'>
        </form>

        </td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum aluno encontrado.";
}

?>

<br>
<a href="../../index.php">Voltar ao Menu</a>

</body>
</html>