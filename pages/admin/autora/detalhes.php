<?php
session_start();   

require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/sidebar.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/autora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/admin.php');

if (!validaSession()) header('Location: ../login.php');

if (isset($_GET['id'])) {
   $autora = buscarAutoraAction($_GET['id']) ?? header("Location: ./index.php");
}
?>
         <div class="container-fluid">
            <!-- INICIO CONTEUDO -->
            <div class="row" style="overflow-y: auto; height:100vh;">
               <div class="col"> 
                  <h1>Visualizar Autora</h1>
                  <div class="form-group">
                     <label>Nome completo</label>
                     <input readonly value="<?=!empty($autora['nome']) ? htmlspecialchars($autora['nome']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label>Biografia</label>
                     <textarea readonly class="form-control" rows="2"><?=!empty($autora['biografia']) ? stripcslashes($autora['biografia']) : ""?></textarea><br/>
                  </div>
                  <div class="form-group">
                     <label for="imagem">Foto</label>
                     <div>
                        <div class="image-preview">
                           <img id="preview" class="image-preview" src="<?=isset($autora['foto']) ? ("data:image/jpeg;base64," . base64_encode($autora['foto'])) : "/assets/media/misc/semfoto.jpg"?>" alt="" />
                        </div>
                     <div><br/>
                  </div>
                  <div class="form-group">
                     <label>Data de nascimento</label>
                     <input readonly value="<?=!empty($autora['data_nasc']) ? date('d/m/Y', strtotime(htmlspecialchars($autora['data_nasc']))) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label>Data da morte</label>
                     <input readonly value="<?=!empty($autora['data_morte']) ? date('d/m/Y', strtotime(htmlspecialchars($autora['data_morte']))) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label>Instagram</label>
                     <input readonly value="<?=!empty($autora['instagram']) ? htmlspecialchars($autora['instagram']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label>Facebook</label>
                     <input readonly value="<?=!empty($autora['facebook']) ? htmlspecialchars($autora['facebook']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label>Twitter</label>
                     <input readonly value="<?=!empty($autora['twitter']) ? htmlspecialchars($autora['twitter']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label>Website</label>
                     <input readonly value="<?=!empty($autora['site_autora']) ? htmlspecialchars($autora['site_autora']) : ""?>" type="url" class="form-control"><br/>
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
      <script src="/assets/js/image-preview.js"></script>
   </body>
</html>