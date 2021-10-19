<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/sidebar.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/editora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/admin.php');

if (!validaSession()) header('Location: ../login.php');

$actionMessage = $_SESSION['alert']["status"] ?? null;

if (isset($_POST["cadastrar"])) criarEditoraAction($_POST); 
if (isset($_POST["alterar"])) alterarEditoraAction($_POST);

if (isset($_GET['id'])) {
   $editora = buscarEditoraAction($_GET['id']) ?? header("Location: ".$_SERVER['PHP_SELF']);
   $cod_editora = $_GET['id'];
}

$editMode = isset($editora);
?>
         <div class="container-fluid">
            <!-- INICIO CONTEUDO -->
            <div class="row" style="overflow-y: auto; height:100vh;">
               <div class="col">
                  <?php if (isset($actionMessage)) printMessage(); ?>
                  <h1><?=$editMode ? "Editar Editora" : "Cadastrar Editora"?></h1>
                  <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" onsubmit="<?=$editMode ? "return confirm('Deseja realmente alterar o registro?');" : ""?>">
                     <div class="form-group">
                        <label for="nome">Nome editora*</label>
                        <input value="<?=$editMode ? htmlspecialchars($editora['nome']) : ""?>" type="text" class="form-control" name="nome" maxlength="100" required><br/>
                     </div>
                     <div class="form-group">
                        <label for="estado">Estado*</label>
                        <select class="form-select" name="estado" id="estado" onchange="popular_cidades(this.value);" required>
                        </select><br/>
                     </div>
                     <div class="form-group">
                        <label for="cidade">Cidade*</label>
                        <select class="form-select" name="cidade" id="cidade" required>
                        </select><br/>
                     </div>
                     <div class="form-group">
                        <label for="site_editora">Website</label>
                        <input value="<?=$editMode ? htmlspecialchars($editora['site_editora']) : ""?>" type="url" class="form-control" name="site_editora" maxlength="100"><br/>
                     </div>
                     <div class="form-group">
<?php if ($editMode): ?>
                        <input type="hidden" name="cod_editora" id="cod_editora" value="<?=$cod_editora?>" />
                        <input type="hidden" id="estado_edit" value="<?=htmlspecialchars($editora['estado'])?>" />
                        <input type="hidden" id="cidade_edit" value="<?=htmlspecialchars($editora['cidade'])?>" />
<?php endif; ?>
                        <a href='./index.php' class='btn btn-success'>Voltar</a>
                        <input type="submit" class="btn btn-success" name="<?=$editMode ? "alterar" : "cadastrar"?>" value="<?=$editMode ? "Salvar alterações" : "Cadastrar"?>">
                     </div>
                  </form>
               </div>
            </div>  
            <!-- FIM CONTEUDO-->
         </div>
      </main>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.1/umd/popper.min.js" integrity="sha512-8jeQKzUKh/0pqnK24AfqZYxlQ8JdQjl9gGONwGwKbJiEaAPkD3eoIjz3IuX4IrP+dnxkchGUeWdXLazLHin+UQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="/assets/js/sidebars.js"></script>
      <script src="/assets/js/estados.js"></script>
      <script src="/assets/js/cidades.js"></script>
   </body>
</html>