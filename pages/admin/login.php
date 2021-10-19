<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/admin.php');

(isset($_POST['logout']) || !validaSession()) ? logoutAction() : header('Location: ./index.php');

$loginResponse = (isset($_POST['email']) && isset($_POST['email'])) ? loginAction($_POST['email'], $_POST['senha']) : null;
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Login Template</title>
      <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="/assets/css/login.css">
   </head>
   <body>
      <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
         <div class="container">
            <div class="card login-card">
               <div class="row no-gutters">
                  <div class="col-md-5">
                     <img src="/assets/media/logos/ifsertao.png"  alt="login" class="login-card-img">
                  </div>
                  <div class="col-md-7">
                     <div class="card-body">
                        <div class="brand-wrapper">
                           <img src="/assets/media/logos/login.png" alt="logo" class="logo">
                        </div>
                        <p class="login-card-description">Entre na sua conta</p>
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                           <div class="form-group">
                              <label for="email" class="sr-only">Email</label>
                              <input value="<?=$_POST['email'] ?? ""?>" type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                           </div>
                           <div class="form-group mb-4">
                              <label for="password" class="sr-only">Senha</label>
                              <input value="<?=$_POST['senha'] ?? ""?>"type="password" name="senha" id="senha" class="form-control" placeholder="***********" required>
                           </div>
                           <button type="submit" class="btn btn-block login-btn mb-4" <?=$loginResponse ? "disabled" : ""?>>Entrar</button>
                        </form>
                        <div style="height: 16px;">
<?php if ($loginResponse === false): ?>
                           <div class="alert alert-danger alert-dismissable mb-3">
                              Dados inválidos, tente novamente.
                           </div>
<?php endif; ?>
<?php if ($loginResponse === true): ?>
                           <div class="alert alert-primary alert-dismissable mb-3">
                              Olá, <b><?=strtok($_SESSION['current_session']['name'], " ")?></b>! Seja bem-vindo.
                           </div>
                           <script>setTimeout("location.href = './index.php';",1500);</script>
<?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.1/umd/popper.min.js" integrity="sha512-8jeQKzUKh/0pqnK24AfqZYxlQ8JdQjl9gGONwGwKbJiEaAPkD3eoIjz3IuX4IrP+dnxkchGUeWdXLazLHin+UQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </body>
</html>