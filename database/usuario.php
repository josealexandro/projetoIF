<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

function buscarUsuarioDb($cod_usuario) {
   $dbConnection = getConnection();

   $cod_usuario = mysqli_real_escape_string($dbConnection, $cod_usuario);

   $sqlQuery = "SELECT * FROM usuarios WHERE cod_usuario = ? LIMIT 0,1";
   $statement = mysqli_stmt_init($dbConnection);

   if (!mysqli_stmt_prepare($statement, $sqlQuery)) {
      exit('Erro SQL');
   }

   mysqli_stmt_bind_param($statement, 'i', $cod_usuario);
   mysqli_stmt_execute($statement);
   $result = mysqli_stmt_get_result($statement);

   $row = mysqli_fetch_assoc($result);

   mysqli_close($dbConnection);

   return $row;
}

function buscarUsuarioEmailDb(string $email) {
   $dbConnection = getConnection();

   $email = mysqli_real_escape_string($dbConnection, $email);

   $sqlQuery = "SELECT * FROM usuarios WHERE email = ? LIMIT 0,1";
   $statement = mysqli_stmt_init($dbConnection);

   if (!mysqli_stmt_prepare($statement, $sqlQuery)) {
      exit('Erro SQL');
   }

   mysqli_stmt_bind_param($statement, 's', $email);
   mysqli_stmt_execute($statement);
   $result = mysqli_stmt_get_result($statement);

   $row = mysqli_fetch_assoc($result);

   mysqli_close($dbConnection);

   return $row;
}

function obterUsuariosDb() {
   $dbConnection = getConnection();
   
   $sqlQuery = "SELECT * FROM usuarios";
   $result = mysqli_query($dbConnection, $sqlQuery);

   $rows = mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : array();

   mysqli_close($dbConnection);
   return $rows;
}

function criarUsuarioDb($nome, $email, $senha, $perfil_usuario) {
   $dbConnection = getConnection();
   
   $nome = mysqli_real_escape_string($dbConnection, $nome) ?: NULL;
   $email = mysqli_real_escape_string($dbConnection, $email) ?: NULL;
   $senha = mysqli_real_escape_string($dbConnection, $senha) ?: NULL;
   $perfil_usuario = mysqli_real_escape_string($dbConnection, $perfil_usuario) ?: NULL;

   $hash = password_hash($senha, PASSWORD_DEFAULT);

   $sqlQuery = "INSERT INTO usuarios (nome, email, senha, perfil_usuario) VALUES (?, ?, ?, ?)";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'sssi', $nome, $email, $hash, $perfil_usuario);
      mysqli_stmt_execute($statement);
   } catch (mysqli_sql_exception $e) {
      $_SESSION['alert']['exception'] = $e->getCode();
      return false;
   } finally {
      mysqli_stmt_close($statement);
      mysqli_close($dbConnection);
   }
   return true;
}

function alterarUsuarioDb($cod_usuario, $nome, $email, $senha, $perfil_usuario) {
   $dbConnection = getConnection();
   
   $cod_usuario = mysqli_real_escape_string($dbConnection, $cod_usuario) ?: NULL;
   $nome = mysqli_real_escape_string($dbConnection, $nome) ?: NULL;
   $email = mysqli_real_escape_string($dbConnection, $email) ?: NULL;
   $senha = mysqli_real_escape_string($dbConnection, $senha) ?: NULL;
   $perfil_usuario = mysqli_real_escape_string($dbConnection, $perfil_usuario) ?: NULL;

   $hash = password_hash($senha, PASSWORD_DEFAULT);
   $sqlQuery = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, perfil_usuario = ? WHERE cod_usuario = ?";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'sssii', $nome, $email, $hash, $perfil_usuario, $cod_usuario);
      mysqli_stmt_execute($statement);
   } catch (mysqli_sql_exception $e) {
      $_SESSION['alert']['exception'] = $e->getCode();
      return false;
   } finally {
      mysqli_stmt_close($statement);
      mysqli_close($dbConnection);
   }
   return true;
}

function deletarUsuarioDb($cod_usuario) {
   $dbConnection = getConnection();
   
   $cod_usuario = mysqli_real_escape_string($dbConnection, $cod_usuario) ?: NULL;

   $sqlQuery = "DELETE FROM usuarios WHERE cod_usuario = ?";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'i', $cod_usuario);
      mysqli_stmt_execute($statement);
   } catch (mysqli_sql_exception $e) {
      $_SESSION['alert']['exception'] = $e->getCode();
      return false;
   } finally {
      mysqli_stmt_close($statement);
      mysqli_close($dbConnection);
   }
   return true;
}
?>