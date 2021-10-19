<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/obra.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/autora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/tipo-obra.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/editora.php');

if (isset($_GET['id'])) {
   $obra = buscarObraAction($_GET['id']);
   if (!isset($obra)){
      header("Location: /");
   }
   $autora = buscarAutoraDb($obra['autora_obra']);
   $tipo = buscarTipoDb($obra['tipo_obra']);
   $editora = buscarEditoraDb($obra['editora_obra']);
} else {
   header("Location: /");
}
?>
      <div style="height: 50px;" >
      </div>
      <div class="container">
         <div class="row">
            <h3 class="col-12" style="color: #000;"><?=htmlspecialchars($obra['titulo'])?></h3>
            <div class="col-4">
               <div class="col-sm-3 ">
                  <div class="card" style="width: 15rem; ">
                     <img src="data:image/jpeg;base64,<?php echo base64_encode($obra['capa']); ?>" class="card-img-top" alt="..." />
                     <div class="card-body">
                        
                     </div>
                  </div>
		         </div><br>
               <table style="color: #fff;" id="t01">
                  <tr>
                     <th>Autoria:</th>
                     <td><?=htmlspecialchars($autora['nome'])?></td>
                  </tr>
                  <tr>
                     <th>Editora:</th>
                     <td><?=htmlspecialchars($editora['nome'])?></td>
                  </tr>
                  <tr>
                     <th>Categoria:</th>
                     <td><?=htmlspecialchars($tipo['descricao'])?></td>
                  </tr>
                  <tr>
                     <th>Ano da obra:</th>
                     <td><?=htmlspecialchars($obra['ano'])?></td>
                  </tr>              
               </table>
            </div>		
            <div class="col-8">
               <p  class="descri"><?=nl2br(stripcslashes($obra['resumo']))?></p>
            </div>
            <div class="fb-comments" data-href="<?=(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?id=" . $_GET['id']?>" data-width="100%" data-numposts="5"></div>
         </div>
      </div>
      <br><br>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/footer.php'); ?>