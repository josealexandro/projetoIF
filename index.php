<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/header.php'); ?>

   <div class="titlebody">
      <h1 class="title"><i> Bem vindo(a) à nossa biblioteca ! </i></h1>
   </div>
      <!-- <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
         <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
         </div>
         <div class="carousel-inner">
            <div class="carousel-item active">
               <img src="/assets/media/obras/obra1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
               <img src="/assets/media/obras/obra2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
               <img src="/assets/media/obras/obra3.jpg" class="d-block w-100" alt="...">
            </div>
         </div>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
         </button>
      </div> --> <br>
      <div class="container">
         <div class="row pb-5">
            <div class="xs-3 col-sm-12 col-md-12 col-lg-6 col-xl-6">
               <div class="card mb-4 mx-auto " style="width: 30rem; ">
                  <img src="/assets/media/autoras/autora1.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                     <h5 class="card-title">Todas as autoras</h5>
                    <p class="card-text"> Descrição de o que o usuario irá encontrar</p>
                     <a href="pages/autora/listar.php" class="btn btn-secondary mx-auto d-block ">Ver todas</a>
                  </div>
               </div>
            </div>
            <div class="xs-3 col-sm-12 col-md-12 col-lg-6 col-xl-6">
               <div class="card mb-4 mx-auto" style="width: 30rem; ">
                  <img src="/assets/media/obras/obra1.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                     <h5 class="card-title">Todas as obras</h5>
                     <p class="card-text">Descrição de o que o usuario irá encontra Some quick example text to build on the card title and make mais texto e outro.</p>
                     <a href="pages/obra/listar.php" class="btn btn-secondary mx-auto d-block ">Ver todas</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/partials/footer.php'); ?>