<?php

//Incluindo bibliotecas
include("../../php/funcoes.php");

function verifica($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function alterarCadastro($consultaID,$parametro,$valor){
  $file = "../../xml/consultas.xml";
  $xml = simplexml_load_file($file) or die("XML não acessado.");

  for($i = 0; $i < $xml->count(); $i++){
    if ($xml->consulta[$i]->id == $consultaID){
      $xml->consulta[$i]->$parametro = $valor;
    }
  }

  //Salvando no xml
  $dom = dom_import_simplexml($xml)->ownerDocument;
  $dom->formatOutput = true;
  $dom->preserveWhiteSpace = false;
  $dom->loadXML($dom->saveXML());
  $dom->save("../../xml/consultas.xml");
}


$nome = $email = $senha = $idade = $telefone = $crm = "";
$endereco = $especialidade = $genero = $infos = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario
  $nome = teste($_POST["nome"]);
  $email = teste($_POST["email"]);
  $senha = teste($_POST["senha"]);
  $idade = teste($_POST["idade"]);
  $telefone = teste($_POST["telefone"]);
  $crm = teste($_POST["crm"]);
  $endereco = teste($_POST["endereco"]);
  $especialidade = teste($_POST["especialidade"]);
  $genero = teste($_POST["genero"]);
  $infos = teste($_POST["infos"]);

  
  $xml = simplexml_load_file("../../xml/medicos.xml") or die("ERRO: Não foi possível abrir o XML");

  alterarCadastro($_COOKIE['id'],'nome',$nome);
  alterarCadastro($_COOKIE['id'],'email',$email);
  alterarCadastro($_COOKIE['id'],'senha',$senha);
  alterarCadastro($_COOKIE['id'],'idade',$idade);
  alterarCadastro($_COOKIE['id'],'telefone',$telefone);
  alterarCadastro($_COOKIE['id'],'crm',$crm);
  alterarCadastro($_COOKIE['id'],'endereco',$endereco);
  alterarCadastro($_COOKIE['id'],'especialidade',$especialidade);
  alterarCadastro($_COOKIE['id'],'genero',$genero);
  alterarCadastro($_COOKIE['id'],'infos',$infos);

  alerta("Cadastro alterado.");
  redireciona("medico.php");

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

    <title>Clínica PW</title>
</head>
<body>
    <div id="container">
        <h1>&bull; Médico &bull;</h1>
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
            <label for="senha"></label>
            <input type="text" placeholder="Senha" name="senha" id="senha" value="<?php echo $_COOKIE['senha'] ?>" required>
          </div>
          <div>
            <label for="idade"></label>
            <input type="text" placeholder="Idade" name="idade" id="idade" value="<?php echo $_COOKIE['idade'] ?>" required>
          </div>
          <div>
            <label for="crm"></label>
            <input type="text" placeholder="CRM" name="crm" id="crm" value="<?php echo $_COOKIE['crm'] ?>" required>
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
            <label for="especialidade"></label>
            <input type="text" placeholder="Especialidade" name="especialidade" id="especialidade" value="<?php echo $_COOKIE['especiaçodade'] ?>" required>
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
      </div><!-- Fim #container -->
</body>
</html>


