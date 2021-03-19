<?php 
  
  //$vetor = ['2021-04-29','2021-03-24','2021-03-25'];
  $anoAtual = date("Y");
  $numConsultas=0;
  $numMeses=0;

  $server = "localhost";
  $user = "root";
  $pass = "";
  $db = "CLINICA_PW";

  //$idPac = pegaID('pacientes', pegaNome($logado));
  $idPac = '1001';

  try {
      $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
      $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT data FROM exames WHERE id_paciente=:i";
      $resposta = $conn->prepare($sql);
      $resposta->bindParam(':i',$idPac);
      $resposta->execute();
      $conteudo = $resposta->fetchAll(PDO::FETCH_ASSOC);
      //print_r($conteudo[0]['data']);

      /*foreach ($conteudo as $elem){
          print_r ($elem['data']);
      }*/

        $vetorMeses = array(
            '01'=>0, '02'=>0, '03'=>0, '04'=>0,
            '05'=>0, '06'=>0, '07'=>0, '08'=>0,
            '09'=>0, '10'=>0, '11'=>0, '12'=>0
        );

        foreach ($conteudo as $elem){
            if(substr($elem['data'],0,4) == $anoAtual){
                if($vetorMeses[substr($elem['data'],5,2)] == 0){
                    $numMeses++;
                }
                $vetorMeses[substr($elem['data'],5,2)]++;
                $numConsultas++;
            }
        }

        $media = $numConsultas/$numMeses;
      
  }catch (PDOEXception $e){
      echo "Erro: " . "<br>" . $e->getMessage();
  }

  $conn = null;    
   
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="../css/formulario.css" rel="stylesheet" media="all">

    <title>Contadores</title>

</head>
<body>

    <div id="container">
        <h1>&bull; Contadores &bull;</h1>
        <div class="underline">
        </div>  
        
        <div id="container">
            <p>2021</p>
            <ul>
                <li>JAN: <?php echo $vetorMeses['01']?></li>
                <li>FEV: <?php echo $vetorMeses['02']?></li>
                <li>MAR: <?php echo $vetorMeses['03']?></li>
                <li>ABR: <?php echo $vetorMeses['04']?></li>
                <li>MAI: <?php echo $vetorMeses['05']?></li>
                <li>JUN: <?php echo $vetorMeses['06']?></li>
                <li>JUL: <?php echo $vetorMeses['07']?></li>
                <li>AGO: <?php echo $vetorMeses['08']?></li>
                <li>SET: <?php echo $vetorMeses['09']?></li>
                <li>OUT: <?php echo $vetorMeses['10']?></li>
                <li>NOV: <?php echo $vetorMeses['11']?></li>
                <li>DEZ: <?php echo $vetorMeses['12']?></li>
            </ul>

            <p>Média mensal de consultas: <?php echo $media?></p>
            <p>Número de consultas no Ano de <?php echo $anoAtual." é: ".$numConsultas?></p>

        </div>
        
    </div>
</body>
</html>