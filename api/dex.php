<?php
    include 'conexao.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Paciente</title>

        <style>
   

img{
    width:  250px;   
    border: 3px dotted #000;
    border-radius: 15px;
    height: 350px;
    
}

        </style>
       
    </head>
    <body>
    
    </body>
    <form>
        
        <?php
            $resultado = mysqli_query($conexao,"SELECT * FROM usuario WHERE cpf='".$_COOKIE['cpf']."'");
            //$resultado = mysqli_query($conexao,"SELECT * FROM usuario WHERE codUsu='".$_GET['codUsu']."'");
            

            while($aux = $resultado->fetch_assoc()){
                $_SESSION["nome"]      = $aux["nome"];
                $_SESSION["sobrenome"] = $aux["sobrenome"];
                $imagedata = file_get_contents("fotos/".$aux["foto"]);
                $data = base64_encode($imagedata);
                ?>



                <fieldset>
                 <legend class='titulo'>Dados Pessoais</legend>
                      <table class='base'>
                
                        <tr>
                           <td>      
                                            
                                        <img src="data:image/jpeg;base64,<?php echo $data?>" />
                                    <br><br>
                              </td>
                              <td>
                                  <label class='dados'>Nome:&nbsp;<?php echo ucfirst($_SESSION["nome"])?></label>
                                    <br>
                                  <label class='dados'>Sobrenome:&nbsp;<?php echo ucfirst($_SESSION["sobrenome"])?></label>
                                    <br>
                                   <label class='dados'>Data de Nascimento:&nbsp;<?php echo $aux["datausu"]?></label>
                                   <br>
                                    <label class='dados'>Gênero:&nbsp;<?php echo $aux["genero"]?></label>
                                     <br>
                                    <label class='dados'>Telefone:&nbsp;<?php echo $aux["telefone"]?></label>
                             </td>
                          </tr>

                          <br><br>
                       </table>
               
                </fieldset>
                <?php
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
                ?>
                <fieldset>
                
                  <legend class='titulo'>Anamnese</legend>
                      <table class='base'>
                
                        <tr>
                              <td>
                                 <label class='dados' >Altura:&nbsp;<?php echo ucfirst($aux["altura"])?></label>
                                    <br>
                                  <label class='dados'>Alergia:&nbsp;<?php echo ucfirst($_SESSION["alergia"])?></label>
                                    <br>
                                   <label class='dados'>Remédios:&nbsp;<?php echo ucfirst($_SESSION["remedios"])?></label>
                                    <br>
                                    <label class='dados'>Histórico Patológico:&nbsp;<?php echo ucfirst($_SESSION["historicoPato"])?></label>
                                     <br>
                                    <label class='dados'>Histórico Social:&nbsp;<?php echo ucfirst($_SESSION["historicoSoci"])?></label>
                                     <br>
                                   <label class='dados'>Tipo Sanguíneo:&nbsp;<?php echo ucfirst($aux["sangue"])?></label>
                              </td>
                          </tr>
                          <br><br>
                       </table>
                        
                
                 </fieldset>

                 <?php
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
                ?>
                <fieldset>
                
                  <legend class='titulo'>Relatorio da Consulta</legend>
                      <table class='base'>
                
                          <tr>
                              <td>
                                  <label class='dados' >O que o paciente tem?&nbsp;<?php echo ucfirst($_SESSION["historico"])?></label>
                                    <br>
                                  <label class='dados'>Peso:&nbsp;<?php echo ucfirst($aux["peso"])?></label>
                                    <br>
                                   <label class='dados'>Remédios Indicados:&nbsp;<?php echo ucfirst($_SESSION["remedioHist"])?></label>
                                    <br>
                                    <label class='dados'>Data da Consulta:&nbsp;<?php echo ucfirst($aux["dataConsulta"])?></label>
                                     <br>
                             </td>
                         </tr>
                       </table>

            
                </fieldset>
                 
                <?php
            }
            ?>
        
    </form>
    
</html>