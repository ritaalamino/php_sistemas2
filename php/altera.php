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
              setcookie('id',$xml->medico[$i]->id, time()+600, '/pages/medico/alteraMedicos.php');
              setcookie('nome',$xml->medico[$i]->nome, time()+600, '/pages/medico/alteraMedicos.php');
              setcookie('email',$xml->medico[$i]->email, time()+600, '/pages/medico/alteraMedicos.php');
              setcookie('idade',$xml->medico[$i]->idade, time()+600, '/pages/medico/alteraMedicos.php');
              setcookie('telefone',$xml->medico[$i]->telefone, time()+600, '/pages/medico/alteraMedicos.php');
              setcookie('crm',$xml->medico[$i]->crm, time()+600, '/pages/medico/alteraMedicos.php');
              setcookie('endereco',$xml->medico[$i]->endereco, time()+600, '/pages/medico/alteraMedicos.php');
              setcookie('especialidade',$xml->medico[$i]->especialidade, time()+600, '/pages/medico/alteraMedicos.php');
              setcookie('genero',$xml->medico[$i]->genero, time()+600, '/pages/medico/alteraMedicos.php');
              setcookie('infos',$xml->medico[$i]->infos, time()+600, '/pages/medico/alteraMedicos.php');
              redireciona('../pages/medico/alteraMedicos.php');
              //ini_set( 'error_reporting', E_ALL );
              //ini_set( 'display_errors', true );
            }
          }
      }

      function importaConsultas(){
        $file = "../xml/consultas.xml";
          $xml = simplexml_load_file($file) or die("XML não acessado.");
          for($i = 0; $i < $xml->count(); $i++){
            if ($xml->consulta[$i]->id == $_COOKIE['id']){
              setcookie('id',$xml->consulta[$i]->id, time()+600, '/pages/medico/alteraConsultas.php');
              setcookie('paciente',$xml->consulta[$i]->paciente, time()+600, '/pages/medico/alteraConsultas.php');
              setcookie('data',$xml->consulta[$i]->data, time()+600, '/pages/medico/alteraConsultas.php');
              setcookie('lab',$xml->consulta[$i]->lab, time()+600, '/pages/medico/alteraConsultas.php');
              setcookie('diagnostico',$xml->consulta[$i]->diagnostico, time()+600, '/pages/medico/alteraConsultas.php');
              setcookie('exames',$xml->consulta[$i]->exames, time()+600, '/pages/medico/alteraConsultas.php');
              setcookie('resultados',$xml->consulta[$i]->resultados, time()+600, '/pages/medico/alteraConsultas.php');
              redireciona('../pages/medico/alteraConsultas.php');
              ini_set( 'error_reporting', E_ALL );
              ini_set( 'display_errors', true );
          }
        }
      }

      function importaExame(){
        $file = "../xml/exames.xml";
          $xml = simplexml_load_file($file) or die("XML não acessado.");
          for($i = 0; $i < $xml->count(); $i++){
            if ($xml->exame[$i]->id == $_COOKIE['id']){
              alerta('teste');
              setcookie('id',$xml->exame[$i]->id, time()+600, '/pages/laboratorio/alteraExames.php');
              setcookie('data',$xml->exame[$i]->data, time()+600, '/pages/laboratorio/alteraExames.php');
              setcookie('medico',$xml->exame[$i]->medico, time()+600, '/pages/laboratorio/alteraExames.php');
              setcookie('paciente',$xml->exame[$i]->paciente, time()+600, '/pages/laboratorio/alteraExames.php');
              setcookie('email',$xml->exame[$i]->email, time()+600, '/pages/laboratorio/alteraExames.php');
              setcookie('diagnostico',$xml->exame[$i]->diagnostico, time()+600, '/pages/laboratorio/alteraExames.php');
              setcookie('receita',$xml->exame[$i]->receita, time()+600, '/pages/laboratorio/alteraExames.php');
              setcookie('exames',$xml->exame[$i]->exames, time()+600, '/pages/laboratorio/alteraExames.php');
              setcookie('infos',$xml->exame[$i]->infos, time()+600, '/pages/laboratorio/alteraExames.php');
              redireciona('../pages/laboratorio/alteraExames.php');
              ini_set( 'error_reporting', E_ALL );
              ini_set( 'display_errors', true );
          }
        }
      }

        
    function importaPaciente(){
      $file = "../xml/pacientes.xml";
          $xml = simplexml_load_file($file) or die("XML não acessado.");
          for($i = 0; $i < $xml->count(); $i++){
            if ($xml->paciente[$i]->id == $_COOKIE['id']){
              setcookie('id',$xml->paciente[$i]->id, time()+600, '/pages/paciente/alteraPaciente.php');
              setcookie('nome',$xml->paciente[$i]->nome, time()+600, '/pages/paciente/alteraPaciente.php');
              setcookie('email',$xml->paciente[$i]->email, time()+600, '/pages/paciente/alteraPaciente.php');
              setcookie('idade',$xml->paciente[$i]->idade, time()+600, '/pages/paciente/alteraPaciente.php');
              setcookie('telefone',$xml->paciente[$i]->telefone, time()+600, '/pages/paciente/alteraPaciente.php');
              setcookie('cpf',$xml->paciente[$i]->cpf, time()+600, '/pages/paciente/alteraPaciente.php');
              setcookie('endereco',$xml->paciente[$i]->endereco, time()+600, '/pages/paciente/alteraPaciente.php');
              setcookie('especialidade',$xml->paciente[$i]->especialidade, time()+600, '/pages/paciente/alteraPaciente.php');
              setcookie('genero',$xml->paciente[$i]->genero, time()+600, '/pages/paciente/alteraPaciente.php');
              setcookie('infos',$xml->paciente[$i]->infos, time()+600, '/pages/paciente/alteraPaciente.php');
              redireciona('../pages/paciente/alteraPaciente.php');
              //ini_set( 'error_reporting', E_ALL );
              //ini_set( 'display_errors', true );
            }
          }
    }

        
    function importaLab(){
      $file = "../xml/labs.xml";
          $xml = simplexml_load_file($file) or die("XML não acessado.");
          for($i = 0; $i < $xml->count(); $i++){
            if ($xml->lab[$i]->id == $_COOKIE['id']){
              setcookie('id',$xml->lab[$i]->id, time()+600, '/pages/laboratorio/alteraLaboratorio.php');
              setcookie('nome',$xml->lab[$i]->nome, time()+600, '/pages/laboratorio/alteraLaboratorio.php');
              setcookie('email',$xml->lab[$i]->email, time()+600, '/pages/laboratorio/alteraLaboratorio.php');
              setcookie('telefone',$xml->lab[$i]->telefone, time()+600, '/pages/laboratorio/alteraLaboratorio.php');
              setcookie('cnpj',$xml->lab[$i]->cnpj, time()+600, '/pages/laboratorio/alteraLaboratorio.php');
              setcookie('endereco',$xml->lab[$i]->endereco, time()+600, '/pages/laboratorio/alteraLaboratorio.php');
              setcookie('tipoExame',$xml->lab[$i]->tipoExame, time()+600, '/pages/laboratorio/alteraLaboratorio.php');
              setcookie('infos',$xml->lab[$i]->infos, time()+600, '/pages/laboratorio/alteraLaboratorio.php');
              redireciona('../pages/laboratorio/alteraLaboratorio.php');
              //ini_set( 'error_reporting', E_ALL );
              //ini_set( 'display_errors', true );
            }
          }
    }
      
      

      function importaCookie($cookie){
      switch($cookie){
        case 'exame':
          importaExame();
          break;
        case 'consulta':
          importaConsultas();
          break;
        case 'medico':
          importaMedico();
          break;
        case 'paciente':
          importaPaciente();
          break;
        case 'lab':
          importaLab();
          break;
    }
  } 
    
    importaCookie($_COOKIE['tipo']);

?>