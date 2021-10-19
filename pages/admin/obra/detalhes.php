<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/sidebar.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/obra.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/autora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/tipo-obra.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/editora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/admin.php');

if (!validaSession()) header('Location: ../login.php');

if (isset($_GET['id'])) {
   $obra = buscarObraAction($_GET['id']) ?? header("Location: ./index.php");
}

$autora = isset($obra) ? buscarAutoraAction($obra['autora_obra']) : null;
$tipo = isset($obra) ? buscarTipoAction($obra['tipo_obra']) : null;
$editora = isset($obra) ? buscarEditoraAction($obra['editora_obra']) : null;
?>
         <div class="container-fluid">
            <!-- INICIO CONTEUDO -->
            <div class="row" style="overflow-y: auto; height:100vh;">
               <div class="col"> 
                  <h1>Visualizar Obra</h1>
                  <div class="form-group">
                     <label>Título</label>
                     <input readonly value="<?=!empty($obra['titulo']) ? htmlspecialchars($obra['titulo']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label>Resumo</label>
                     <textarea readonly class="form-control" rows="2"><?=!empty($obra['resumo']) ? stripcslashes($obra['resumo']) : ""?></textarea><br/>
                  </div>
                  <div class="form-group">
                     <label>Ano</label>
                     <input readonly value="<?=!empty($obra['ano']) ? htmlspecialchars($obra['ano']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label for="imagem">Foto</label>
                     <div>
                        <div class="image-preview">
                           <img id="preview" class="image-preview" src="<?=isset($obra['capa']) ? ("data:image/jpeg;base64," . base64_encode($obra['capa'])) : "/assets/media/misc/semfoto.jpg"?>" alt="" />
                        </div>
                     <div><br/>
                  </div>                
                  <div class="form-group">
                     <label>Link</label>
                     <input readonly value="<?=!empty($obra['url']) ? htmlspecialchars($obra['url']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label>Autora</label>
                     <input readonly value="<?=!empty($obra['autora_obra']) ? htmlspecialchars($autora['nome']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label for="tipo_obra">Tipo de Obra</label>
                     <input readonly value="<?=!empty($obra['tipo_obra']) ? htmlspecialchars($tipo['descricao']) : ""?>" type="text" class="form-control"><br/>
                  </div>
                  <div class="form-group">
                     <label for="editora_obra">Editora</label>
                     <input readonly value="<?=!empty($obra['editora_obra']) ? htmlspecialchars($editora['nome']) : ""?>" type="text" class="form-control"><br/>
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