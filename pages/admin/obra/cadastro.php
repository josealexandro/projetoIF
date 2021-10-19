<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/sidebar.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/obra.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/autora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/tipo-obra.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/editora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/admin.php');

if (!validaSession()) header('Location: ../login.php');

$actionMessage = $_SESSION['alert']["status"] ?? null;

if (isset($_POST["cadastrar"])) criarObraAction($_POST);
if (isset($_POST["alterar"])) alterarObraAction($_POST);

if (isset($_GET['id'])) {
   $obra = buscarObraAction($_GET['id']) ?? header("Location: ".$_SERVER['PHP_SELF']);
   $cod_obra = $_GET['id'];
}

$editMode = isset($obra);

$autoras = obterAutorasAction();
$tipos = obterTiposAction();
$editoras = obterEditorasAction();

if (empty($autoras) || empty($tipos) || empty($editoras)) {
   $_SESSION['alert'] = [
      'status' => 'warning',
      'message' => 'Verifique se há registros de <b>autora</b>, <b>tipo de obra</b> e <b>editora</b> disponíveis.'
   ];
	header("Location: ./index.php");
}
?>
         <div class="container-fluid">
            <!-- INICIO CONTEUDO -->
            <div class="row" style="overflow-y: auto; height:100vh;">
               <div class="col">
                  <?php if (isset($actionMessage)) printMessage(); ?>
                  <h1><?=$editMode ? "Editar Obra" : "Cadastrar Obra"?></h1>
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="POST" onsubmit="<?=$editMode ? "return confirm('Deseja realmente alterar o registro?');" : ""?>">
                     <div class="form-group">
                        <label for="titulo">Título*</label>
                        <input value="<?=$editMode ? htmlspecialchars($obra['titulo']) : ""?>" type="text" class="form-control" name="titulo" maxlength="200" required><br/>
                     </div>
                     <div class="form-group">
                        <label for="resumo">Resumo*</label>
                        <textarea class="form-control" name="resumo" rows="2" required><?=$editMode ? stripcslashes($obra['resumo']) : ""?></textarea><br/>
                     </div>
                     <div class="form-group">
                        <label for="ano">Ano*</label>
                        <input value="<?=$editMode ? htmlspecialchars($obra['ano']) : ""?>" type="text" class="form-control datepicker-year" name="ano" maxlength="4" required><br/>
                     </div>
                     <div class="form-group">
                        <label for="imagem">Capa (máx. 2MB)</label>
                        <div>
                           <div class="image-preview">
                              <img id="preview" class="image-preview" onerror="this.src='/assets/media/misc/semfoto.jpg'" src="<?=$editMode ? "data:image/jpeg;base64," . base64_encode($obra['capa']) : ""?>" alt="" />
                           </div>
                        </div>
                        <div class="input-group mt-2">
                           <input type="file" class="form-control" style="display:none;" name="capa" id="imagem" accept=".jpg,.jpeg,.png,.bmp,.gif">
                           <div class="btn-group">
                              <button id="btn_adicionar" class="btn btn-outline-secondary" type="button">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-fill" viewBox="0 0 16 16">
                                    <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                                 </svg>
                                 <span class="visually-hidden">Button</span>
                              </button>
                              <button id="btn_deletar" class="btn btn-outline-secondary" type="button">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser-fill" viewBox="0 0 16 16">
                                    <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm.66 11.34L3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z"/>
                                 </svg>
                                 <span class="visually-hidden">Button</span>
                              </button>
                           </div>
                        </div><br/>
                     </div>
                     <div class="form-group">
                        <label for="url">Link</label>
                        <input value="<?=$editMode ? htmlspecialchars($obra['url']) : ""?>" type="url" class="form-control" name="url" maxlength="200"><br/>
                     </div>
                     <div class="form-group">
                        <label for="autora_obra">Autora*</label>
                        <select class="form-select" name="autora_obra" id="autora_obra" required>
                           <option value="" hidden>Selecione uma autora...</option>
<?php foreach($autoras as $row): ?>
                           <option value="<?=htmlspecialchars($row['cod_autora'])?>"<?=($editMode && htmlspecialchars($row['cod_autora']) === htmlspecialchars($obra['autora_obra'])) ? "selected" : ""?>><?=htmlspecialchars($row['nome'])?></option>
<?php endforeach; ?>
                        </select><br/>
                     </div>
                     <div class="form-group">
                        <label for="tipo_obra">Tipo de Obra*</label>
                        <select class="form-select" name="tipo_obra" id="tipo_obra" required>
                           <option value="" hidden>Selecione um tipo de obra...</option>
<?php foreach($tipos as $row): ?>
                           <option value="<?=htmlspecialchars($row['cod_tipo'])?>"<?=($editMode && htmlspecialchars($row['cod_tipo']) === htmlspecialchars($obra['tipo_obra'])) ? "selected" : ""?>><?=htmlspecialchars($row['descricao'])?></option>
<?php endforeach; ?>
                        </select><br/>
                     </div>
                     <div class="form-group">
                        <label for="editora_obra">Editora*</label>
                        <select class="form-select" name="editora_obra" id="editora_obra" required>
                           <option value="" hidden>Selecione uma editora...</option>
<?php foreach($editoras as $row): ?>
                           <option value="<?=htmlspecialchars($row['cod_editora'])?>"<?=($editMode && htmlspecialchars($row['cod_editora']) === htmlspecialchars($obra['editora_obra'])) ? "selected" : ""?>><?=htmlspecialchars($row['nome'])?></option>
<?php endforeach; ?>
                        </select><br/>
                     </div>
                     <div class="form-group">
<?php if ($editMode): ?>
                        <input type="hidden" name="cod_obra" id="cod_obra" value="<?=$cod_obra?>" />
                        <input type="hidden" name="update_capa" id="update_imagem" value="0" />
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="/assets/js/sidebars.js"></script>
      <script src="/assets/js/image-preview.js"></script>
      <script src="/assets/js/datepicker.js"></script>
   </body>
</html>