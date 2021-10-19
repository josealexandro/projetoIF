<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

function buscarTipoDb($cod_tipo) {
   $dbConnection = getConnection();

   $cod_tipo = mysqli_real_escape_string($dbConnection, $cod_tipo);

   $sqlQuery = "SELECT * FROM tipo_obra WHERE cod_tipo = ? LIMIT 0,1";
   $statement = mysqli_stmt_init($dbConnection);

   if (!mysqli_stmt_prepare($statement, $sqlQuery)) {
      exit('Erro SQL');
   }

   mysqli_stmt_bind_param($statement, 'i', $cod_tipo);
   mysqli_stmt_execute($statement);
   $result = mysqli_stmt_get_result($statement);

   $row = mysqli_fetch_assoc($result);

   mysqli_close($dbConnection);
   return $row;
}

function obterTiposDb() {
   $dbConnection = getConnection();
   
   $sqlQuery = "SELECT * FROM tipo_obra";
   $result = mysqli_query($dbConnection, $sqlQuery);

   $rows = mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : array();

   mysqli_close($dbConnection);
   return $rows;
}

function criarTipoDb($descricao) {
   $dbConnection = getConnection();
   
   $descricao = mysqli_real_escape_string($dbConnection, $descricao) ?: NULL;

   $sqlQuery = "INSERT INTO tipo_obra (descricao) VALUES (?)";
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

function alterarTipoDb($cod_tipo, $descricao) {
   $dbConnection = getConnection();
   
   $cod_tipo = mysqli_real_escape_string($dbConnection, $cod_tipo) ?: NULL;
   $descricao = mysqli_real_escape_string($dbConnection, $descricao) ?: NULL;
   $sqlQuery = "UPDATE tipo_obra SET descricao = ? WHERE cod_tipo = ?";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'si', $descricao, $cod_tipo);
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

function deletarTipoDb($cod_tipo) {
   $dbConnection = getConnection();
   
   $cod_tipo = mysqli_real_escape_string($dbConnection, $cod_tipo) ?: NULL;

   $sqlQuery = "DELETE FROM tipo_obra WHERE cod_tipo = ?";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'i', $cod_tipo);
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