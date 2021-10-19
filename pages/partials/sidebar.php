<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <title>Dashboard</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.1/css/bootstrap.min.css" integrity="sha512-6KY5s6UI5J7SVYuZB4S/CZMyPylqyyNZco376NM2Z8Sb8OxEdp02e1jkKk/wZxIEmjQ6DRCEBhni+gpr9c4tvA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="/assets/css/sidebars.css">
      <link rel="stylesheet" href="/assets/css/image-preview.css">
   </head>
   <main>
      <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
         <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">Biblioteca</span>
         </a>
         <hr>
         <ul class="nav nav-pills flex-column mb-auto">
            <li>
               <a href="/pages/admin/index.php" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                  Dashboard
               </a>
            </li>
            <li>
               <a href="/pages/admin/autora/index.php" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                  Autoras
               </a>
            </li>
            <li>
               <a href="/pages/admin/editora/index.php" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                  Editoras
               </a>
            </li>
            <li>
               <a href="/pages/admin/obra/index.php" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                  Obras
               </a>
            </li>
            <li>
               <a href="/pages/admin/perfil/index.php" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                  Perfis de Usuário
               </a>
            </li>
            <li>
               <a href="/pages/admin/tipo-obra/index.php" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                  Tipos de Obra
               </a>
            </li>
            <li>
               <a href="/pages/admin/usuario/index.php" class="nav-link text-white">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                  Usuários
               </a>
            </li>
         </ul>
         <hr>
         <div class="dropdown">
            <form action="/pages/admin/login.php" method="POST" >
               <button type="submit" class="btn btn-outline-light" name="logout">Sair</button>
            </form>
         </div>
      </div>
   <div class="b-example-divider"></div>