<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Matrículas</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php

echo "<h1>Listar Matrículas</h1>";

echo "<br>";
echo "<br><a href='inserir.php' class='btn-link'>Adicionar nova Matrícula</a>";

require_once __DIR__ . '/../conexao.php';

// JOIN com Aluno e Disciplina pra mostrar nomes em vez de ids/matrículas cruas
$sql = "SELECT Faz.id, Aluno.nome AS nome_aluno, Aluno.matricula, Disciplina.nome AS nome_disciplina
        FROM Faz
        JOIN Aluno ON Faz.matricula_aluno = Aluno.matricula
        JOIN Disciplina ON Faz.id_disciplina = Disciplina.id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Aluno</th><th>Matrícula</th><th>Disciplina</th><th>#</th><th>#</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nome_aluno"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["matricula"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nome_disciplina"]) . "</td>";
        echo "<td>

        <form method='POST' action='excluir.php'>
            <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
            <input type='submit' value='Excluir'>
        </form>

        </td>";

        echo "<td>

        <form method='GET' action='editar.php'>
            <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
            <input type='submit' value='Editar'>
        </form>

        </td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhuma matrícula encontrada.";
}

?>
<br>
<a href="../../index.php">Voltar ao Menu</a>

</body>
</html>