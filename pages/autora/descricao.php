<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/autora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/header.php');

if (isset($_GET['id'])) {
   $autora = buscarAutoraAction($_GET['id']);
   if (!isset($autora)){
      header("Location: /");
   }
} else {
   header("Location: /");
}
?>
      <div style="height: 50px" >
      </div>
      <div class="container">
         <div class="row">
         
            <div class="col-sm-3">
               <h5 style=" padding-bottom: 2px; " class=""><?=htmlspecialchars($autora['nome'])?></h5>
               <div style="background-color: #e9e9e9;" class="card" style="width: 15rem; ">
                  
                  <img src="data:image/jpeg;base64,<?php echo base64_encode($autora['foto']); ?>" class="card-img-top" alt="..." />
                  <div class="card-body">
                     <tr>Data de nascimento: 
                        <td><?=!empty($autora['data_nasc']) ? date('d/m/Y', strtotime(htmlspecialchars($autora['data_nasc']))) : "-"?></td>
                     </tr><br>
                     <tr>Data da morte: <br>
                        <td><?=!empty($autora['data_morte']) ? date('d/m/Y', strtotime(htmlspecialchars($autora['data_morte']))) : "-"?></td>
                     </tr>
                     <a href="/pages/obra/listar.php?id=<?=$_GET['id']?>" class="btn btn-dark mx-auto d-block">Ver mais</a>
                  </div>
               </div>
               <br>
               <a class="btn btn-primary" style="background-color: #ac2bac;" href="<?=htmlspecialchars($autora['instagram']) ?: "#"?>">
                  <i class="fab fa-instagram"></i>
               </a>
               <a class="btn btn-primary" style="background-color: #3b5998;" href="<?=htmlspecialchars($autora['facebook']) ?: "#"?>">
                  <i class="fab fa-facebook-f"></i>
               </a>
               <a class="btn btn-primary" style="background-color: #55acee;" href="<?=htmlspecialchars($autora['twitter']) ?: "#"?>">
                  <i class="fab fa-twitter"></i>
               </a>
               <a class="btn btn-primary" style="background-color: #55acee;" href="<?=htmlspecialchars($autora['site_autora']) ?: "#"?>">
                  Site
               </a>
            </div>
            <div class="col-8">
               <p class="descri"><?=nl2br(stripcslashes($autora['biografia']))?></p>
            </div>
            <div class="fb-comments" data-href="<?=(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?id=" . $_GET['id']?>" data-width="100%" data-numposts="5">
            </div>
         </div>
      </div>
      <br>
      <br>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/footer.php'); ?>