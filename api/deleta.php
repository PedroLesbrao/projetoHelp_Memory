<?php
     session_start();
   include __DIR__ . '/conexao.php';

    $resultado = mysqli_query($conexao,"SELECT * FROM usuario WHERE codUsu=".$_GET["codUsu"]."");

    while($aux = $resultado->fetch_assoc()){
        echo "<div class='tudo'";
        echo "<br><br><br>";
        echo "<label>Você deseje APAGAR o paciente?</label>";
        echo "<br><br>";
        echo "<a class='botao' href='/deleta2.php?codUsu=".$_GET['codUsu']."'>Apagar</a>";
        echo "&nbsp &nbsp &nbsp &nbsp";
        echo "<a class='botao' href='/medico.php?codUsu='".$aux["codUsu"]."'>Cancelar</a>";
        echo "<br><br><br>";
        echo "</div>";
    }
?>
<style>
    
    body{
    background-size: cover;
    width: 100%;
    margin: 0 auto;
    margin-bottom: 10px;
    margin-right: 10px;
    margin-top: 10px;
    margin-left: 10px;
    font-size: 30px;
    background-color: rgba(74, 115, 139, 0.452);
    }
    .tudo{
        text-align: center;
        margin-top: 15%;
        margin-left: 20%;
        margin-right: 15%;
        border: solid 3px;

    }
    .botao{
        font-size: 25px;
    padding: 10px;
    font-family: Garamond;
    color: black;
    background-color:   rgba(74, 115, 139, 0.274);
    border: 2px solid;
    border-radius: 10px;
    /* width: 260px; */
    margin-left: 15px;
    height: 45px;
    text-decoration: none ;
    }

</style>