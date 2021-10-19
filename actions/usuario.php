<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/database/usuario.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/modules/messages.php');

function buscarUsuarioAction($cod_usuario) {
   return buscarUsuarioDb($cod_usuario);
}

function obterUsuariosAction() {
   return obterUsuariosDb();
}

function criarUsuarioAction($arr) {
   $nome = trim($arr["nome"]);
   $email = trim($arr["email"]);
   $senha = trim($arr["senha"]);
   $perfil_usuario = trim($arr["perfil_usuario"]);
   
   $criarUsuarioDb = criarUsuarioDb($nome, $email, $senha, $perfil_usuario);
   
   $_SESSION['alert']['status'] = $criarUsuarioDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'create';
   // descrição de erro
   $_SESSION['alert']['message'] = (isset($_SESSION['alert']['exception']) && $_SESSION['alert']['exception'] === 1062) ? 'Já existe um <b>usuário</b> com o email informado.' : "";
   
	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function alterarUsuarioAction($arr) {
   $cod_usuario = trim($arr["cod_usuario"]);
   $nome = trim($arr["nome"]);
   $email = trim($arr["email"]);
   $senha = trim($arr["senha"]);
   $perfil_usuario = trim($arr["perfil_usuario"]);

   $usuario = buscarUsuarioAction($cod_usuario);
   $usuarioLogado = ($usuario['email'] == $_SESSION['current_session']['email']);

   $alterarUsuarioDb = alterarUsuarioDb($cod_usuario, $nome, $email, $senha, $perfil_usuario);

   if ($usuarioLogado && $alterarUsuarioDb) {
      session_start();
      $_SESSION['current_session']['name'] = $nome;
      $_SESSION['current_session']['email'] = $email;
   }

   $_SESSION['alert']['status'] = $alterarUsuarioDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'update';
   // descrição de erro
   $_SESSION['alert']['message'] = (isset($_SESSION['alert']['exception']) && $_SESSION['alert']['exception'] === 1062) ? 'Já existe um <b>usuário</b> com o email informado.' : "";

   return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function deletarUsuarioAction($cod_usuario) {
   $usuario = buscarUsuarioAction($cod_usuario);
   $usuarioLogado = ($usuario['email'] == $_SESSION['current_session']['email']);
   $deletarUsuarioDb = (!$usuarioLogado) ? deletarUsuarioDb($cod_usuario) : null;

   $_SESSION['alert']['status'] = $deletarUsuarioDb ? 'success' : 'error';
   $_SESSION['alert']['action'] = 'delete';
   // descrição de erro
   $_SESSION['alert']['message'] = ($usuarioLogado) ? 'Não é possível excluir o <b>usuário</b> atual.' : "";

	return header("Location: " . dirname($_SERVER["PHP_SELF"]) . "/index.php");
}

function emailDisponivel($email) {
   return !buscarUsuarioEmailDb($email);
}
?>