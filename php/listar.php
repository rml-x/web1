<?php


echo "<h1>Listar Usuarios do Banco de Dados</h1>";

echo "<br>";
echo "<a href='http://localhost:8080/inserir.php'>Adicionar novos usuários</a>";

require_once 'conexao.php';

$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Username</th><th>#</th><th>#</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td> 
        
        <form method='POST' action='excluir.php'>
            <input type='hidden' name='id' value='" . $row["id"] . "'>
            <input type='submit' value='Excluir'>
        </form>
        
        </td>";


        echo "<td> 
        
        <form method='POST' action='editar.php'>
            <input type='hidden' name='id' value='" . $row["id"] . "'>
            <input type='submit' value='Editar'>
        </form>
        
        
        
        
        </td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum usuário encontrado.";
}

?>
