<?php
    include '/api/conexao.php';
    session_start();
    //mysqli_set_charset($conexao,'utf8');

  $codUsu        = -1;
  $altura        = "";
  $alergia       = "";
  $remedios      = "";
  $historicoPato = "";
  $historicoSoci = "";
  $sangue        = "";

  if(isset($_POST["altura"]) && isset($_POST["alergia"]) && isset($_POST["remedios"]) &&
   isset($_POST["historicoPato"]) && isset($_POST["historicoSoci"]) && isset($_POST["sangue"])){

      $codUsu        = $_GET["codUsu"];
      $altura        = $_POST["altura"];
      $alergia       = $_POST["alergia"];
      $remedios      = $_POST["remedios"];
      $historicoPato = $_POST["historicoPato"];
      $historicoSoci = $_POST["historicoSoci"];
      $sangue        = $_POST["sangue"];

      $sql  = "UPDATE `anamnese` SET `altura`=?, `alergia`=?, `remedios`=?, `historicoPato`=?, `historicoSoci`=?, `sangue`=? WHERE codUsu=?";
      $stmt = $conexao->prepare($sql);
      $stmt->bind_param('ssssssi',$altura,$alergia,$remedios,$historicoPato,$historicoSoci,$sangue,$codUsu);
      if(!$stmt->execute()){
          $erro = $stmt->error;
      }else{
        $resultado = mysqli_query($conexao,"SELECT * FROM anamnese WHERE codUsu=".$_GET["codUsu"]."");

        while($aux = $resultado->fetch_assoc()){  
           echo"<script language='javascript' type='text/javascript'>window.location
           .href='/api/consulta.php?codUsu=".$aux["codUsu"]."';</script>";
        }
       
      
       exit;
      }
  }else if(isset($_GET["codUsu"]) && is_numeric($_GET["codUsu"])){
      $codUsu = $_GET["codUsu"];
      $sql = "SELECT * FROM anamnese WHERE codUsu=?";
      $stmt = $conexao->prepare($sql);           
      $stmt->bind_param('i',$codUsu);
      $stmt->execute();
      $resultado=$stmt->get_result();
      $aux = $resultado->fetch_assoc();

      $codUsu =$aux["codUsu"];

      $altura        = $aux["altura"];
      $alergia       = $aux["alergia"];
      $remedios      = $aux["remedios"];
      $historicoPato = $aux["historicoPato"];
      $historicoSoci = $aux["historicoSoci"];
      $sangue        = $aux["sangue"];
      $stmt->close();
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Anamnese</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/css/anamnese.css"/>
        <script type="text/javascript" src="/js/relatorio.js"></script>        

    </head>
    <body>
    <form method="POST" action="<?=$_SERVER["PHP_SELF"]."?codUsu=".$_GET["codUsu"]?>">      

    <div id="tudo">
            
            <fieldset>
                <table id="base">
                    <tr>
                        <td>
    
                        <label class="titulos">
                    Altura(cm):
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text"  name="altura" OnKeyUp="mascaraAltura(this);" onkeypress="return somentenumero()" maxlength="4" id="altura" step="any" style="text-transform: capitalize;" required value="<?=$altura?>">
 
                </label>
                <br>
            
                <label id="sobre">
                    alergia:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text"  name="alergia" id="alergia" style="text-transform: capitalize;" required value="<?=$alergia?>">
                </label>
                <br>
    
                <label id="data">
                O paciente toma algum<br>remedios?:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text"  name="remedios" id="remedios" style="text-transform: capitalize;" required value="<?=$remedios?>">
                </label>
                <br>
                <label class="titulos">
                Histórico Patológica:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text"  name="historicoPato" id="historicoPato" style="text-transform: capitalize;" required value="<?=$historicoPato?>">
                </label>
                <br>
    <!-- ////////////////////////////////////////////////////////////////////////////////////////// -->
                <label class="titulos">
                Historico Social:
                </label>
                <br>

                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text"  name="historicoSoci" id="historicoSoci" style="text-transform: capitalize;" required value="<?=$historicoSoci?>">
                </label>
                <br>

                <label class="titulos">
                    Tipo Sanguíneo:
                </label>
                <br>
                <label class="label-input" for="">
                <i class="far fa-user icon-modify"></i>
                <input type="text"  name="sangue" id="sangue" style="text-transform: capitalize;" required value="<?=$sangue?>">
            </label>
            <br>
                
                <button  name="finalizar" id="finalizar" >Finalizar</button>
    
                        </td>
                    </tr>
                </table>     
            </fieldset>
                
                </div>
        </form>
    </body>
</html>