<?php

//Incluindo bibliotecas
include("../../php/funcoes.php");

$nome = $email = $senha = $idade = $telefone = $cpf = "";
$endereco = $genero = $infos = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario
  $nome = teste($_POST["nome"]);
  $email = teste($_POST["email"]);
  $senha = teste($_POST["senha"]);
  $idade = teste($_POST["idade"]);
  $telefone = teste($_POST["telefone"]);
  $cpf = teste($_POST["cpf"]);
  $endereco = teste($_POST["endereco"]);
  $genero = teste($_POST["genero"]);
  $infos = teste($_POST["infos"]);

  if(jaExiste($email, "../../xml/pacientes.xml")){
    alerta("Usuário já existe!");
    redireciona("userAdmin.php");
  }else{
    cadastraPaciente($nome, $email, $senha, $idade, $telefone, $cpf, $endereco, $genero, $infos);
    alerta("Cadastro efetuado");
    redireciona("userAdmin.php");
  }

}

session_start();

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

    <!-- valida form -->
    
    
    <div id="container">
        <h1>&bull; Pacientes &bull;</h1>
        <div class="underline">
        </div>
        <form name="pacienteform" class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" onsubmit="return validateform()">
          <div>
            <label for="nome"></label>
            <input type="text" placeholder="Nome completo" name="nome" id="nome" required>
          </div>
          <div class="name">
            <label for="email"></label>
            <input type="text" placeholder="E-mail" name="email" id="email" required>
          </div>
          <div class="email">
            <label for="senha"></label>
            <input type="text" placeholder="Senha" name="senha" id="senha" required>
          </div>
          <div>
            <label for="idade"></label>
            <input type="text" placeholder="Idade" name="idade" id="idade" required>
          </div>
          <div>
            <label for="cpf"></label>
            <input type="text" placeholder="CPF" name="cpf" id="cpf" required>
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
            <label for="genero"></label>
            <select placeholder="Gênero" name="genero" id="genero" required>
              <option disabled hidden selected>Gênero</option>
              <option>Feminino</option>
              <option>Masculino</option>
            </select>
          </div>
          <div>
            <label for="infos"></label>
            <textarea name="infos" placeholder="Informações adicionais" id="infos" cols="30" rows="3" required></textarea>
          </div>
          <div class="submit">
            <input type="submit" value="Cadastrar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body>
</html>
