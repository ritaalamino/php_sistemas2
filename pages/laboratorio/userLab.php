<?php
$texto="mudaaaa";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Rita & Wanderson">

    <link href="../../css/sub_index.css" rel="stylesheet" media="all">

    <title>Clínica PW</title>
</head>
<body>
    <nav style="margin: 15px;">
        <ul class="menuItems">
            <li><a data-item='UserLab'>UserLab</a></li>
            <li><a href='../../index.php' data-item='Log Out'>Log Out</a></li>
        </ul>
    </nav>
    <br><br><br><br><br><br><br><br>

    <div>Sua saúde em primeiro lugar.</div>
    <p data-item='Clínica RW'>Clínica RW</p>

    <section>
    <div>Escolha sua opção:</div>
    <nav>
        <ul class="menuItems">
        <li><a href='laboratorio.php' data-item='Atualizar Cadastro'>Atualizar Cadastro</a></li>
        <li><a href='exames.php' data-item='Cadastra Exames'>Cadastra Exames</a></li>
        <li><a href='consultaExames.php' data-item='Histórico Exames'>Histórico Exames</a></li>
        <li><button onclick="testando()">Mudar</button></li>
        <li><p id="demo">Mudar texto</p></li>
        </ul>
    </nav>

    </section>

    <script>
        var variavel = "<?php echo $texto; ?>";
        function testando(){
            document.getElementById("demo").innerHTML = "<?php echo $texto; ?>";
        }
    </script>
</body>
</html>