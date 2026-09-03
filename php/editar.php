<?php
    require_once 'conexao.php';

    $id_para_atualizar = $_POST["id"];
    $sql = "SELECT * FROM usuarios WHERE id = $id_para_atualizar";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $nome = $row["nome"];
    $username = $row["username"];

?>


<form method="POST" action="atualizar.php">
    <label for="nome">Nome:</label>
    <input type="text" name="nome_edit" value = "<?=$nome?>" required><br><br>

    <label for="username">Username:</label>
    <input type="text" name="username_edit" value = "<?=$username?>" required><br><br>

    <label for="passwd">Password:</label>
    <input type="password" name="passwd_edit" required><br><br>


    <input type="hidden" name="id" value="<?=$id_para_atualizar?>">
    
    <input type="submit" value="Editar Usuario">
</form>
