function validateform(){  
    var name=document.pacienteform.nome.value;  
    var password=document.pacienteform.senha.value;  
      
    if (name==null || name==""){  
      alert("Nome não pode ser vazio");  
      return false;  
    }else if(password.length<6){  
      alert("A senha deve ter no mínimo 6 caracteres.");  
      return false;  
      }  
    }  