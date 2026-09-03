<?php

 require_once 'conexao.php';
 $id_para_atualizar = $_POST["id"];
 $nome_edit = $_POST["nome_edit"];
 $username_edit = $_POST["username_edit"];
 $passwd_edit = $_POST["passwd_edit"];

 $hashed_passwd_edit = password_hash($passwd_edit, PASSWORD_DEFAULT);
 $sql = "UPDATE usuarios SET nome = '$nome_edit', username = '$username_edit', passwd = '$hashed_passwd_edit' WHERE id = $id_para_atualizar";
    if (mysqli_query($conn, $sql)) {
        header("Location: http://localhost:8080/listar.php");
    }
?>