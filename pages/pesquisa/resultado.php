<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/autora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/obra.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/header.php');

if (isset($_POST["pesquisar"])) {
   $autoras = buscarAutoraNomeAction($_POST["pesquisa"]);
   $obras = buscarObraTituloAction($_POST["pesquisa"]);
   
   if (empty($autoras) && empty($obras)) header("Location: ./erro.php");
}
?>
<br>
<div class="container">
   <div class="row ">
<?php foreach($autoras as $index => $row): ?>
      <div class="xs-3 col-sm-12 col-md-12 col-lg-4 col-xl-4">
         <div class="card mb-4 " style="width: 20rem; ">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['foto']); ?>" class="card-img-top" alt="..." />
            <div class="card-body">
               <h5 class="card-title"><?=htmlspecialchars($row['nome'])?></h5>
               <p class="card-text"><?=htmlspecialchars($row['biografia'])?></p>
               <a href="/pages/autora/descricao.php?id=<?=$row['cod_autora']?>" class="btn btn-primary mx-auto d-block">Ver mais</a>
            </div>
         </div>
      </div>
<?php endforeach; ?>
<?php foreach($obras as $index => $row): ?>
      <div class="xs-3 col-sm-12 col-md-12 col-lg-4 col-xl-4">
         <div class="card mb-4 " style="width: 20rem; ">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['capa']); ?>" class="card-img-top" alt="..." />
            <div class="card-body">
               <h5 class="card-title"><?=htmlspecialchars($row['titulo'])?></h5>
               <p class="card-text"><?=htmlspecialchars($row['resumo'])?></p>
               <a href="/pages/obra/descricao.php?id=<?=$row['cod_obra']?>" class="btn btn-primary mx-auto d-block">Ver mais</a>
            </div>
         </div>
      </div>
<?php endforeach; ?>
   </div>
</div>
      
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/footer.php'); ?>