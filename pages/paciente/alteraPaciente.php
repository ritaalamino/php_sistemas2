<?php

//Incluindo bibliotecas
include("../../php/funcoes.php");

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}
if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != 'paciente')){
    unset($_SESSION['username']);
    $_SESSION['valid'] = false;
    unset($_SESSION['tipo']);
    header('location:../../index.php');
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
  $especialidade = verifica($_POST["especialidade"]);
  $genero = verifica($_POST["genero"]);
  $infos = verifica($_POST["infos"]);

  
  $xml = simplexml_load_file("../../xml/pacientes.xml") or die("ERRO: Não foi possível abrir o XML");

  alterarCadastro($_COOKIE['id'],'nome',$nome);
  alterarCadastro($_COOKIE['id'],'email',$email);
  alterarCadastro($_COOKIE['id'],'senha',$senha);
  alterarCadastro($_COOKIE['id'],'idade',$idade);
  alterarCadastro($_COOKIE['id'],'telefone',$telefone);
  alterarCadastro($_COOKIE['id'],'cpf',$cpf);
  alterarCadastro($_COOKIE['id'],'endereco',$endereco);
  alterarCadastro($_COOKIE['id'],'especialidade',$especialidade);
  alterarCadastro($_COOKIE['id'],'genero',$genero);
  alterarCadastro($_COOKIE['id'],'infos',$infos);

  alerta("Cadastro alterado.");
  redireciona("paciente.php");

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

    <!-- valida form -->
    
    
    <div id="container">
        <h1>&bull; Pacientes &bull;</h1>
        <div class="underline">
        </div>
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
          <div>
            <label for="nome"></label>
            <input type="text" placeholder="Nome completo" name="nome" id="nome" value="<?php echo $_COOKIE['nome'] ?>" required>
          </div>
          <div class="name">
            <label for="email"></label>
            <input type="text" placeholder="E-mail" name="email" id="email" value="<?php echo $_COOKIE['email'] ?>" required>
          </div>
          <div class="email">
            <label for="idade"></label>
            <input type="text" placeholder="Idade" name="idade" id="idade" value="<?php echo $_COOKIE['idade'] ?>" required>
          </div>
          <div>
            <label for="cpf"></label>
            <input type="text" placeholder="CPF" name="cpf" id="cpf" value="<?php echo $_COOKIE['cpf'] ?>" required>
          </div>
          <div>
            <label for="telefone"></label>
            <input type="text" placeholder="Telefone" name="telefone" id="telefone" value="<?php echo $_COOKIE['telefone'] ?>" required>
          </div>
          <div>
            <label for="endereco"></label>
            <input type="text" placeholder="Endereço" name="endereco" id="endereco" rvalue="<?php echo $_COOKIE['endereco'] ?>" equired>
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
            <textarea name="infos" placeholder="Informações adicionais" id="infos" cols="30" rows="3" value="<?php echo $_COOKIE['infos'] ?>" required></textarea>
          </div>
          <div class="submit">
            <input type="submit" value="Cadastrar" id="form_button" />
          </div>
        </form><!-- Fim form -->
      </div><!-- // Fim #container -->
</body>
</html>
