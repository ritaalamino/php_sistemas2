<?php

//Incluindo bibliotecas
//include("../../php/funcoes.php");
include("../../php/cadastraDB.php");

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}
if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != "admin")){
    unset($_SESSION['username']);
    $_SESSION['valid'] = false;
    unset($_SESSION['tipo']);
    header('location:../../index.php');
    }

$logado = $_SESSION['username'];

$nome = $email = $senha = $idade = $telefone = $cpf = "";
$endereco = $genero = $infos = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario
  $nome = verifica($_POST["nome"]);
  $email = verifica($_POST["email"]);
  $senha = verifica($_POST["senha"]);
  $idade = verifica($_POST["idade"]);
  $telefone = verifica($_POST["telefone"]);
  $cpf = verifica($_POST["cpf"]);
  $endereco = verifica($_POST["endereco"]);
  $genero = verifica($_POST["genero"]);
  $infos = verifica($_POST["infos"]);

  if(jaExisteDB('pacientes',$email, $cpf)){
    alerta("Usuário já existe!");
    redireciona("userAdmin.php");
  }else{
    cadastraPacienteDB($nome, $email, $senha, $idade, $telefone, $cpf, $endereco, $genero, $infos);
    alerta("Cadastro efetuado");
    redireciona("userAdmin.php");
  }
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
        <h1>&bull; Pacientes &bull;</h1>
        <div class="underline">
        </div>
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" onsubmit="return checkForm();">
          <div>
            <label for="nome"></label>
            <h6 id="demo3"></h6>
            <input type="text" placeholder="Nome completo" name="nome" id="nome" required>
          </div>
          <div class="name">
            <label for="email"></label>
            <h6 id="demo"></h6>
            <input type="text" placeholder="E-mail" name="email" id="email" required>
            <h6 id="demo6"></h6>
          </div>
          <div class="email">
            <label for="senha"></label>
            <h6 id="demo2"></h6>
            <input type="password" placeholder="Senha" name="senha" id="senha" required>
          </div>
          <div>
            <label for="idade"></label>
            <input type="number" placeholder="Idade" name="idade" id="idade" required>
          </div>
          <div>
            <label for="cpf"></label>
            <h6 id="demo4"></h6>
            <input type="text" placeholder="CPF" name="cpf" id="cpf" required>
          </div>
          <div>
            <label for="telefone"></label>
            <h6 id="demo5"></h6>
            <input type="text" placeholder="Telefone" name="telefone" id="telefone" required>
          </div>
          <div>
            <label for="endereco"></label>
            <input type="text" placeholder="Endereço" name="endereco" id="endereco" required>
          </div>
          <div>
            <label for="genero"></label>
            <select placeholder="Gênero" name="genero" id="genero" required>
              <option disabled hidden selected>Gênero</option>
              <option>Feminino</option>
              <option>Masculino</option>
              <option>Outro</option>
            </select>
          </div>
          <div>
            <label for="infos"></label>
            <textarea name="infos" placeholder="Informações adicionais" id="infos" cols="30" rows="3" required></textarea>
          </div>
          <div class="submit">
            <input type="submit" value="Cadastrar" id="form_button" />
            <h6 id="demo7"></h6>
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->

      <script>
        function checkForm(){
          var nome = document.getElementById("nome").value
          var email = document.getElementById("email").value
          var cpf = document.getElementById("cpf").value
          var telefone = document.getElementById("telefone").value
          var idade = document.getElementById("idade").value
          var tudoOk = true;
          

          document.getElementById("demo").innerHTML = "";
          document.getElementById("demo2").innerHTML = "";
          document.getElementById("demo3").innerHTML = "";
          document.getElementById("demo4").innerHTML = "";
          document.getElementById("demo5").innerHTML = "";
          document.getElementById("demo6").innerHTML = "";

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
          
          if(cpf.length != 11){
            document.getElementById("demo4").innerHTML = "Formato de CPF inválido!";
            tudoOk=false;
          }

          if(telefone.length < 11 || telefone.length > 12){
            document.getElementById("demo5").innerHTML = "Formato de telefone inválido!";
            tudoOk=false;
          }

          if(idade < 0 || idade > 120){
            document.getElementById("demo6").innerHTML = "Idade inválida!";
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
