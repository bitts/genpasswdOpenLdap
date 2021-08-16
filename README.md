# genpasswdOpenLdap
Página simples para geração de senha para utiliação do openLDAP

Algoritimo de geração da senha

```
  $password = $_POST['password'];
  $salt = "";
  for ($i = 0; $i < 4; $i++) {
      $salt .= chr(mt_rand(0, 255));
  }
  $cryptedPassword = "{SSHA}" . base64_encode(sha1($password . $salt, TRUE) . $salt);
```
