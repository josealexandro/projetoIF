<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/database/autora.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/messages.php');

function buscarAutoraAction($cod_autora) {
   return buscarAutoraDb($cod_autora);
}

function buscarAutoraNomeAction($pesquisa) {
   return buscarAutoraNomeDb($pesquisa);
}

function obterAutorasAction() {
   return obterAutorasDb();
}

function criarAutoraAction($arr) {
   $nome = trim($arr["nome"]);
   $biografia = trim($arr["biografia"]);
   $foto = !empty($_FILES['foto']['tmp_name']) ? file_get_contents($_FILES['foto']['tmp_name']) : null;
   $data_nasc = !empty($arr["data_nasc"]) ? date_format(date_create_from_format('d/m/Y', $arr["data_nasc"]), 'Y-m-d') : "";
   $data_morte = !empty($arr["data_morte"]) ? date_format(date_create_from_format('d/m/Y', $arr["data_morte"]), 'Y-m-d') : "";
   $instagram = trim($arr["instagram"]);
   $facebook = trim($arr["facebook"]);
   $twitter = trim($arr["twitter"]);
   $site_autora = trim($arr["site_autora"]);
   
   $criarAutoraDb = criarAutoraDb($nome, $biografia, $foto, $data_nasc, $data_morte, $instagram, $facebook, $twitter, $site_autora);
   
   $_SESSION['alert']['status'] = $criarAutoraDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'create';

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function alterarAutoraAction($arr) {
   $cod_autora = trim($arr["cod_autora"]);
   $nome = trim($arr["nome"]);
   $biografia = trim($arr["biografia"]);
   $foto = !empty($_FILES['foto']['tmp_name']) ? file_get_contents($_FILES['foto']['tmp_name']) : null;
   $update_foto = trim($arr["update_foto"]);
   $data_nasc = !empty($arr["data_nasc"]) ? date_format(date_create_from_format('d/m/Y', $arr["data_nasc"]), 'Y-m-d') : "";
   $data_morte = !empty($arr["data_morte"]) ? date_format(date_create_from_format('d/m/Y', $arr["data_morte"]), 'Y-m-d') : "";
   $instagram = trim($arr["instagram"]);
   $facebook = trim($arr["facebook"]);
   $twitter = trim($arr["twitter"]);
   $site_autora = trim($arr["site_autora"]);
   
   $alterarAutoraDb = alterarAutoraDb($cod_autora, $nome, $biografia, $foto, $update_foto, $data_nasc, $data_morte, $instagram, $facebook, $twitter, $site_autora);
   
   $_SESSION['alert']['status'] = $alterarAutoraDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'update';

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function deletarAutoraAction($cod_autora) {
   $deletarAutoraDb = deletarAutoraDb($cod_autora);
   
   $_SESSION['alert']['status'] = $deletarAutoraDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'delete';
   // descrição de erro
   $_SESSION['alert']['message'] = (isset($_SESSION['alert']['exception']) && $_SESSION['alert']['exception'] === 1451) ? 'Há <b>obra(s)</b> utilizando esse registro.' : "";

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}
?>