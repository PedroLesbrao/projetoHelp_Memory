<?php
    session_start();
   include __DIR__ . '/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Paciente</title>
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/slick.css"/>
        <link rel="stylesheet" type="text/css" href="/css/paciente.css"/>

        <script type="text/javascript" src="/js/sair.js"></script>
    </head>
    <body>
    <main class="col-100 menu-urls">
        <div class="header-2">
            <div class="menu">
                <ul>
                    <li>
                        <a href="/omepage2.php">HomePage</a>
                    </li>
                    <li>
                        <a href="/cadastro2.php">Cadastro/Login</a>
                    </li>
                    <li>
                        <a href="/paciente.php">Paciente</a>
                    </li>
                </ul>
            </div>

        </div>
    </main>
    
    <!-- <div id="fotoo">
        <img src= "./imagens/prancheta.png"/>
    </div> -->
    </body>
    <form>
    <div id="ficha">
        <?php
            $resultado = mysqli_query($conexao,"SELECT * FROM usuario WHERE cpf='".$_COOKIE['cpf']."'");
            //$resultado = mysqli_query($conexao,"SELECT * FROM usuario WHERE codUsu='".$_GET['codUsu']."'");
            

            while($aux = $resultado->fetch_assoc()){
                $_SESSION["nome"]      = $aux["nome"];
                $_SESSION["sobrenome"] = $aux["sobrenome"];
         
                echo "<fieldset>";
                echo "      <table class='base'>";
                ////////////////////////////// COMEÇO DOS DADOS PESSOAIS /////////////////////////////
                echo "          <tr>";
                echo "              <td>";
                echo "<br>";
                echo "                  <img src='fotos/".$aux["foto"]."'>";
                echo "                    &nbsp &nbsp";
                echo "              </td>";
                echo "              <td>";
                echo "                  <label id='nome'>&nbsp".ucwords($_SESSION["nome"])." ".ucwords($_SESSION["sobrenome"])."</label>";
                echo "                    <br>";                
                echo "                    <br>";
                // echo "                  <label class='dados'>Sobrenome:&nbsp".ucfirst($_SESSION["sobrenome"])."</label>";
                echo "                   <label class='dados'>Data de Nascimento:&nbsp".$aux["datausu"]."</label> <br>";
                echo "                    <br>";
                echo "                    <label class='dados'>Gênero:&nbsp".$aux["genero"]."</label><br>";
                echo "                     <br>";
                echo "                    <label class='dados'>Telefone:&nbsp".$aux["telefone"]."</label><br>";
                echo "              </td>";
                echo "          </tr>";
                echo "       </table>";
                ////////////////////////////// FIM DOS DADOS PESSOAIS /////////////////////////////
                echo "</fieldset>";
            }

            $resultado = mysqli_query($conexao,"SELECT codUsu FROM usuario WHERE cpf='".$_COOKIE['cpf']."'");
            while($aux = $resultado->fetch_assoc()){
                $sql = "SELECT * FROM anamnese WHERE codUsu=?";
                if($stmt = $conexao->prepare($sql)){
                    $stmt->bind_param("i",$aux["codUsu"]);
                    if($stmt->execute()){
                        $result = $stmt->get_result();
                        $aux=$result->fetch_assoc();

                        $_SESSION["alergia"]       = $aux["alergia"];
                        $_SESSION["remedios"]       = $aux["remedios"];
                        $_SESSION["historicoPato"] = $aux["historicoPato"];
                        $_SESSION["historicoSoci"] = $aux["historicoSoci"];

                    }else{
                    $erro = "Não foi possível fazer a preparação ".$obj_mysqli->error;
                    }
                
                   
                }
                echo "<fieldset>";
                echo "      <table class='base'>";
                ////////////////////////////// COMEÇO DA ANAMNESE /////////////////////////////
                echo "          <tr>";
                echo "              <td>";
                echo "                  <div class='titulo'>".
                                        "ANAMNESE".                        
                                        "</div>";
                echo "                    <br>";
                echo "                  <label class='dados' >Altura:&nbsp".ucfirst($aux["altura"])."</label><br>";
                echo "                    <br>";
                echo "                  <label class='dados'>Alergia:&nbsp".ucfirst($_SESSION["alergia"])."</label><br>";
                echo "                    <br>";
                echo "                   <label class='dados'>Remédios:&nbsp".ucfirst($_SESSION["remedios"])."</label><br>";
                echo "                    <br>";
                echo "                    <label class='dados'>Histórico Patológico:&nbsp".ucfirst($_SESSION["historicoPato"])."</label><br>";
                echo "                     <br>";
                echo "                    <label class='dados'>Histórico Social:&nbsp".ucfirst($_SESSION["historicoSoci"])."</label><br>";
                echo "                     <br>";
                echo "                    <label class='dados'>Tipo Sanguíneo:&nbsp".ucfirst($aux["sangue"])."</label><br>";
                echo "              </td>";
                echo "          </tr>";
                
                echo "       </table>";
               
                ////////////////////////////// FIM DA ANAMNESE /////////////////////////////
                echo "</fieldset>";


            }

            $resultado = mysqli_query($conexao,"SELECT codUsu FROM usuario WHERE cpf='".$_COOKIE['cpf']."'");
            //echo "<script>alert(".$resultado.")</script>";
             while($aux = $resultado->fetch_assoc()){
                 $sql = "SELECT * FROM historico WHERE codUsu=?";
                 if($stmt = $conexao->prepare($sql)){
                     $stmt->bind_param("i",$aux["codUsu"]);
                     if($stmt->execute()){
                         $result = $stmt->get_result();
                         $aux=$result->fetch_assoc();

                         $_SESSION["historico"]      = $aux["historico"];
                         $_SESSION["remedioHist"]    = $aux["remedioHist"];
 
                     }else{
                     $erro = "Não foi possível fazer a preparação ".$obj_mysqli->error;
                     }
                
                   
                }
                echo "<fieldset>";
                echo "      <table class='base'>";
                ////////////////////////////// COMEÇO DO HISTORICO /////////////////////////////
                echo "          <tr>";
                echo "              <td>";
                echo "                  <div id=titulo2>".
                                        "RELATORIO DA CONSULTA".                        
                                        "</div>";
                echo "                  <br>";
                echo "                  <label class='dados' >O que o paciente tem?:&nbsp".ucfirst($_SESSION["historico"])."</label><br>";
                echo "                    <br>";
                echo "                  <label class='dados'>Peso:&nbsp".ucfirst($aux["peso"])."</label><br>";
                echo "                    <br>";
                echo "                   <label class='dados'>Remédios Indicados:&nbsp".ucfirst($_SESSION["remedioHist"])."</label><br>";
                echo "                    <br>";
                echo "                    <label class='dados'>Data da Consulta:&nbsp".ucfirst($aux["dataConsulta"])."</label><br>";
                echo "              </td>";
                echo "          </tr>";
                echo "       </table>";

                ////////////////////////////// FIM DO HISTORICO /////////////////////////////
               
                echo "</fieldset>";
                echo "<br><br><br>";
                
               
                

            }
        ?>
        </div>
    </form>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <button onclick="Imprimir()" id="btnImprimir">IMPRIMIR</button>
    <button onclick="Sair()" id="btnsair">SAIR</button><br>
    <br><br><br>
    <br><br><br>
</html>