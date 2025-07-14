<?php
    include 'conexao.php';
    session_start();

    $historico    = "";
    $peso         = "";
    $remedioHist  = "";
    $dataConsulta = "";
    $cod           =-1;

    if(isset($_POST['historico']) && isset($_POST['peso']) &&
       isset($_POST['remedioHist']) && isset($_POST['data'])){

       
        $historico        = $_POST["historico"];
        $peso             = $_POST["peso"];
        $remedioHist      = $_POST["remedioHist"];
        $dataConsulta     = $_POST["data"];
        $cod              = $_GET["codUsu"];

        $sql = "INSERT INTO historico (codUsu, peso, historico,  remedioHist, dataConsulta) VALUES (?,?,?,?,?)";
                $stmt =  $conexao->prepare($sql);
                //ssss = String,String,String,String  (i-inteiro,s-string,d-double/float,b-objeto)
                $stmt->bind_param('issss',$cod,$peso,$historico,$remedioHist,$dataConsulta);
                if(!$stmt->execute()){
                    $erro = $stmt->error;
                }else{
                    $resultado = mysqli_query($conexao,"SELECT * FROM usuario WHERE codUsu='".$_GET['codUsu']."'");
                    /////////////////////////////////////////////// COMEÇO DOS DADOS PESSOAIS //////////////////////////////////////////////
                                while($aux = $resultado->fetch_assoc()){
                                    echo"<script language='javascript' type='text/javascript'>window.location
                                    .href='consulta.php?codUsu=".$aux["codUsu"]."';</script>";
                                }
                }
       }

    
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Relatorio</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
        <script type="text/javascript" src="/js/relatorio.js"></script>



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
                    <input type="text" name="historico" id="historico"  style="text-transform: capitalize;" required >
                </label>
                <br>
            
                <label id="sobre">
                    Peso:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    
                    <input type="text" name="peso" OnKeyUp="mascaraPeso(this);" onkeypress="return somentenumero()" maxlength="5" id="peso" style="text-transform: capitalize;" required >
                </label>
                <br>
    
                <label id="data">
                    Prescrição Médica:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text" name="remedioHist" id="remedioHist" style="text-transform: capitalize;" required >
                </label>
                <br>
                <label class="titulos">
                    Data da Consulta:
                </label>
                <br>
                <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text" name="data" id="datausu" onkeypress="return somentenumero()" OnKeyUp="mascaraData(this);" maxlength="10" style="text-transform: capitalize;" required >
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