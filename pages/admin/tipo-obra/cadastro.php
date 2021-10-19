<?php
session_start();   

require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/sidebar.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/tipo-obra.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/admin.php');

if (!validaSession()) header('Location: ../login.php');

$actionMessage = $_SESSION['alert']["status"] ?? null;

if (isset($_POST["cadastrar"])) criarTipoAction($_POST);
if (isset($_POST["alterar"])) alterarTipoAction($_POST); 

if (isset($_GET['id'])) {
   $tipo = buscarTipoAction($_GET['id']) ?? header("Location: ".$_SERVER['PHP_SELF']);
   $cod_tipo = $_GET['id'];
}

$editMode = isset($tipo);
?>
         <div class="container-fluid">
            <!-- INICIO CONTEUDO -->
            <div class="row" style="overflow-y: auto; height:100vh;">
               <div class="col">
                  <?php if (isset($actionMessage)) printMessage(); ?>
                  <h1><?=$editMode ? "Editar Tipo de Obra" : "Cadastrar Tipo de Obra"?></h1>
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="<?=$editMode ? "return confirm('Deseja realmente alterar o registro?');" : ""?>">
                     <div class="form-group">
                        <label for="descricao">Descrição*</label>
                        <input value="<?=$editMode ? htmlspecialchars($tipo['descricao']) : ""?>" type="text" class="form-control" name="descricao" maxlength="45" required><br/>
                     </div>
                     <div class="form-group">
<?php if ($editMode): ?>
                        <input type="hidden" name="cod_tipo" id="cod_tipo" value="<?=$cod_tipo?>" />
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
   </body>
</html>