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
        <h1>&bull; Pacientes &bull;</h1>
        <div class="underline">
        </div>
        <form action="/php/paciente.php" method="post" id="contact_form">
          <div class="name">
            <label for="name"></label>
            <input type="text" placeholder="Nome completo" name="name" id="name_input" required>
          </div>
          <div class="email">
            <label for="email"></label>
            <input type="email" placeholder="E-mail" name="email" id="email_input" required>
          </div>
          <div class="age">
            <label for="age"></label>
            <input type="text" placeholder="Idade" name="age" id="age_input" required>
          </div>
          <div class="cpf">
            <label for="cpf"></label>
            <input type="text" placeholder="CPF" name="cpf" id="cpf_input" required>
          </div>
          <div class="telephone">
            <label for="name"></label>
            <input type="text" placeholder="Telefone" name="telephone" id="telephone_input" required>
          </div>
          <div class="adress">
            <label for="adress"></label>
            <input type="text" placeholder="Endereço" name="adress" id="adress_input" required>
          </div>
          <div class="subject">
            <label for="gender"></label>
            <select placeholder="Gênero" name="gender" id="gender_input" required>
              <option disabled hidden selected>Gênero</option>
              <option>Feminino</option>
              <option>Masculino</option>
            </select>
          </div>
          <div class="message">
            <label for="message"></label>
            <textarea name="message" placeholder="Informações adicionais" id="message_input" cols="30" rows="3" required></textarea>
          </div>
          <div class="submit">
            <input type="submit" value="Cadastrar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body>
</html>


