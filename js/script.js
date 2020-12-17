
//function agoraVai(){
  $(document).ready(function () {
  $("form").submit(function (event){
    event.preventDefault()

    var nome = document.getElementById("nome").value
    var email = document.getElementById("email").value
    var senha = document.getElementById("senha").value
    var cnpj = document.getElementById("cnpj").value
    var telefone = document.getElementById("telefone").value
    var endereco = document.getElementById("endereco").value
    var tipoExame = document.getElementById("tipoExame").value
    var infos = document.getElementById("infos").value
    var tudoOk=false;

    if(email.indexOf('@')==-1 || email.indexOf('.')==-1){
      document.getElementById("demo").innerHTML = "Formato de e-mail inválido!";
    }else{
      tudoOk=true;
    }

    if(tudoOk){
      //window.alert("Entro no else!");
      $.post("laboratorio.php", {nome:nome,
                                email:email,
                                senha:senha,
                                cnpj:cnpj,
                                telefone:telefone,
                                endereco:endereco,
                                tipoExame:tipoExame,
                                infos:infos,
                                tudoOk:tudoOk
      })
      
    }
    $(location).attr('href', $('http://www.devmedia.com.br').val())

    
  })
})
  //}
  /*function erros(){
    var errEmail = "<?php echo $emailErr; ?>";
    if(errEmail){
      
      //window.alert("Entro no if!");
    }
    submit.preventDefault();
  }*/