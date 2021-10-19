<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/sidebar.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/obra.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/autora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/usuario.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/admin.php');

if (!validaSession()) header('Location: ./login.php');

$autoras = obterAutorasAction();
$obras = obterObrasAction();
$usuarios = obterUsuariosAction();
?>
         <div class="container-fluid">
            <!-- INICIO CONTEUDO -->
            <div class="row" style="overflow-y: auto; height:100vh;">
               <div class="col"> 
                  <h1>Dashboard</h1>
                  <div class="row">
                     <div class="col">
                        <div class="card" style="width: 18rem;">
                           <div class="card-body">
                              <h2 class="card-title"><?=count($autoras)?></h2>
                              <h6 class="card-subtitle mb-2 text-muted">Autoras</h6>
                              <a href="./autora/index.php" class="card-link">Acessar</a>
                           </div>
                        </div>
                     </div>
                     <div class="col">
                        <div class="card  " style="width: 18rem;">
                           <div class="card-body">
                              <h2 class="card-title"><?=count($obras)?></h2>
                              <h6 class="card-subtitle mb-2 text-muted text-white">Obras</h6>
                              <a href="./obra/index.php" class="card-link">Acessar</a>
                           </div>
                        </div>
                     </div>
                     <div class="col">
                        <div class="card" style="width: 18rem;">
                           <div class="card-body">
                              <h2 class="card-title"><?=count($usuarios)?></h2>
                              <h6 class="card-subtitle mb-2 text-muted">Usuários</h6>
                              <a href="./usuario/index" class="card-link">Acessar</a>
                           </div>
                        </div>
                     </div>
                  </div>
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