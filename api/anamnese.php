<?php
    include '/conexao.php';
    session_start();


    $altura        = "";
    $alergia       = "";
    $remedios      = "";
    $historicoPato = "";
    $historicoSoci = "";
    $sangue        = "";
    $cod           =-1;

    if(isset($_POST['altura']) && isset($_POST['alergia']) &&
       isset($_POST['remedios']) && isset($_POST['historicoPato']) &&
       isset($_POST['historicoSoci']) && isset($_POST['sangue'])){

       
        $altura        = $_POST["altura"];
        $alergia       = $_POST["alergia"];
        $remedios      = $_POST["remedios"];
        $historicoPato = $_POST["historicoPato"];
        $historicoSoci = $_POST["historicoSoci"];
        $sangue        = $_POST["sangue"];
        $cod           = $_GET["codUsu"];

        $sql = "INSERT INTO anamnese (codUsu, altura, alergia, remedios, historicoPato, historicoSoci, sangue) VALUES (?,?,?,?,?,?,?)";
                $stmt =  $conexao->prepare($sql);
                //ssss = String,String,String,String  (i-inteiro,s-string,d-double/float,b-objeto)
                $stmt->bind_param('issssss',$cod,$altura,$alergia,$remedios,$historicoPato,$historicoSoci,$sangue);
                if(!$stmt->execute()){
                    $erro = $stmt->error;
                }else{
                    $resultado = mysqli_query($conexao,"SELECT * FROM anamnese WHERE codUsu=".$_GET["codUsu"]."");
            
                    while($aux = $resultado->fetch_assoc()){  
                        echo"<script language='javascript' type='text/javascript'>window.location
                        .href='/consulta.php?codUsu=".$aux["codUsu"]."';</script>";
                    }
                    exit;
                }
       }

    
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Anamnese</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script type="text/javascript" src="/js/relatorio.js"></script>        
        <link rel="stylesheet" type="text/css" href="/css/anamnese.css"/>
    </head>
    <body>
        <form method="POST" action="<?=$_SERVER["PHP_SELF"]."?codUsu=".$_GET["codUsu"]?>">
        <div id="tudo">
            
            <fieldset>
                <table id="base">
                    <tr>
                        <td>
    
                <label id="altura">
                    Altura(cm):
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    
                    <input type="text"  name="altura" OnKeyUp="mascaraAltura(this);" onkeypress="return somentenumero()" maxlength="4" id="altura" step="any" style="text-transform: capitalize;" required >
                </label>
                <br>
            
                <label id="alergia">
                    Alergia:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text"  name="alergia" id="alergia" style="text-transform: capitalize;" required >
                </label>
                <br>
    
                <label id="reme">
                O paciente toma algum<br>remedios?:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text"  name="remedios" id="remedios" style="text-transform: capitalize;" required >
                </label>
                <br>
                <label id="hist">
                Histórico Patológica:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text"  name="historicoPato" id="historicoPato" style="text-transform: capitalize;" required >
                </label>
                <br>
    <!-- ////////////////////////////////////////////////////////////////////////////////////////// -->
                <label id="histo">
                Historico Social:
                </label>
                <br>

                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text"  name="historicoSoci" id="historicoSoci" style="text-transform: capitalize;" required >
                </label>
                <br>

                <label id="sangue">
                    Tipo Sanguíneo:
                </label>
                <br>
                <label class="label-input" for="">
                <i class="far fa-user icon-modify"></i>
                <input type="text"  name="sangue"  style="text-transform: capitalize;" required >
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