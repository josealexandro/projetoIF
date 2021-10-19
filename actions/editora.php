<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/database/editora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/messages.php');

function buscarEditoraAction($cod_editora) {
   return buscarEditoraDb($cod_editora);
}

function obterEditorasAction() {
   return obterEditorasDb();
}

function criarEditoraAction($arr) {
   $nome = trim($arr["nome"]);
   $estado = trim($arr["estado"]);
   $cidade = trim($arr["cidade"]);
   $site_editora = trim($arr["site_editora"]);
   
   $criarEditoraDb = criarEditoraDb($nome, $estado, $cidade, $site_editora);
   
   $_SESSION['alert']['status'] = $criarEditoraDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'create';

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function alterarEditoraAction($arr) {
   $cod_editora = trim($arr["cod_editora"]);
   $nome = trim($arr["nome"]);
   $estado = trim($arr["estado"]);
   $cidade = trim($arr["cidade"]);
   $site_editora = trim($arr["site_editora"]);
   
   $alterarEditoraDb = alterarEditoraDb($cod_editora, $nome, $estado, $cidade, $site_editora);
   
   $_SESSION['alert']['status'] = $alterarEditoraDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'update';
   
	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function deletarEditoraAction($cod_editora) {
   $deletarEditoraDb = deletarEditoraDb($cod_editora);
   
   $_SESSION['alert']['status'] = $deletarEditoraDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'delete';
   // descrição de erro
   $_SESSION['alert']['message'] = (isset($_SESSION['alert']['exception']) && $_SESSION['alert']['exception'] === 1451) ? 'Há <b>obra(s)</b> utilizando esse registro.' : "";

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}
?>