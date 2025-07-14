<?php
    include 'conexao.php';
    //mysqli_set_charset($conexao,'utf8');
    session_start();

    $historico    = "";
    $peso         = "";
    $remedioHist  = "";
    $dataConsulta = "";
    $codUsu       =-1;

    if(isset($_POST['historico']) && isset($_POST['peso']) &&
       isset($_POST['remedioHist']) && isset($_POST['data'])){

       
        $historico        = $_POST["historico"];
        $peso             = $_POST["peso"];
        $remedioHist      = $_POST["remedioHist"];
        $dataConsulta     = $_POST["data"];
        $codUsu           = $_GET["codUsu"];

        $sql  = "UPDATE `historico` SET `historico`=?, `peso`=?, `remedioHist`=?, `dataConsulta`=? WHERE codUsu=?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('ssssi',$historico,$peso,$remedioHist,$dataConsulta,$codUsu);
        if(!$stmt->execute()){
            $erro = $stmt->error;
        }else{
          $resultado = mysqli_query($conexao,"SELECT * FROM historico WHERE codUsu=".$_GET["codUsu"]."");
  
          while($aux = $resultado->fetch_assoc()){  
             echo"<script language='javascript' type='text/javascript'>window.location
             .href='consulta.php?codUsu=".$aux["codUsu"]."';</script>";
          }
         
        
         exit;
        }
    }else if(isset($_GET["codUsu"]) && is_numeric($_GET["codUsu"])){
        $codUsu = $_GET["codUsu"];
        $sql = "SELECT * FROM historico WHERE codUsu=?";
        $stmt = $conexao->prepare($sql);           
        $stmt->bind_param('i',$codUsu);
        $stmt->execute();
        $resultado=$stmt->get_result();
        $aux = $resultado->fetch_assoc();
  
        $codUsu =$aux["codUsu"];
  
        $historico    = $aux["historico"];
        $peso         = $aux["peso"];
        $remedioHist  = $aux["remedioHist"];
        $dataConsulta = $aux["dataConsulta"];
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
        <script type="text/javascript" src="/js/editar.js"></script>        
        <link rel="stylesheet" type="text/css" href="/css/editar.css"/>
    </head>
    <body>
        <form method="POST" action="<?=$_SERVER["PHP_SELF"]."?codUsu=".$_GET["codUsu"]?>">
        <div id="tudo">
            
            <fieldset>
                <table id="base">
                    <tr>
                        <td>
    
                        <label class="titulos">
                    Relatorio:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text" name="historico" id="historico"  style="text-transform: capitalize;" required value="<?=$historico?>">
                </label>
                <br>
            
                <label id="sobre">
                    Peso:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text" name="peso" id="peso" maxlength="5" style="text-transform: capitalize;" required value="<?=$peso?>">
                </label>
                <br>
    
                <label id="data">
                    Prescrição Médica:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text" name="remedioHist" id="remedioHist" style="text-transform: capitalize;" required value="<?=$remedioHist?>">
                </label>
                <br>
                <label class="titulos">
                    Data da Consulta:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text" name="data" id="datausu" OnKeyUp="mascaraData(this);" maxlength="10" style="text-transform: capitalize;" required value="<?=$dataConsulta?>">
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