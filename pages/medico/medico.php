z<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="../../css/formulario.css" rel="stylesheet" media="all">

    <title>Médico</title>
</head>
<body>
    <div id="container">
        <h1>&bull; Medico &bull;</h1>
        <div class="underline">
        </div>
        <?php
            $id = $paciente = $data = $lab = $diagnostico = $exames = $dados = "";

            $file = "../../xml/medicos.xml";
            $xml = simplexml_load_file($file);

            foreach ($xml->children() as $medico) {
              $id = $medico->id;
              $nome = $medico->nome;
              $email = $medico->email;
              $idade = $medico->idade;
              $telefone = $medico->telefone;
              $crm = $medico->crm;
              $endereco = $medico->endereco;
              $especialidade = $medico->especialidade;
              $genero = $medico->genero;
              $info = $medico->infos;
              echo '<div id="container">';
              echo '<p>Nome: ' .$nome .'<br>';
              echo 'E-mail: ' .$email .'<br>';
              echo 'Idade: ' .$idade .'<br>';
              echo 'Telefone: ' .$telefone .'<br>';
              echo 'CRM: ' .$crm .'<br>';
              echo 'Endereço: ' .$endereco .'<br>';
              echo 'Especialidade: ' .$especialidade .'<br>';
              echo 'Genero: ' .$genero .'<br>';
              echo 'Info: ' .$info .'<br>';
              setcookie("id", $id , time()+60000, '/');
              setcookie("tipo", 'medico' , time()+60000, '/');
              echo '<a href ="../../php/altera.php">Alterar</a>';
              echo '</div>';
            }
          ?>
      </div><!-- // End #container -->
</body>
</html>


