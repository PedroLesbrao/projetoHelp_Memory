<?php
    include 'conexao.php';
    //mysqli_set_charset($conexao,'utf8');
    session_start();

    $nome      = "";
    $sobrenome = "";
    $datausu   = "";
    $genero    = "";
    $telefone  = "";
    $cod       =-1;

    if(isset($_POST['nome']) && isset($_POST['sobrenome']) &&
       isset($_POST['genero']) && isset($_POST['telefone']) && 
       isset($_POST['data'])){

       
        $nome      = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"];
        $datausu   = $_POST["data"];
        $genero    = $_POST["genero"];
        $telefone  = $_POST["telefone"];
        $cod       = $_GET["codUsu"];

        $sql  = "UPDATE `usuario` SET `nome`=?, `sobrenome`=?, `datausu`=?, `genero`=?, `telefone`=? WHERE codUsu=?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('sssssi',$nome,$sobrenome,$datausu,$genero,$telefone,$cod);
        if(!$stmt->execute()){
            $erro = $stmt->error;
        }else{
          $resultado = mysqli_query($conexao,"SELECT * FROM usuario WHERE codUsu=".$_GET["codUsu"]."");
  
          while($aux = $resultado->fetch_assoc()){  
             echo"<script language='javascript' type='text/javascript'>window.location
             .href='consulta.php?codUsu=".$aux["codUsu"]."';</script>";
          }
         
        
         exit;
        }
    }else if(isset($_GET["codUsu"]) && is_numeric($_GET["codUsu"])){
        $codUsu = $_GET["codUsu"];
        $sql = "SELECT * FROM usuario WHERE codUsu=?";
        $stmt = $conexao->prepare($sql);           
        $stmt->bind_param('i',$codUsu);
        $stmt->execute();
        $resultado=$stmt->get_result();
        $aux = $resultado->fetch_assoc();
  
        $codUsu =$aux["codUsu"];
  
        $nome      = $aux["nome"];
        $sobrenome = $aux["sobrenome"];
        $datausu   = $aux["datausu"];
        $genero    = $aux["genero"];
        $telefone  = $aux["telefone"];
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
                Nome:
            </label>
            <br>
            <label class="label-input" for="">
                <i class="far fa-user icon-modify"></i>
                <input type="text" placeholder="Nome:" name="nome" id="nome" style="text-transform: capitalize;" required value="<?=$nome?>">
            </label>
            <br>
        
            <label id="sobre">
                Sobrenome:
            </label>
            <br>
            <label class="label-input" for="">
                <i class="far fa-user icon-modify"></i>
                <input type="text" placeholder="Sobrenome:" name="sobrenome" id="sobrenome" style="text-transform: capitalize;" required value="<?=$sobrenome?>">
            </label>
            <br>

            <label id="data">
                Data de Nascimento:
            </label>
            <br>
            <label class="label-input" for="">
                <i class="far fa-user icon-modify"></i>
                <input type="text" placeholder="Data de Nascimento:" name="data" id="datausu" OnKeyUp="mascaraData(this);" maxlength="10" style="text-transform: capitalize;" required value="<?=$datausu?>">
            </label>
            <br>
            <label class="titulos">
                Gênero:
            </label>
            <br>
            <label class="label-input" for="">
                <i class="far fa-user icon-modify"></i>
                <input type="text" placeholder="Gênero:" name="genero" id="genero"  style="text-transform: capitalize;" disabled  value="<?=$genero?>">
            </label>
            <br>
<!-- ////////////////////////////////////////////////////////////////////////////////////////// -->
            <label class="label-input" for="">
                            <select id="genero2" name="genero" > 
                            <option value="Masculino" selected>Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </label>
            <br>

            <label class="titulos">
                Telefone:
            </label>
            <br>
            <label class="label-input" for="">
                <i class="far fa-user icon-modify"></i>
                <input type="text"  id="telefone" name="telefone" maxlength="14" placeholder="telefone" onkeypress="return somentenumero()" value="<?=$telefone?>" required><br><br>
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