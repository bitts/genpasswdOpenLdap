<?php
/**
* Create by Marcelo Valvassori Bittencourt
* 1.0v - 13/08/2021 - geração de senha de acesso para openLDAP
* Code Base: http://projects.marsching.org/weave4j/util/genpassword.php.txt
*/

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Marcelo Valvassori BITTENCOURT">

    <title>Gerador de senha padrão openLDAP</title>

    <link rel="1cta" href="#">

    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css" ></script>
    <script>
      function myCopy(element) {
          var copyText = document.getElementById(element);

          copyText.select();
          copyText.setSelectionRange(0, 99999); /* For mobile devices */

          document.execCommand("copy");

          //alert("Copied the text: " + copyText.value);
          var alertList = document.querySelectorAll('.alert')
          alertList.forEach(function (alert) {
            alert.style.display = 'block';
          })
      }
    </script>
  </head>
  <body class="text-center">
    <main class="form-signin">

    <div class="logo" style="width:100px;" ></div>

    <h1 class="h5 mb-3 fw-normal">Geração de Senha no padrão OpenLDAP</h1>

    <?php
    if(!isset($_POST) || empty($_POST['password'])){
    ?>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="password-strength">
      <div class="form-group">
            <div class="form-floating">
                <input type="password" name="password" class="form-control password-strength__input" id="floatingPassword" placeholder="Informe uma Senha segura" aria-describedby="passwordHelp">
                <label for="floatingPassword">Informe uma senha segura</label>
            </div>

        <small class="password-strength__error text-danger js-hidden">Este sÃ­mbolo nÃ£o Ã© permitido!</small>
        <small class="form-text text-muted mt-2" id="passwordHelp">Adicione 9 caracteres ou mais, letras minÃºsculas, letras maiÃºsculas, nÃºmeros e sÃ­mbolos para tornar a senha realmente forte!</small>

        <div class="password-strength__bar-block progress mb-4">
                      <div class="password-strength__bar progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>

            <button class="w-100 btn btn-lg btn-primary password-strength__submit" type="submit" disabled="disabled">Gerar</button>
      </div>
      </form>
<?php
    }else {
      if (isset($_POST['password'])) {
            $salt = "";
            for ($i = 0; $i < 4; $i++) {
                $salt .= chr(mt_rand(0, 255));
            }
            $hash = "{SSHA}" . base64_encode(sha1($_POST['password'] . $salt, TRUE) . $salt);
      }
      echo "<div class='input-group w-250 btn-group' role='group'>
      <span class='input-group-text'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-hash' viewBox='0 0 16 16'>
          <path d='M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z'></path>
        </svg>
      </span>
      <input type='text' class='form-control' value='{$hash}' id='hash' style='margin-right:5px'>
      <span class='input-group-btn'>
          <button name='copy' class='btn btn-primary' onclick='myCopy(\"hash\")'>
          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clipboard' viewBox='0 0 16 16'>
              <path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/>
              <path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/>
          </svg>
        </button>
      </span>
    </div>";

    unset($_POST);
  }
?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none;margin-top:5em;">
          <strong>Copiado!</strong> A Hash gerada foi copiada para a Área de transferência.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </main>

     <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
     <script src='password.js'></script>
  </body>
</html>
