<?php 
include 'conexao.php';
session_start();
?>
<?php
      $pesquisar = "";

      if(!empty($_GET["pesquisar"])){
      $pesquisar = $_GET['pesquisar'];           
      $result_ficha="SELECT * FROM usuario WHERE nome  LIKE '$pesquisar%' or sobrenome  LIKE '$pesquisar%' ";
     // $result_ficha="SELECT * FROM usuario WHERE sobrenome  LIKE '%$pesquisar%' ";
      $resultado_ficha=mysqli_query($conexao,$result_ficha);
      
    //   $resultado_ficha= mysqli_query($conexao,"SELECT * FROM usuario WHERE tipoUsuario = 'paciente'");
      while($aux = $resultado_ficha->fetch_assoc()){
        $sql = "SELECT * FROM usuario WHERE codUsu=?";
     if($stmt = $conexao->prepare($sql)){
         $stmt->bind_param("i",$aux["codUsu"]);
         if($stmt->execute()){
             $result = $stmt->get_result();
             $aux=$result->fetch_assoc();
             //Colocando a dica numa variável
             //utf8_encode para mostrar os acentos corretamente
             $_SESSION["nome"]      = $aux["nome"];
             $_SESSION["sobrenome"] = $aux["sobrenome"];
         }else{
         $erro = "Não foi possível fazer a preparação ".$conexao->error;
         }
      }
     
     
      echo "<fieldset>";

      echo "      <table>";

      echo "          <tr>";

      echo "              <td>";
      echo "<br>";
      echo "                  <img id='foto' src='fotos/".$aux["foto"]."'>";
      echo "                    &nbsp &nbsp";

      echo "              </td>";

      echo "              <td>";

      echo "                  <label id='nome'>&nbsp".ucwords($_SESSION["nome"])." ".ucwords($_SESSION["sobrenome"])."</label>";

      echo "              </td>";

      echo "          </tr>";

      echo "       </table>";
      echo "<br><br>";
      echo "<a class='btn' href='consulta.php?codUsu=".$aux['codUsu']."'>Ver Paciente</a>";

      echo "&nbsp &nbsp";

      echo "<a class='btn' href='deleta.php?codUsu=".$aux['codUsu']."'>Apagar Paciente</a>";
      echo "<br><br>";
      echo "</fieldset>";    
 }
}
 ?>
 <!DOCTYPE html>
 <html lang="pt-br">
 <head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Paciente</title>
 <link rel="stylesheet" type="text/css" href="/css/medico.css">
 </head>
 <body>
   
 </body>
 </html>
