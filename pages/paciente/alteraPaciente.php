<?php

//Incluindo bibliotecas
include("../../php/funcoes.php");

$generos = simplexml_load_file("../../xml/tipoGeneros.xml") or die("ERRO: Não foi possível abrir o XML");


ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}
if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != 'paciente')){
  if($_SESSION['tipo'] != 'admin'){
    unset($_SESSION['username']);
    $_SESSION['valid'] = false;
    unset($_SESSION['tipo']);
    header('location:../../index.php');
    }
  }

$logado = $_SESSION['username'];


$nome = $email = $senha = $idade = $telefone = $crm = "";
$endereco = $especialidade = $genero = $infos = "";

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

  $indice = strval($_COOKIE['id']);

  $server = "localhost";
  $user = "root";
  $pass = "";
  $db = "CLINICA_PW";

  //$xml = simplexml_load_file("../../xml/pacientes.xml") or die("ERRO: Não foi possível abrir o XML");

  try {
      $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
      $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE pacientes SET nome = :n WHERE id = :id;
              UPDATE pacientes SET email = :e WHERE id = :id;
              UPDATE pacientes SET senha = :s WHERE id = :id;
              UPDATE pacientes SET telefone = :t WHERE id = :id;
              UPDATE pacientes SET cpf = :c WHERE id = :id;
              UPDATE pacientes SET endereco = :en WHERE id = :id;
              UPDATE pacientes SET genero = :gen WHERE id = :id;
              UPDATE pacientes SET idade = :ide WHERE id = :id;
              UPDATE pacientes SET infos = :ifu WHERE id = :id;
      ";
      $resposta = $conn->prepare($sql);
      $resposta->bindParam(':id',$indice);
      $resposta->bindParam(':n',$nome);
      $resposta->bindParam(':e',$email);
      $resposta->bindParam(':s',$senha);
      $resposta->bindParam(':ide',$idade);
      $resposta->bindParam(':t',$telefone);
      $resposta->bindParam(':c',$cpf);
      $resposta->bindParam(':en',$endereco);
      $resposta->bindParam(':gen',$genero);
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
      
      alerta("Cadastro atualizado.");
      redireciona("userPac.php");
      
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
    <script src="../../js/script.js"></script>

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
            <input type="text" placeholder="Nome completo" name="nome" id="nome" value="<?php echo $_COOKIE['nome'] ?>" required>
          </div>
          <div class="name">
            <label for="email"></label>
            <h6 id="demo"></h6>
            <input type="text" placeholder="E-mail" name="email" id="email" value="<?php echo $_COOKIE['email'] ?>" required>
            <h6 id="demo6"></h6>
          </div>
          <div class="email">
            <label for="senha"></label>
            <h6 id="demo2"></h6>
            <input type="password" placeholder="Senha" name="senha" id="senha" required>
          </div>
          <div>
            <label for="idade"></label>
            <input type="number" placeholder="Idade" name="idade" id="idade" value="<?php echo $_COOKIE['idade'] ?>" required>
          </div>
          <div>
            <label for="cpf"></label>
            <h6 id="demo4"></h6>
            <input type="text" placeholder="CPF" name="cpf" id="cpf" value="<?php echo $_COOKIE['cpf'] ?>" required>
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
            <label for="genero"></label>
            <select placeholder="Gênero" name="genero" id="genero" required>
              <option disabled hidden selected>Gênero</option>
              <<?php foreach($generos as $genero){
                if($genero->tipo == $_COOKIE['genero']){
                  echo "<option selected>".$genero->tipo."</option>";
                } else { echo "<option>".$genero->tipo."</option>";}} ?>
            </select>
          </div>
          <div>
            <label for="infos"></label>
            <textarea name="infos" placeholder="Informações adicionais" id="infos" cols="30" rows="3" required><?php echo $_COOKIE['infos'] ?></textarea>
          </div>
          <div class="submit">
            <input type="submit" value="Alterar" id="form_button" />
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
