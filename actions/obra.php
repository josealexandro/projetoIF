<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/database/obra.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/messages.php');

function buscarObraAction($cod_obra) {
   return buscarObraDb($cod_obra);
}

function buscarObraTituloAction($pesquisa) {
   return buscarObraTituloDb($pesquisa);
}

function obterObrasAction() {
   return obterObrasDb();
}

function obterObrasAutoraAction($cod_autora) {
   return obterObrasAutoraDb($cod_autora);
}

function criarObraAction($arr) {
   $titulo = trim($arr["titulo"]);
   $resumo = trim($arr["resumo"]);
   $ano = trim($arr["ano"]);
   $capa = !empty($_FILES['capa']['tmp_name']) ? file_get_contents($_FILES['capa']['tmp_name']) : null;
   $url = trim($arr["url"]);
   $autora_obra = trim($arr["autora_obra"]);
   $tipo_obra = trim($arr["tipo_obra"]);
   $editora_obra = trim($arr["editora_obra"]);
   
   $criarObraDb = criarObraDb($titulo, $resumo, $ano, $capa, $url, $autora_obra, $tipo_obra, $editora_obra);
   
   $_SESSION['alert']['status'] = $criarObraDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'create';

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function alterarObraAction($arr) {
   $cod_obra = trim($arr["cod_obra"]);
   $titulo = trim($arr["titulo"]);
   $resumo = trim($arr["resumo"]);
   $ano = trim($arr["ano"]);
   $capa = !empty($_FILES['capa']['tmp_name']) ? file_get_contents($_FILES['capa']['tmp_name']) : null;
   $update_capa = trim($arr["update_capa"]);
   $url = trim($arr["url"]);
   $autora_obra = trim($arr["autora_obra"]);
   $tipo_obra = trim($arr["tipo_obra"]);
   $editora_obra = trim($arr["editora_obra"]);
   
   $alterarObraDb = alterarObraDb($cod_obra, $titulo, $resumo, $ano, $capa, $update_capa, $url, $autora_obra, $tipo_obra, $editora_obra);
   
   $_SESSION['alert']['status'] = $alterarObraDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'update';

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function deletarObraAction($cod_obra) {
   $deletarObraDb = deletarObraDb($cod_obra);
   
   $_SESSION['alert']['status'] = $deletarObraDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'delete';

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}
?>