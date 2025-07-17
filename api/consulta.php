<?php
    include '/conexao.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Consulta</title>
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" type="text/css" href="/css/slick.css"/>
        <link rel="stylesheet" type="text/css" href="/css/paciente.css"/>

        <script type="text/javascript" src="/js/sair.js"></script>
        
    </head>
    <body>
    
    </body>
    <form>
        <div id="ficha">
        <?php
            //$resultado = mysqli_query($conexao,"SELECT * FROM usuario WHERE cpf='".$_COOKIE['cpf']."'");
            $resultado = mysqli_query($conexao,"SELECT * FROM usuario WHERE codUsu='".$_GET['codUsu']."'");
/////////////////////////////////////////////// COMEÇO DOS DADOS PESSOAIS //////////////////////////////////////////////
            while($aux = $resultado->fetch_assoc()){
                $_SESSION["nome"]      = $aux["nome"];
                $_SESSION["sobrenome"] = $aux["sobrenome"];


                echo "<fieldset >";
                echo "      <table id='tabela1'>";
                echo "          <tr>";
                echo "              <td>";
                echo "                  <img src='fotos/".$aux["foto"]."'>";
                echo "                    &nbsp &nbsp";
                echo "              </td>";
                echo "              <td>";

                echo "                  <label id='nome'>&nbsp".ucwords($_SESSION["nome"])." ".ucwords($_SESSION["sobrenome"])."</label><br><br>";

                echo "                   <label class='dados'>Data de Nascimento:&nbsp".$aux["datausu"]."</label><br><br>";

                echo "                    <label class='dados'>Gênero:&nbsp".$aux["genero"]."</label><br><br>";

                echo "                    <label class='dados'>Telefone:&nbsp".$aux["telefone"]."</label><br><br>";

                echo "              </td>";
                echo "          </tr>";
                echo "       </table>";
                echo "<a class='linkFicha' href='/edit.php?codUsu=".$_GET['codUsu']."'>Editar os Dados pessoais</a>";
                echo "</fieldset>";
            }
            ////////////////////////////////////FIM DOS DADOS PESSOAIS /////////////////////////////////////
            $resultado = mysqli_query($conexao,"SELECT codUsu FROM usuario WHERE codUsu=".$_GET["codUsu"]."");
            //echo "<script>alert(".$resultado.")</script>";
             while($aux = $resultado->fetch_assoc()){
                 $sql = "SELECT * FROM anamnese WHERE codUsu=?";
                 if($stmt = $conexao->prepare($sql)){
                     $stmt->bind_param("i",$aux["codUsu"]);
                     if($stmt->execute()){
                         $result = $stmt->get_result();
                         $aux=$result->fetch_assoc();

                        $_SESSION["altura"]        = $aux["altura"];
                        $_SESSION["alergia"]       = $aux["alergia"];
                        $_SESSION["remedios"]       = $aux["remedios"];
                        $_SESSION["historicoPato"] = $aux["historicoPato"];
                        $_SESSION["historicoSoci"] = $aux["historicoSoci"];
                        
                    }else{
                    $erro = "Não foi possível fazer a preparação ".$obj_mysqli->error;

                    }
                
                   
                }
                echo "<fieldset >";
                echo "      <table id='tabela2'>";
                ////////////////////////////// COMEÇO DA ANAMNESE /////////////////////////////
                echo "          <tr>";
                echo "              <td>";
                echo "                  <div class='titulo'>".
                                        "ANAMNESE".                        
                                        "</div>";

                echo "<br>";
                echo "                  <label class='dados' >Altura:&nbsp".ucfirst($aux["altura"])."</label><br><br>";

                echo "                  <label class='dados'>Alergia:&nbsp".ucfirst($_SESSION["alergia"])."</label><br><br>";

                echo "                   <label class='dados'>Remédios:&nbsp".ucfirst($_SESSION["remedios"])."</label><br><br>";

                echo "                    <label class='dados'>Histórico Patológico:&nbsp".ucfirst($_SESSION["historicoPato"])."</label><br><br>";

                echo "                    <label class='dados'>Histórico Social:&nbsp".ucfirst($_SESSION["historicoSoci"])."</label><br><br>";

                echo "                    <label class='dados'>Tipo Sanguíneo:&nbsp".ucfirst($aux["sangue"])."</label><br><br>";

                echo "              </td>";

                echo "          </tr>";

                echo "       </table>";

                echo "<a class='linkFicha' href='/anamnese.php?codUsu=".$_GET['codUsu']."'>Fazer Anamnese</a> &nbsp &nbsp";

                echo "<a class='linkFicha' href='/rAnamnese.php?codUsu=".$_GET['codUsu']."'>Editar a Anamnese</a><br>";


                ////////////////////////////// FIM DA ANAMNESE /////////////////////////////
                echo "</fieldset>";

            }

           $resultado = mysqli_query($conexao,"SELECT codUsu FROM usuario WHERE codUsu=".$_GET["codUsu"]."");
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
                
                echo "<fieldset id='f1'>";
                echo "      <table>";
                ////////////////////////////// COMEÇO DO HISTORICO /////////////////////////////
                echo "          <tr id=tabela3'>";
                echo "              <td>";
                echo "                  <div id=titulo2>".
                                        "RELATORIO DA CONSULTA".                        
                                        "</div>";
              
                echo "<br>";
                echo "                  <label class='dados' maxlength='10'>O que o paciente tem?:&nbsp".ucfirst($_SESSION["historico"])."</label><br><br>";
            
                echo "                  <label class='dados'>Peso:&nbsp".ucfirst($aux["peso"])."</label><br><br>";

                echo "                   <label class='dados'>Remédios Indicados:&nbsp".ucfirst($_SESSION["remedioHist"])."</label><br><br>";

                echo "                    <label class='dados'>Data da Consulta:&nbsp".ucfirst($aux["dataConsulta"])."</label><br><br>";

                echo "              </td>";

                echo "          </tr>";

                echo "       </table>";

                echo "<a class='linkFicha' href='/relatorio.php?codUsu=".$_GET['codUsu']."'>Fazer o Relatório</a> &nbsp &nbsp";

                echo "<a  class='linkFicha' href='/rRelatorio.php?codUsu=".$_GET['codUsu']."'>Editar o Relatório</a>";
                echo " <br><br>";
                echo "<a  id='linkVolta' href='/medico.php'>Voltar</a>";

                ////////////////////////////// FIM DO HISTORICO /////////////////////////////
                echo "</fieldset>";
                echo " <br><br>";

            }
        ?>
        </div>
    </form>
 
    
    <br><br><br>
</html>