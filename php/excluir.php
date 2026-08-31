<?php

        require_once 'conexao.php';

        $id = $_POST["id"];

        $sql = "DELETE FROM usuarios WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
  ?> 

            <script>
                
                window.location.href = "http://localhost:8080/listar.php";
            </script>

  <?php
                     
        }    
?>