<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Biblioteca</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.1/css/bootstrap.min.css" integrity="sha512-6KY5s6UI5J7SVYuZB4S/CZMyPylqyyNZco376NM2Z8Sb8OxEdp02e1jkKk/wZxIEmjQ6DRCEBhni+gpr9c4tvA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="/assets/css/all.min.css">
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-dark  top">
         <div class="container-fluid ">
            <a class="navbar-brand nav-link  font" href="/"><i>Biblioteca</i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="/">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="https://www.ifsertao-pe.edu.br/">Instituto</a>
                  </li>        
                  
               </ul>
               <form class="d-flex" action="/pages/pesquisa/resultado.php" method="POST">
                  <input type="search" class="form-control me-2" name="pesquisa" placeholder="Digite uma autora ou obra" aria-label="Search" maxlength="100">
                  <input type="submit" class="btnHeader" name="pesquisar" value="Pesquisar">
               </form>
            </div>
         </div>
      </nav>
      <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v12.0" nonce="ZhLvspVt"></script>