<?php
//Funções
function alerta($texto){
  echo "<script>alert('${texto}');</script>";
}

function redireciona($url){
  echo "<script> window.location.href = '{$url}'; </script>";
}

function teste($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

/////////////////////////////////////////////

$nome = $email = $senha = $idade = $telefone = $crm = "";
$endereco = $especialidade = $genero = $infos = "";


///////////////////////////////////////////

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

  //Carregando xml
  $xml = simplexml_load_file("../../xml/medicos.xml") or die("ERRO: Não foi possível abrir o XML");

  //Adicionando medico
  $node = $xml->addChild('medico');

  $node->addChild('nome',$nome);
  $node->addChild('email',$email);
  $node->addChild('idade',$idade);
  $node->addChild('telefone',$telefone);
  $node->addChild('crm',$crm);
  $node->addChild('endereco',$endereco);
  $node->addChild('especialidade',$especialidade);
  $node->addChild('genero',$genero);
  $node->addChild('infos',$infos);

  //Salvando no xml
  $dom = dom_import_simplexml($xml)->ownerDocument;
  $dom->formatOutput = true;
  $dom->preserveWhiteSpace = false;
  $dom->loadXML($dom->saveXML());
  $dom->save("../../xml/medicos.xml");

  //Salvando dados no user.xml para login
  $xml = simplexml_load_file("../../xml/user.xml") or die("ERRO: Não foi possível abrir o XML");

  //Adicionando novo usuario medico
  $node = $xml->addChild('user');

  $node->addChild('tipo','medico');
  $node->addChild('login', $email);
  $node->addChild('senha', $senha);

  //Salvando no xml
  $dom = dom_import_simplexml($xml)->ownerDocument;
  $dom->formatOutput = true;
  $dom->preserveWhiteSpace = false;
  $dom->loadXML($dom->saveXML());
  $dom->save("../../xml/user.xml");

  alerta("Cadastro efetuado");
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
        <h1>&bull; Médico &bull;</h1>
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
            <label for="idade"></label>
            <input type="text" placeholder="Idade" name="idade" id="idade" required>
          </div>
          <div>
            <label for="crm"></label>
            <input type="text" placeholder="CRM" name="crm" id="crm" required>
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
            <label for="especialidade"></label>
            <input type="text" placeholder="Especialidade" name="especialidade" id="especialidade" required>
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
          </div>
        </form><!-- Fim form -->
      </div><!-- Fim #container -->
</body>
</html>


