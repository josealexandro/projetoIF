<?php
session_start();   

require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/sidebar.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/usuario.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/perfil.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/admin.php');

if (!validaSession()) header('Location: ../login.php');

if (isset($_GET['id'])) {
   $usuario = buscarUsuarioAction($_GET['id']) ?? header("Location: ./index.php");
}

$perfil = isset($usuario) ? buscarPerfilAction($usuario['perfil_usuario']) : null;
?>
         <div class="container-fluid">
            <!-- INICIO CONTEUDO -->
            <div class="row" style="overflow-y: auto; height:100vh;">
               <div class="col"> 
                  <h1>Visualizar Usuário</h1>
                  <div class="form-group">
                     <label>Nome Completo</label>
                     <input readonly value="<?=!empty($usuario['nome']) ? htmlspecialchars($usuario['nome']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label>E-mail</label>
                     <input readonly value="<?=!empty($usuario['email']) ? htmlspecialchars($usuario['email']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label>Senha</label>
                     <input readonly value="********" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label for="perfil_usuario">Perfil de Usuário</label>
                     <input readonly value="<?=!empty($usuario['perfil_usuario']) ? htmlspecialchars($perfil['descricao']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <a href='./index.php' class='btn btn-success'>Voltar</a>
                  <a href='./cadastro.php?id=<?=$_GET['id']?>' class='btn btn-success'>Editar</a>
               </div>
            </div>  
            <!-- FIM CONTEUDO-->
         </div>
      </main>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.1/umd/popper.min.js" integrity="sha512-8jeQKzUKh/0pqnK24AfqZYxlQ8JdQjl9gGONwGwKbJiEaAPkD3eoIjz3IuX4IrP+dnxkchGUeWdXLazLHin+UQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="/assets/js/sidebars.js"></script>
   </body>
</html>