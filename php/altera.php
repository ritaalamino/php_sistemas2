<?php
    function alerta($texto){
        echo "<script>alert('${texto}');</script>";
      }
      
    function redireciona($url){
      echo "<script> window.location.href = '{$url}'; </script>";
    }
  
    function importaMedico(){
      $file = "../xml/medicos.xml";
          $xml = simplexml_load_file($file) or die("XML não acessado.");
          for($i = 0; $i < $xml->count(); $i++){
            if ($xml->medico[$i]->id == $_COOKIE['id']){
              setcookie('id',$xml->medico[$i]->id, time()+600, '../pages/medico/alteraMedicos.php');
              setcookie('nome',$xml->medico[$i]->nome, time()+600, '../pages/medico/alteraMedicos.php');
              setcookie('email',$xml->medico[$i]->email, time()+600, '../pages/medico/alteraMedicos.php');
              setcookie('idade',$xml->medico[$i]->idade, time()+600, '../pages/medico/alteraMedicos.php');
              setcookie('telefone',$xml->medico[$i]->telefone, time()+600, '../pages/medico/alteraMedicos.php');
              setcookie('crm',$xml->medico[$i]->crm, time()+600, '../pages/medico/alteraMedicos.php');
              setcookie('endereco',$xml->medico[$i]->endereco, time()+600, '../pages/medico/alteraMedicos.php');
              setcookie('especialidade',$xml->medico[$i]->especialidade, time()+600, '../pages/medico/alteraMedicos.php');
              setcookie('genero',$xml->medico[$i]->genero, time()+600, '../pages/medico/alteraMedicos.php');
              setcookie('infos',$xml->medico[$i]->infos, time()+600, '../pages/medico/alteraMedicos.php');
              redireciona('../pages/medico/alteraMedicos.php');
              //ini_set( 'error_reporting', E_ALL );
              //ini_set( 'display_errors', true );
            }
          }
      }

    function importaCookie($cookie){
      switch ($cookie){
        case 'consulta':
          $file = "../xml/consultas.xml";
          $xml = simplexml_load_file($file) or die("XML não acessado.");
          for($i = 0; $i < $xml->count(); $i++){
            if ($xml->consulta[$i]->id == $_COOKIE['id']){
              setcookie('id',$xml->consulta[$i]->id, time()+600, '../pages/medico/alteraConsultas.php');
              setcookie('paciente',$xml->consulta[$i]->paciente, time()+600, '../pages/medico/alteraConsultas.php');
              setcookie('data',$xml->consulta[$i]->data, time()+600, '../pages/medico/alteraConsultas.php');
              setcookie('lab',$xml->consulta[$i]->lab, time()+600, '../pages/medico/alteraConsultas.php');
              setcookie('diagnostico',$xml->consulta[$i]->diagnostico, time()+600, '../pages/medico/alteraConsultas.php');
              setcookie('exames',$xml->consulta[$i]->exames, time()+600, '../pages/medico/alteraConsultas.php');
              setcookie('resultados',$xml->consulta[$i]->resultados, time()+600, '../pages/medico/alteraConsultas.php');
              redireciona('../pages/medico/alteraConsultas.php');
              ini_set( 'error_reporting', E_ALL );
              ini_set( 'display_errors', true );
          }
        }
        break;
      case 'medico':
        importaMedico();
        break;
    }
  } 
    
    importaCookie($_COOKIE['tipo']);

?>