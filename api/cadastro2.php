<?php
    include __DIR__ . '/conexao.php';
    session_start();

    if(!empty($_POST["tipoUsu"]) && !empty($_POST["senha"])){

    $nome      = "";
    $sobrenome = "";
    $email     = "";
    $senha     = "";
    $telefone  = "";
    $datausu   = "";
    $tipoUsu   = "";
    $genero    = "";
    $foto      = "";
    $cpf       = "";
    $confirmar = "";
    $texto     = "";


    if(isset($_POST["nome"]) && isset($_POST["email"]) &&
    isset($_POST["senha"]) && isset($_POST["sobrenome"]) && 
    isset($_POST["telefone"]) && isset($_POST["data"]) && 
    isset($_POST["genero"]) && isset($_POST["cpf"])){

                $nome         = $_POST["nome"];
                $sobrenome    = $_POST["sobrenome"];
                $email        = $_POST["email"];
                $senha        = $_POST["senha"];
                $confirmar    =  $_POST["confirmar"];
                $datausu      = $_POST["data"];
                $telefone     = $_POST["telefone"];
                $tipoUsu      = $_POST["tipoUsu"];
                $genero       = $_POST["genero"];
                $cpf          = $_POST["cpf"];

    if(empty($_POST['nome']) || empty($_POST['cpf'])  || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['confirmar'])){
        if(isset($_POST['cadastrar'])){
            $texto = "DADOS PRECISAM SER INSERIDOS";
        }
        }else{
        include_once("/conexao.php");
        $_nome      = $_POST['nome'];
        $_cpf       = $_POST['cpf'];
        $_email     = $_POST['email'];
        $_senha     = $_POST['senha'];
        $_confirmar = $_POST['confirmar'];
            
            
        $sql = "SELECT codUsu FROM usuario WHERE cpf='".$_POST['cpf']."'";
        if($res=mysqli_query($conexao,$sql)){
        //$resu=mysqli_fetch_assoc($res);
        $counti = mysqli_num_rows($res);
        }
            
            
            
                    
                    // $checkUserName = $conexao->prepare("SELECT id FROM usuario WHERE cpf = ?");
                    // $checkUserName ->bind_param("s",$_cpf);
                    // $checkUserName ->execute();
                    // $counti = $checkUserName ->get_result()->num_rows;
            
                    if($counti > 0 && $_cpf != ""){
                        echo "<script>alert('USUARIO JÁ CADASTRADO')</script>";
                    }
                    else if($_senha != $_confirmar){
                        echo "<script>alert('SENHAS NÃO CONFEREM')</script>";
                    }else if($_cpf!="")
                    {
                        
                    
                
                    



                //OBS: Para funcionar o $_FILES é necessário acrescentar no FORM o atributo enctype="multipart/form-data"

                // SALVANDO A fotos EM UMA PASTA //
                $_PastaImg = "fotos/";
                $_Target_file = $_PastaImg  . basename($_FILES["fotoimg"]["name"]);
                $_Upload = 1;
                $_ImageFileType = strtolower(pathinfo($_Target_file,PATHINFO_EXTENSION));
                //--------------------------------------------------------------------//



                // CHECAGEM SE O ARQUIVO E UMA IMAGEM //
                if(isset($_POST["acao"])) 
                {
                    $_Check = getimagesize($_FILES["fotoimg"]["tmp_name"]);
                    if($_Check == false) 
                    {
                        echo "Arquivo não é uma imagem.";
                        $_Upload = 0;
                    }
                }
                //-----------------------------------------------------//
                

                // CHECAGEM SE O ARQUIVO E MUITO GRANDE //
                if ($_FILES["fotoimg"]["size"] > 500000) 
                {
                    echo "Seu arquivo é muito grande.";
                    $_Upload = 0;
                }
                //--------------------------------------//



                // DEFININDO OS ARQUIVOS QUE PODEM ENTRAR //
                if($_ImageFileType != "jpg" &&  $_ImageFileType != "png" &&  $_ImageFileType != "jpeg") 
                {
                    echo "Desculpe, mas somente poderá utilizar arquivos JPG, JPEG, PNG";
                    $_Upload = 0;
                }
                //-------------------------------------------------------------------------------//



                // CHECAGEM SE O ARQUIVO NAO FOI SALVO //
                if ($_Upload == 0) 
                {
                    echo "Não foi possível gravar o arquivo.";
                } 
                else 
                {
                    if (move_uploaded_file($_FILES["fotoimg"]["tmp_name"], $_Target_file)) 
                    {
                        // RENOMEANDO A IMG //
                        $_Extension = pathinfo($_Target_file, PATHINFO_EXTENSION);
                        $_Rename = time().".".$_Extension;
                        rename($_Target_file,"fotos/". $_Rename);
                        //-----------------------------------------------------//


                        setcookie('cpf','',time()+3600);

                     
                            // INCLUINDO AS VARIAVES NO BANCO
                               
//                                    $sql = "SELECT * FROM usuario ORDER BY codUsu DESC LIMIT 1";
//                                    $result = mysqli_query($conexao,$sql);
//                                    $aux = $result->fetch_assoc();    
                                    setcookie('cpf',$cpf,(time()+3600)*5); //5 horas                                  
                                    $tipoUsu  = $_POST['tipoUsu'];
                                    if($tipoUsu == 'medico' && $senha == 'HelpMemory'){
                                        $senha = $_POST['senha'];
                                        $senha1 = base64_encode($senha);
                                       $sql = "INSERT INTO medico (nome,sobrenome,email,senha,datausu,telefone,genero,foto,cpf) VALUES (?,?,?,?,?,?,?,?,?)";
                                       $stmt =  $conexao->prepare($sql);
                                       //ssss = String,String,String,String  (i-inteiro,s-string,d-double/float,b-objeto)
                                       $stmt->bind_param('sssssssss',$nome,$sobrenome,$email,$senha1,$datausu,$telefone,$genero,$cpf,$_Rename);
                                       if(!$stmt->execute()){
                                           $erro = $stmt->error;
                                           echo $erro;
                                       }else{
                                        header("Location:/medico.php");
                                       }
                                    }else if($tipoUsu=='paciente'){
                                        $senha = md5($_POST['senha']);
                                        $sql = "INSERT INTO usuario (nome,sobrenome,email,senha,datausu,telefone,genero,foto,cpf) VALUES (?,?,?,?,?,?,?,?,?)";
                                        $stmt =  $conexao->prepare($sql);
                                        //ssss = String,String,String,String  (i-inteiro,s-string,d-double/float,b-objeto)
                                        $stmt->bind_param('sssssssss',$nome,$sobrenome,$email,$senha,$datausu,$telefone,$genero,$_Rename,$cpf);
                                        if(!$stmt->execute()){
                                            $erro = $stmt->error;
                                            echo $erro;
                                        }else{
                                            header("Location:/homepage2.php");
                                        }
                                    }
                            
                            
                        //------------------------------------------------------------------------------------------------------------------//
                    
                    }
                    else 
                    {
                        echo "Ocorreu um erro ao salvar arquivo.";
                    }
                }
            }
        }
               
            
     }  
    }
?>
<!----------------------------------COMEÇO DO LOGIN  ------------------------------------------------>
<?php
    include __DIR__ . '/conexao.php';

    $email    = "";
    $senha    = "";
    $tipoUsua = "";

    if(isset($_POST["email"]) && isset($_POST["senha"]) && isset($_POST["tipoUsua"])){

        $email    = $_POST["email"];
        $tipoUsua = $_POST["tipoUsua"];
//        <!----------------------------------COMEÇO DO LOGIN(PACIENTE)  ------------------------------------------------>
        if($tipoUsua =="paciente"){
            $senha = md5($_POST['senha']);
            $verifica = mysqli_query($conexao,"SELECT * FROM usuario WHERE email =
            '$email' AND senha = '$senha'") or die("erro ao selecionar");
            if(mysqli_num_rows($verifica)<=0){
                echo "<script language='javascript' type='text/javascript'>
                alert('Login incorreto');window.location
                .href='/cadastro.php';</script>";
                die();

            }else{
                $aux = $verifica->fetch_assoc();
                setcookie('cpf',$aux['cpf'],(time()+3600)*5);
                setcookie("email",$email);
                header("Location:/homepage2.php");
            }

//            <!----------------------------------COMEÇO DO LOGIN(MEDICO)  ------------------------------------------------>

        }else if($tipoUsua =="medico"){
            $senha = base64_encode($_POST['senha']);
            
            $verifica = mysqli_query($conexao,"SELECT * FROM medico WHERE email =
        '$email' AND senha = '$senha'") or die("erro ao selecionar");
         
          
        if (mysqli_num_rows($verifica)<=0){
            $aux = $verifica->fetch_assoc();
            setcookie("email",$email);
            // echo"<script language='javascript' type='text/javascript'>
            // alert('Login incorreto');window.location
            // .href='rSenha.php?email=".$aux["email"]."';</script>";
            echo"<script language='javascript' type='text/javascript'>
            alert('Login incorreto $senha');window.location
            .href='/cadastro.php';</script>";
            die();
        }else if($senha == 'SGVscE1lbW9yeQ=='){
            $aux = $verifica->fetch_assoc();
            setcookie('cpf',$aux['cpf'],(time()+3600)*5);
            setcookie("email",$email);
            header("Location:/medico.php");
                }else{
                    echo "erroo!!!";
                }
            }
        
        }
    

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/css/cadastro.css"/>
    <script type="text/javascript" src="/js/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
.btn {
    border-radius: 15px;
    text-transform: uppercase;
    color: #fff;
    font-size: 10px;
    padding: 10px 50px;
    cursor: pointer;
    font-weight: bold;
    width: 150px;
    align-self: center;
    border: none;
    margin-top: 1rem;
}
.btn-primary {
    background-color: transparent;
    border: 1px solid #fff;
    transition: background-color .0.1s;
}
.btn-primary:hover {
    background-color: #fff;
    color: black;
    border-color: rgba(74, 115, 139, 0.452);
}


.btn-second {
    background-color: rgba(74, 115, 139, 0.452);
    border: 1px solid black;
    transition: background-color .0.1s;
}
.btn-second:hover {
    background-color: #fff;
    border: 1px solid black;
    color: black;
}
select{
    padding: 5px;
    width: 10000px;
}
.label-input {
    background-color: #ecf0f1;
    display: flex;
    align-items: center;
    margin: 8px;
}
body{
    background-color: rgba(74, 115, 139, 0.452);

}
.header-2{
    background-color: rgba(74, 115, 139, -0.448);
} 

    </style>

        

</head>
<body>
<nav>
        <div class="header-2">
                <div class="menucima">
                    <ul>
                        <li>
                            <a href="/homepage.php">Pagina Inícial</a>
                        </li>
                        <li>
                            <a href="/cadastro.php">Cadastro/Login</a>
                        </li>
                        <li>
                            <a href="/paciente.php">Paciente</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br>
    <main id="conteudo">
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title-primary">Bem Vindo!</h2>
                <p class="description description-primary ">Para se manter conectado com a gente</p>
                <p class="description description-primary">por favor faça o login com suas informações pessoais</p>
                <button id="signin" class="btn btn-primary">Ir para o login</button>
            </div>    
            <div class="second-column">
                <h2 class="title title-second">Criar Conta</h2>

                <p class="description description-second"> Use seu e-mail para o registro:</p>
                <p class="description description-second"> Caso seja um médico é necessario fazer o cadastro pelo site</p>

                <form enctype="multipart/form-data" class="form" method="POST" action="/cadastro.php"><!-- inicio formulario (cadastro)  -->

                    <label class="label-input" for="">
                    <input type="text" placeholder="Nome" name="nome" id="nome" style="text-transform: capitalize;" required>
                    </label>

                    <label class="label-input" for="">
                    <input type="text" placeholder="Sobrenome" name="sobrenome" id="sobrenome" required style="text-transform: capitalize;">
                    </label>

                    <label class="label-input" for="">
                    <input type="text"  id="cpf" name="cpf" maxlength="14" placeholder="cpf" onkeypress="return somentenumero()" required><br><br>
                    </label>

                    <label class="label-input" for="">
                    <input type="text" name="data" OnKeyUp="mascaraData(this);" maxlength="10" id="dataNasc" placeholder="Data de Nascimento" required>
                    </label>

                    <label class="label-input" for="">
                            <select id="genero" name="genero" > 
                            <option value="Masculino" selected>Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </label>


                    <label class="label-input" for="">
                    <input type="email" placeholder="Email" name="email" id="email" required>
                    </label>
                    
                    <label class="label-input" for="">
                    <input type="password" placeholder="Senha" name="senha" id="senha" onblur="return testarSenha()" required>
                    </label>

                    <label class="label-input" for="">
                    <input type="password" placeholder="Confirmar Senha" name="confirmar" id="confirmar" onblur="return testarSenha()" required>
                    </label>

                    <label class="label-input" for="">
                    <input type="text" size="40" id="telefones" name="telefone" maxlength="14" placeholder="telefone" onkeypress="return somentenumero()" required><br><br>
                    </label>

                    <label class="label-input" for="">
                        <select id="tipoUsu" name="tipoUsu" required>
                        <option name = "paciente" value="paciente" selected>Paciente</option>
                        <option name = "medico" value="medico" >Médico</option>
                        </select>
                        </label>
                    </label>

                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify">Foto de perfil</i>
                        <input type="file" class="form-control" placeholder="imagem" name="fotoimg" id="fotoimg" required>
                    </label>

                    <button type="submit" class="btn btn-second" value="Cadastrar" name="cadastrar" id="btnCadastrar" >Cadastrar</button>

                </form><!-- final formulario (cadastro)  -->
            </div><!-- second column -->
        </div><!-- first content -->
        <div class="content second-content">
            <div class="first-column">
                <h2 class="title title-primary">Olá, Amigo!</h2>
                <p class="description description-primary">Insira seus dados pessoais</p>
                <button id="signup" class="btn btn-primary">Ir para o cadastro</button>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Login</h2>

                <p class="description description-second">Use seu e-mail para o login:</p><!-- inicio do formulario (login) -->
             
                <form class="form" method="post" action="/cadastro.php">
                
                    <label class="label-input" for="">
                    <input type="email" placeholder="Email" id="email" name="email" value="<?=$email?>" required>
                    </label>
                
                    <label class="label-input" for="">
                    <input type="password" placeholder="Senha" id="senha" name="senha" value="<?=$senha?>" required>
                    </label>

                    <label class="label-input" for="">
                        <select id="tipoUsua" name="tipoUsua">
                                <option name = "paciente" value="paciente" selected>Paciente</option>
                                <option name = "medico" value="medico">Médico</option>
                        </select>
                    </label>
                  
                    <button class="btn btn-second" name="entrar" onclick="Entrar()" value="entrar">Entrar</button>
                    


                    <!-- fim do formulario (login) -->
                </form>
            </div><!-- second column -->
        </div><!-- second-content -->
    </div>
    
    <script type="text/javascript" src="js/script.js"></script>

    </main>
</body>
</html>