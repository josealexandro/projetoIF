<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/database/perfil.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/messages.php');

function buscarPerfilAction($cod_perfil) {
   return buscarPerfilDb($cod_perfil);
}

function obterPerfisAction() {
   return obterPerfisDb();
}

function criarPerfilAction($arr) {
   $descricao = trim($arr["descricao"]);
   
   $criarPerfilDb = criarPerfilDb($descricao);
   
   $_SESSION['alert']['status'] = $criarPerfilDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'create';

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function alterarPerfilAction($arr) {
   $cod_perfil = trim($arr["cod_perfil"]);
   $descricao = trim($arr["descricao"]);
   
   $alterarPerfilDb = alterarPerfilDb($cod_perfil, $descricao);
   
   $_SESSION['alert']['status'] = $alterarPerfilDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'update';

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function deletarPerfilAction($cod_perfil) {
   $deletarPerfilDb = deletarPerfilDb($cod_perfil);
   
   $_SESSION['alert']['status'] = $deletarPerfilDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'delete';
   // descrição de erro
   $_SESSION['alert']['message'] = (isset($_SESSION['alert']['exception']) && $_SESSION['alert']['exception'] === 1451) ? 'Há <b>usuário(s)</b> utilizando esse registro.' : "";

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}
?>