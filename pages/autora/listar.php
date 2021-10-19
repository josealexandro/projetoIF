<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/actions/autora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/header.php');

$autoras = obterAutorasAction();
?>
      <div style="height: 50px;"></div>
<?php foreach($autoras as $index => $row): ?>
<?php if ($index % 4 == 0): ?>
      <div class="container">
         <div class="row p-8">
<?php endif; ?>
            <div class="col-sm-3 ">
               <div class="card" style="width: 15rem; ">
                  <img src="data:image/jpeg;base64,<?php echo base64_encode($row['foto']); ?>" class="card-img-top" alt="..." />
                  <div class="card-body">
                     <h5 class="card-title text-center"><?=htmlspecialchars($row['nome'])?></h5>
                     <a href="./descricao.php?id=<?=$row['cod_autora']?>" class="btn btn-dark mx-auto d-block">Ver mais</a>
                  </div>
               </div>
            </div>
<?php if ($index % 4 === 3 || $index === (count($autoras) - 1)): ?>
         </div>
      </div>
      <div style="height: 50px;">
      </div>
<?php endif; ?>
<?php endforeach; ?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/footer.php'); ?>