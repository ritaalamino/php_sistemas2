<?php
    function alerta($texto){
        echo "<script>alert('${texto}');</script>";
      }
      
      function redireciona($url){
        echo "<script> window.location.href = '{$url}'; </script>";
      }
  
      function importaCookie(){
        $file = "../../xml/consultas.xml";
        $xml = simplexml_load_file($file) or die("XML não acessado.");
        for($i = 0; $i < $xml->count(); $i++){
          if ($xml->consulta[$i]->id == $_COOKIE['id']){
            setcookie('id',$xml->consulta[$i]->id, time()+600, 'alteraConsultas.php');
            setcookie('paciente',$xml->consulta[$i]->paciente, time()+600, 'alteraConsultas.php');
            setcookie('data',$xml->consulta[$i]->data, time()+600, 'alteraConsultas.php');
            setcookie('lab',$xml->consulta[$i]->lab, time()+600, 'alteraConsultas.php');
            setcookie('diagnostico',$xml->consulta[$i]->diagnostico, time()+600, 'alteraConsultas.php');
            setcookie('exames',$xml->consulta[$i]->exames, time()+600, 'alteraConsultas.php');
            setcookie('resultados',$xml->consulta[$i]->resultados, time()+600, 'alteraConsultas.php');
            redireciona('alteraConsultas.php');
            ini_set( 'error_reporting', E_ALL );
            ini_set( 'display_errors', true );
          }
      }
    }
    importaCookie();

?>