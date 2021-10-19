<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/database/tipo-obra.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/messages.php');

function buscarTipoAction($cod_tipo) {
   return buscarTipoDb($cod_tipo);
}

function obterTiposAction() {
   return obterTiposDb();
}

function criarTipoAction($arr) {
   $descricao = trim($arr["descricao"]);
   
   $criarTipoDb = criarTipoDb($descricao);
   
   $_SESSION['alert']['status'] = $criarTipoDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'create';

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function alterarTipoAction($arr) {
   $cod_tipo = trim($arr["cod_tipo"]);
   $descricao = trim($arr["descricao"]);
   
   $alterarTipoDb = alterarTipoDb($cod_tipo, $descricao);
   
   $_SESSION['alert']['status'] = $alterarTipoDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'update';

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function deletarTipoAction($cod_tipo) {
   $deletarTipoDb = deletarTipoDb($cod_tipo);
   
   $_SESSION['alert']['status'] = $deletarTipoDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'delete';
   // descrição de erro
   $_SESSION['alert']['message'] = (isset($_SESSION['alert']['exception']) && $_SESSION['alert']['exception'] === 1451) ? 'Há <b>obra(s)</b> utilizando esse registro.' : "";

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}
?>