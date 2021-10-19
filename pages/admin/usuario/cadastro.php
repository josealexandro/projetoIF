<?php
session_start();   

require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/sidebar.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/usuario.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/perfil.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/admin.php');

if (!validaSession()) header('Location: ../login.php');

$actionMessage = $_SESSION['alert']["status"] ?? null;

if (isset($_POST["cadastrar"])) criarUsuarioAction($_POST); 
if (isset($_POST["alterar"])) alterarUsuarioAction($_POST);

if (isset($_GET['id'])) {
   $usuario = buscarUsuarioAction($_GET['id']) ?? header("Location: ".$_SERVER['PHP_SELF']);
   $cod_usuario = $_GET['id'];
}

$editMode = isset($usuario);

$perfis = obterPerfisAction();

if (empty($perfis)) {
   $_SESSION['alert'] = [
      'status' => 'warning',
      'message' => 'Verifique se há registros de <b>perfil de usuário</b> disponíveis.'
   ];
   header("Location: ./index.php");
}
?>
         <div class="container-fluid">
            <!-- INICIO CONTEUDO -->
            <div class="row" style="overflow-y: auto; height:100vh;">
               <div class="col">
                  <?php if (isset($actionMessage)) printMessage(); ?>
                  <h1><?=$editMode ? "Editar Usuário" : "Cadastrar Usuário"?></h1>
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" oninput='senha2.setCustomValidity(senha2.value != senha.value ? "Senhas não conferem." : "")' onsubmit="<?=$editMode ? "return confirm('Deseja realmente alterar o registro?');" : ""?>">
                     <div class="form-group">
                        <label for="nome">Nome Completo*</label>
                        <input value="<?=$editMode ? htmlspecialchars($usuario['nome']) : ""?>" type="text" class="form-control" name="nome" maxlength="150" required><br/>
                     </div>
                     <div class="form-group">
                        <label for="email">E-mail*</label>
                        <input value="<?=$editMode ? htmlspecialchars($usuario['email']) : ""?>" type="email" class="form-control" name="email" maxlength="200" required><br/>
                     </div>
                     <div class="form-group">
                        <label for="senha">Senha*</label>
                        <input type="password" class="form-control" name="senha" maxlength="30" required><br/>
                     </div>
                     <div class="form-group">
                        <label for="senha2">Repita a Senha*</label>
                        <input type="password" class="form-control" name="senha2" maxlength="30" required><br/>
                     </div>
                     <div class="form-group">
                        <label for="perfil_usuario">Perfil de Usuário*</label>
                        <select class="form-select" name="perfil_usuario" id="perfil_usuario" required>
                        <option value="" hidden>Selecione um perfil...</option>
<?php foreach($perfis as $index => $row): ?>
                           <option value="<?=htmlspecialchars($row['cod_perfil'])?>"<?=($editMode && htmlspecialchars($row['cod_perfil']) === htmlspecialchars($usuario['perfil_usuario'])) ? "selected" : ""?>><?=htmlspecialchars($row['descricao'])?></option>
<?php endforeach; ?>
                        </select><br/>
                     </div>
                     <div class="form-group">
<?php if ($editMode): ?>
                        <input type="hidden" name="cod_usuario" id="cod_usuario" value="<?=$cod_usuario?>" />
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