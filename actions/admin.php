<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/database/usuario.php');

function loginAction($email, $senha): ?bool {
   $email = stripcslashes(strip_tags($email));
   $senha = htmlspecialchars($senha);

   $row = buscarUsuarioEmailDb($email);

   if (is_array($row)) {
      if (password_verify($senha, $row['senha'])) {
         $_SESSION['current_session'] = [
            'name' => $row['nome'],
            'email' => $row['email'],
            'last_activity' => $_SERVER['REQUEST_TIME']
         ];
         return true;
      }
   }
   return false;
}

function logoutAction() {
   unset($_SESSION["current_session"]);
}

function validaSession() {
   $hora_atual = $_SERVER['REQUEST_TIME'];
   $limite_timeout = 900;
   $usuario = isset($_SESSION['current_session']['email']) ? buscarUsuarioEmailDb($_SESSION['current_session']['email']) : null;
   $inatividade = isset($_SESSION['current_session']['last_activity']) ? $hora_atual - $_SESSION['current_session']['last_activity'] : null;

   if ($inatividade < $limite_timeout && is_array($usuario)){
      $_SESSION['current_session']['last_activity'] = $hora_atual;
      return true;
   }
   return false;
}
?>