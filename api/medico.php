<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Médico</title>
        <link rel="stylesheet" type="text/css" href="/css/medico.css">
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/slick.css" />

    </head>
    <body>
        <form method="GET" action="/pesquisa.php">
            <div id="pesquisar">
            <input type="text" id="pesqui" name="pesquisar" placeholder="PESQUISAR">
            <button type="submit" id="botaoPesq" value="PESQUISAR">OK</button>
            </div>
        </form>
        <main class="col-100 menu-urls">
        
            <div class="menu">
                <ul>
                    <li>
                        <a href="/homepage.php">Pagina Inícial</a>
                    </li>
                    <li>
                        <a href="/cadastro.php">Cadastro/Login</a>
                    </li>
                    
                </ul>
            </div>
            <br><br><br>
    </main>
 
        <?php
                    
            include '/conexao.php';
            session_start();
           
           
            
            
            
             $resultado= mysqli_query($conexao,"SELECT * FROM usuario  ORDER BY nome");
             while($aux = $resultado->fetch_assoc()){
                
                $sql = "SELECT * FROM usuario WHERE codUsu=?";
             if($stmt = $conexao->prepare($sql)){
                 $stmt->bind_param("i",$aux["codUsu"]);
                 if($stmt->execute()){
                     $result = $stmt->get_result();
                     $aux=$result->fetch_assoc();
                     //Colocando a dica numa variável
                     //utf8_encode para mostrar os acentos corretamente
                     $_SESSION["nome"] = $aux["nome"];
                     $_SESSION["sobrenome"] = $aux["sobrenome"];
                 }else{
                 $erro = "Não foi possível fazer a preparação ".$obj_mysqli->error;
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
             echo "<a class='btn' href='/consulta.php?codUsu=".$aux['codUsu']."'>Ver Paciente</a>";

             echo "&nbsp &nbsp";

             echo "<a class='btn' href='/deleta.php?codUsu=".$aux['codUsu']."'>Apagar Paciente</a>";
             echo "<br><br>";
             echo "</fieldset>";

                
         }
        ?>
        <br>
        <div class="btnRelatorio">
            <br><br>
        <a  class="btn btn-primary btn-block" href="/lastest-users.php" target="_blank" role="button">VER RELATORIO</a>
        </div>
     <br><br>
    </body>
</html>