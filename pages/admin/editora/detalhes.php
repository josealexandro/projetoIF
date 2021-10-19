<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/sidebar.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/editora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/admin.php');

if (!validaSession()) header('Location: ../login.php');

if (isset($_GET['id'])) {
   $editora = buscarEditoraAction($_GET['id']) ?? header("Location: ./index.php");
}
?>
         <div class="container-fluid">
            <!-- INICIO CONTEUDO -->
            <div class="row" style="overflow-y: auto; height:100vh;">
               <div class="col"> 
                  <h1>Visualizar Editora</h1>
                  <div class="form-group">
                     <label for="nome">Nome editora</label>
                     <input readonly value="<?=!empty($editora['nome']) ? htmlspecialchars($editora['nome']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label for="estado">Estado</label>
                     <input readonly value="<?=!empty($editora['estado']) ? htmlspecialchars($editora['estado']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label for="cidade">Cidade</label>
                     <input readonly value="<?=!empty($editora['cidade']) ? htmlspecialchars($editora['cidade']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label for="site_editora">Website</label>
                     <input readonly value="<?=!empty($editora['site_editora']) ? htmlspecialchars($editora['site_editora']) : ""?>" type="text" class="form-control"><br/>
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