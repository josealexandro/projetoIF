<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

function buscarPerfilDb($cod_perfil) {
   $dbConnection = getConnection();

   $cod_perfil = mysqli_real_escape_string($dbConnection, $cod_perfil);

   $sqlQuery = "SELECT * FROM perfil WHERE cod_perfil = ? LIMIT 0,1";
   $statement = mysqli_stmt_init($dbConnection);

   if (!mysqli_stmt_prepare($statement, $sqlQuery)) {
      exit('Erro SQL');
   }

   mysqli_stmt_bind_param($statement, 'i', $cod_perfil);
   mysqli_stmt_execute($statement);
   $result = mysqli_stmt_get_result($statement);

   $row = mysqli_fetch_assoc($result);

   mysqli_close($dbConnection);
   return $row;
}

function obterPerfisDb() {
   $dbConnection = getConnection();
   
   $sqlQuery = "SELECT * FROM perfil";
   $result = mysqli_query($dbConnection, $sqlQuery);

   $rows = mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : array();

   mysqli_close($dbConnection);
   return $rows;
}

function criarPerfilDb($descricao) {
   $dbConnection = getConnection();
   
   $descricao = mysqli_real_escape_string($dbConnection, $descricao) ?: NULL;

   $sqlQuery = "INSERT INTO perfil (descricao) VALUES (?)";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 's', $descricao);
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

function alterarPerfilDb($cod_perfil, $descricao) {
   $dbConnection = getConnection();
   
   $cod_perfil = mysqli_real_escape_string($dbConnection, $cod_perfil) ?: NULL;
   $descricao = mysqli_real_escape_string($dbConnection, $descricao) ?: NULL;
   $sqlQuery = "UPDATE perfil SET descricao = ? WHERE cod_perfil = ?";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'si', $descricao, $cod_perfil);
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

function deletarPerfilDb($cod_perfil) {
   $dbConnection = getConnection();
   
   $cod_perfil = mysqli_real_escape_string($dbConnection, $cod_perfil) ?: NULL;

   $sqlQuery = "DELETE FROM perfil WHERE cod_perfil = ?";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'i', $cod_perfil);
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