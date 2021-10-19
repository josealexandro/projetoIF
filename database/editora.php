<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

function buscarEditoraDb($cod_editora) {
   $dbConnection = getConnection();

   $cod_editora = mysqli_real_escape_string($dbConnection, $cod_editora);

   $sqlQuery = "SELECT * FROM editora WHERE cod_editora = ? LIMIT 0,1";
   $statement = mysqli_stmt_init($dbConnection);

   if (!mysqli_stmt_prepare($statement, $sqlQuery)) {
      exit('Erro SQL');
   }

   mysqli_stmt_bind_param($statement, 'i', $cod_editora);
   mysqli_stmt_execute($statement);
   $result = mysqli_stmt_get_result($statement);

   $row = mysqli_fetch_assoc($result);

   mysqli_close($dbConnection);
   return $row;
}

function obterEditorasDb() {
   $dbConnection = getConnection();
   
   $sqlQuery = "SELECT * FROM editora";
   $result = mysqli_query($dbConnection, $sqlQuery);

   $rows = mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : array();

   mysqli_close($dbConnection);
   return $rows;
}

function criarEditoraDb($nome, $estado, $cidade, $site_editora) {
   $dbConnection = getConnection();
   
   $nome = mysqli_real_escape_string($dbConnection, $nome) ?: NULL;
   $estado = mysqli_real_escape_string($dbConnection, $estado) ?: NULL;
   $cidade = mysqli_real_escape_string($dbConnection, $cidade) ?: NULL;
   $site_editora = mysqli_real_escape_string($dbConnection, $site_editora) ?: NULL;

   $sqlQuery = "INSERT INTO editora (nome, estado, cidade, site_editora) VALUES (?, ?, ?, ?)";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'ssss', $nome, $estado, $cidade, $site_editora);
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

function alterarEditoraDb($cod_editora, $nome, $estado, $cidade, $site_editora) {
   $dbConnection = getConnection();
   
   $cod_editora = mysqli_real_escape_string($dbConnection, $cod_editora) ?: NULL;
   $nome = mysqli_real_escape_string($dbConnection, $nome) ?: NULL;
   $estado = mysqli_real_escape_string($dbConnection, $estado) ?: NULL;
   $cidade = mysqli_real_escape_string($dbConnection, $cidade) ?: NULL;
   $site_editora = mysqli_real_escape_string($dbConnection, $site_editora) ?: NULL;

   $sqlQuery = "UPDATE editora SET nome = ?, estado = ?, cidade = ?, site_editora = ? WHERE cod_editora = ?";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'ssssi', $nome, $estado, $cidade, $site_editora, $cod_editora);
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

function deletarEditoraDb($cod_editora) {
   $dbConnection = getConnection();
   
   $cod_editora = mysqli_real_escape_string($dbConnection, $cod_editora) ?: NULL;

   $sqlQuery = "DELETE FROM editora WHERE cod_editora = ?";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'i', $cod_editora);
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