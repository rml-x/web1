




<?php
echo "<h1>Adicionar Usuarios</h1>";
?> 


<form method="POST" action="inserir.php">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required><br><br>

    <label for="username">Email:</label>
    <input type="text" name="email" required><br><br>

    <label for="passwd">Password:</label>
    <input type="password" name="passwd" required><br><br>

    <label for="tipo">Função:</label>

    <input type="radio" id="professor" name="funcao" value="professor">
    <label for="professor">Professor</label><br>
    <input type="radio" id="aluno" name="funcao" value="aluno">
    <label for="aluno">Aluno</label><br>
        

    <input type="submit" value="Adicionar Usuario">
</form>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $username = $_POST["username"];
        $passwd = $_POST["passwd"];

        $hashed_passwd = password_hash($passwd, PASSWORD_DEFAULT);

        require_once 'conexao.php';

        //TODO: ATUALIZAR SQL DE ACORDO COM A FORM  
        $sql = "INSERT INTO usuarios (nome, username, passwd) VALUES ('$nome', '$username', '$hashed_passwd')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "Usuário adicionado com sucesso!";
            echo "<br><a href='http://localhost:8080/listar.php'>Voltar para a lista de usuários</a>";
        } else {
            echo "Erro ao adicionar usuário: " . mysqli_error($conn);
        }
 
    }


?> 



