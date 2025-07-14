<?php
    include 'conexao.php';
    session_start();

    if(isset($_GET["codUsu"]) && is_numeric($_GET["codUsu"])){
        
        $cod = $_GET["codUsu"];
        if(isset($_GET["codUsu"])){
            $sql  = "DELETE FROM usuario WHERE codUsu=?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("i",$cod);
            $stmt->execute();

            $sql  = "DELETE FROM anamnese WHERE codUsu=?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("i",$cod);
            $stmt->execute();


            header ("Location:medico.php");
            exit;

        }
    }
?>