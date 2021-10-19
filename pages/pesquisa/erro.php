<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/header.php');
?>
<div class="container" >
   <div class="conteudo">
      <h1 class="titulo">Resultado da pesquisa</h1>
      <br>
      <div class="carde card mx-auto" >
         <div class="card-body text-center">
            <h3 class="msg-result" >Não encontramos resultados para sua pesquisa...</h3>
         </div>
         <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button">
            <i class="fa-solid fa-face-awesome"></i>
         </a>
      </div>
      <br><br>
      <a href='/index.php' class='back btn btn-lg'>Voltar</a>
   </div>
</div>   
<br>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/footer.php'); ?>