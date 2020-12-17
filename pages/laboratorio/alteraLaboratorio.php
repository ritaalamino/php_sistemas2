<?php
//Funções

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}
$_COOKIE['id'] = $_SESSION['id'];

include("../../php/funcoes.php");

///////////////////////////////////////////////

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

  //Carregando xml
  $xml = simplexml_load_file("../../xml/labs.xml") or die("ERRO: Não foi possível abrir o XML");

  //Carregando laboratório
  //$node = $xml->addChild('lab');

  alterarCadastro($_COOKIE['id'],'nome', $nome);
  alterarCadastro($_COOKIE['id'],'email',$email);
  alterarCadastro($_COOKIE['id'],'telefone',$telefone);
  alterarCadastro($_COOKIE['id'],'cnpj',$cnpj);
  alterarCadastro($_COOKIE['id'],'endereco',$endereco);
  alterarCadastro($_COOKIE['id'],'tipoExame',$tipoExame);
  alterarCadastro($_COOKIE['id'],'infos',$infos);


  alerta("Cadastro alterado");
  redireciona("userAdmin.php");
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
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
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
            <label for="cnpj"></label>
            <input type="text" placeholder="CNPJ" name="cnpj" id="cnpj" required>
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
</body>
</html>


