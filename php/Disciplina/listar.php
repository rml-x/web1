<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Disciplinas</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php

echo "<h1>Listar Disciplinas</h1>";

echo "<br>";
echo "<br><a href='inserir.php' class='btn-link'>Adicionar novas Disciplinas</a>";

require_once __DIR__ . '/../conexao.php';

// LEFT JOIN pra mostrar o nome do professor (e não travar se id_professor for NULL)
$sql = "SELECT Disciplina.id, Disciplina.nome, Disciplina.sala, Professor.nome AS nome_professor
        FROM Disciplina
        LEFT JOIN Professor ON Disciplina.id_professor = Professor.id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Sala</th><th>Professor</th><th>#</th><th>#</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["sala"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nome_professor"] ?? "Sem professor") . "</td>";
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
    echo "Nenhuma disciplina encontrada.";
}

?>

<br>
<a href="../../index.php">Voltar ao Menu</a>

</body>
</html>