<?php

//Incluindo bibliotecas
include("../../php/cadastraDB.php");

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}
if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != "lab")){
    unset($_SESSION['username']);
    $_SESSION['valid'] = false;
    unset($_SESSION['tipo']);
    header('location:../../index.php');
    }

$logado = $_SESSION['username'];

$nome = $email = $senha = $telefone = $cnpj = "";
$endereco = $tipoExame = $infos = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario
  $nome = verifica($_POST["nome"]);
  $email = verifica($_POST["email"]);
  $senha = verifica($_POST["senha"]);
  $telefone = verifica($_POST["telefone"]);
  $cnpj = verifica($_POST["cnpj"]);
  $endereco = verifica($_POST["endereco"]);
  $tipoExame = verifica($_POST["tipoExame"]);
  $infos = verifica($_POST["infos"]);

  $indice = strval($_COOKIE['id']);

  $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
  $user = "root";
  $pass = "Oitona66.";
  $db = "CLINICA_PW";

  try {
    $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
    $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE laboratorios SET nome = :n WHERE id = :id;
            UPDATE laboratorios SET email = :e WHERE id = :id;
            UPDATE laboratorios SET senha = :s WHERE id = :id;
            UPDATE laboratorios SET telefone = :t WHERE id = :id;
            UPDATE laboratorios SET cnpj = :c WHERE id = :id;
            UPDATE laboratorios SET endereco = :en WHERE id = :id;
            UPDATE laboratorios SET tipoExame = :te WHERE id = :id;
            UPDATE laboratorios SET infos = :ifu WHERE id = :id;
    ";
    $resposta = $conn->prepare($sql);
    $resposta->bindParam(':id',$indice);
    $resposta->bindParam(':n',$nome);
    $resposta->bindParam(':e',$email);
    $resposta->bindParam(':s',$senha);
    $resposta->bindParam(':t',$telefone);
    $resposta->bindParam(':c',$cnpj);
    $resposta->bindParam(':en',$endereco);
    $resposta->bindParam(':te',$tipoExame);
    $resposta->bindParam(':ifu',$infos);
    $resposta->execute();

    $sql = "UPDATE usuarios SET nome = :n WHERE id = :id;
            UPDATE usuarios SET email = :e WHERE id = :id;
            UPDATE usuarios SET senha = :s WHERE id = :id;
    ";
    $resposta = $conn->prepare($sql);
    $resposta->bindParam(':id',$indice);
    $resposta->bindParam(':n',$nome);
    $resposta->bindParam(':e',$email);
    $resposta->bindParam(':s',$senha);
    $resposta->execute();
    
    alerta("Cadastro atualizado");
    redireciona("userLab.php");
    
}catch (PDOEXception $e){
    echo "Erro: " . "<br>" . $e->getMessage();
}

$conn = null;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="../../css/formulario.css" rel="stylesheet" media="all">

    <title>Clínica PW</title>
</head>
<body>
    <div id="container">
        <h1>&bull; Laboratório &bull;</h1>
        <div class="underline">
        </div>
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" onsubmit="return checkForm();" >
          <div>
            <label for="nome"></label>
            <h6 id="demo3"></h6>
            <input type="text" placeholder="Nome completo" name="nome" id="nome" value="<?php echo $_COOKIE['nome'] ?>" required>
            
          </div>
          <div class="name">
            <label for="email"></label>
            <h6 id="demo"></h6>
            <input type="text" placeholder="E-mail" name="email" id="email" value="<?php echo $_COOKIE['email'] ?>" required>
            <h6 id="demo4"></h6>
          </div>
          
          <div class="email">
            <label for="senha"></label>
            <h6 id="demo2"></h6>
            <input type="password" placeholder="Senha" name="senha" id="senha" required>
          </div>
          
          <div>
            <label for="cnpj"></label>
            <input type="text" placeholder="CNPJ" name="cnpj" id="cnpj" value="<?php echo $_COOKIE['cnpj'] ?>" required>
      
          </div>
          <div>
            <label for="telefone"></label>
            <h6 id="demo5"></h6>
            <input type="text" placeholder="Telefone" name="telefone" id="telefone" value="<?php echo $_COOKIE['telefone'] ?>" required>
          </div>
          <div>
            <label for="endereco"></label>
            <input type="text" placeholder="Endereço" name="endereco" id="endereco" value="<?php echo $_COOKIE['endereco'] ?>" required>
          </div>
          <div>
            <label for="tipoExame"></label>
            <select placeholder="Especialidade de Exame" name="tipoExame" id="tipoExame" required>
              <option disabled hidden selected>Tipo de Exame</option>
              <option selected><?php echo $_COOKIE['tipoExame'] ?></option>
              <option>Geral</option>
              <option>Sangue</option>
              <option>Ultrasom</option>
              <option>Endoscopia</option>
            </select>
          </div>
          <div>
            <label for="infos"></label>
            <textarea name="infos" placeholder="Informações adicionais" id="infos" cols="30" rows="3" required><?php echo $_COOKIE['infos'] ?></textarea>
          </div>
          <div class="submit">
            <input type="submit" value="Atualizar" id="form_button" />
            <h6 id="demo7"></h6>
          </div>
        </form><!-- Fim form -->
      </div><!-- Fim #container -->

    <script>
        function checkForm(){
          var nome = document.getElementById("nome").value
          var email = document.getElementById("email").value
          var cnpj = document.getElementById("cnpj").value
          var telefone = document.getElementById("telefone").value
          var tudoOk = true;
          

          document.getElementById("demo").innerHTML = "";
          document.getElementById("demo2").innerHTML = "";
          document.getElementById("demo3").innerHTML = "";
          document.getElementById("demo4").innerHTML = "";
          document.getElementById("demo5").innerHTML = "";

          if(email.indexOf('@')==-1 || email.indexOf('.')==-1){
            document.getElementById("demo").innerHTML = "Formato de e-mail inválido!";
            document.getElementById("demo2").innerHTML = ".";
            tudoOk=false;
            
          }
          if(nome.indexOf('0')!=-1 || 
            nome.indexOf('1')!=-1 || 
            nome.indexOf('2')!=-1 || 
            nome.indexOf('3')!=-1 || 
            nome.indexOf('4')!=-1 || 
            nome.indexOf('5')!=-1 || 
            nome.indexOf('6')!=-1 || 
            nome.indexOf('7')!=-1 || 
            nome.indexOf('8')!=-1 || 
            nome.indexOf('9')!=-1){
            
              document.getElementById("demo3").innerHTML = "Nome não pode conter números!";
              tudoOk=false;
          }
          
          if(cnpj.length != 14){
            document.getElementById("demo4").innerHTML = "Formato de CNPJ inválido!";
            tudoOk=false;
          }

          if(telefone.length < 11 || telefone.length > 12){
            document.getElementById("demo5").innerHTML = "Formato de telefone inválido!";
            tudoOk=false;
          }

          if(tudoOk){
            return true;
          }else{
            document.getElementById("demo7").innerHTML = "Campos preenchidos incorretamente!";
            return false;
          }
                
        } 
    </script>
</body>
</html>


