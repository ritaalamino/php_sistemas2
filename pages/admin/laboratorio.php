<?php

//Incluindo bibliotecas
include("../../php/funcoes.php");

$nome = $email = $senha = $telefone = $cnpj = "";
$endereco = $tipoExame = $infos = "";
$emailErr = $telefoneErr = $cnpjErr = false;
$tudoOk=true;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario
  $nome = teste($_POST["nome"]);
  $email = teste($_POST["email"]);
  $senha = teste($_POST["senha"]);
  $telefone = teste($_POST["telefone"]);
  $cnpj = teste($_POST["cnpj"]);
  $endereco = teste($_POST["endereco"]);
  $tipoExame = teste($_POST["tipoExame"]);
  $infos = teste($_POST["infos"]);

  if(!filter_var($username,FILTER_VALIDATE_EMAIL)){
    $emailErr=true;
    $tudoOk=false;
  }

  if($tudoOk){
    if(jaExiste($email, "../../xml/labs.xml")){
      alerta("Usuário já existe!");
      redireciona("userAdmin.php");
    }else{
      cadastraLab($nome, $email, $senha, $telefone, $cnpj, $endereco, $tipoExame, $infos);
      alerta("Cadastro efetuado");
      redireciona("userAdmin.php");
    }
  }

}

//session_start();

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
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" onsubmit="erros()" ajax="true">
          <div>
            <label for="nome"></label>
            <input type="text" placeholder="Nome completo" name="nome" id="nome" required>
            
          </div>
          <div class="name">
            <label for="email"></label>
            <h6 id="demo">Email inválido!</h6>
            <input type="text" placeholder="E-mail" name="email" id="email" required>
            <h6>CNPJ inválido!</h6>
          </div>
          
          <div class="email">
            <label for="senha"></label>
            <h6>.</h6>
            <input type="password" placeholder="Senha" name="senha" id="senha" required>
          </div>
          <div>
            <label for="cnpj"></label>
            <input type="number" placeholder="CNPJ" name="cnpj" id="cnpj" required>
            
          </div>
          <div>
            <label for="telefone"></label>
            <input type="text" placeholder="Telefone" name="telefone" id="telefone" required>
          </div>
          <div>
            <label for="endereco"></label>
            <input type="text" placeholder="Endereço" name="endereco" id="endereco" required>
          </div>
          <div>
            <label for="tipoExame"></label>
            <select placeholder="Tipo Exame" name="tipoExame" id="tipoExame" required>
              <option disabled hidden selected>Tipo de Exame</option>
              <option>Sangue</option>
              <option>Ultrasom</option>
            </select>
          </div>
          <div>
            <label for="infos"></label>
            <textarea name="infos" placeholder="Informações adicionais" id="infos" cols="30" rows="3" required></textarea>
          </div>
          <div class="submit">
            <input type="submit" value="Cadastrar" id="form_button" />
          </div>
        </form><!-- Fim form -->
      </div><!-- Fim #container -->

      <script>
        function erros(){
          var errEmail = "<?php echo $emailErr; ?>";
          if(errEmail){
            document.getElementById("demo").innerHTML = "Formato de e-mail inválido!";
            //window.alert("Entro no if!");
          }
          submit.preventDefault();
        }
      </script>
</body>
</html>


