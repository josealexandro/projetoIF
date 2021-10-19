<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

function buscarObraDb($cod_obra) {
   $dbConnection = getConnection();

   $cod_obra = mysqli_real_escape_string($dbConnection, $cod_obra);

   $sqlQuery = "SELECT * FROM obras WHERE cod_obra = ? LIMIT 0,1";
   $statement = mysqli_stmt_init($dbConnection);

   if (!mysqli_stmt_prepare($statement, $sqlQuery)) {
      exit('Erro SQL');
   }

   mysqli_stmt_bind_param($statement, 'i', $cod_obra);
   mysqli_stmt_execute($statement);
      $result = mysqli_stmt_get_result($statement);

   $row = mysqli_fetch_assoc($result);

   mysqli_close($dbConnection);
   return $row;
}

function buscarObraTituloDb($pesquisa) {
   $dbConnection = getConnection();

   $pesquisa = mysqli_real_escape_string($dbConnection, $pesquisa);

   $sqlQuery = "SELECT * FROM obras WHERE titulo LIKE '%" . $pesquisa . "%'";
   $result = mysqli_query($dbConnection, $sqlQuery);

   $rows = mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : array();

   mysqli_close($dbConnection);
   return $rows;
}

function obterObrasDb() {
   $dbConnection = getConnection();

   $sqlQuery = "SELECT * FROM obras";
   $result = mysqli_query($dbConnection, $sqlQuery);

   $rows = mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : array();

   mysqli_close($dbConnection);
   return $rows;
}

function obterObrasAutoraDb($cod_autora) {
   $dbConnection = getConnection();

   $cod_autora = mysqli_real_escape_string($dbConnection, $cod_autora);

   $sqlQuery = "SELECT * FROM obras WHERE autora_obra = ?";
   $statement = mysqli_stmt_init($dbConnection);

   if (!mysqli_stmt_prepare($statement, $sqlQuery)) {
      exit('Erro SQL');
   }

   mysqli_stmt_bind_param($statement, 'i', $cod_autora);
   mysqli_stmt_execute($statement);
   
   $result = mysqli_stmt_get_result($statement);
   $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

   mysqli_close($dbConnection);
   return $rows;
}

function criarObraDb($titulo, $resumo, $ano, $capa, $url, $autora_obra, $tipo_obra, $editora_obra) {
   $dbConnection = getConnection();
   
   $titulo = mysqli_real_escape_string($dbConnection, $titulo) ?: NULL;
   $resumo = mysqli_real_escape_string($dbConnection, $resumo) ?: NULL;
   $ano = mysqli_real_escape_string($dbConnection, $ano) ?: NULL;
   $capa = $capa ?: NULL;
   $url = mysqli_real_escape_string($dbConnection, $url) ?: NULL;
   $autora_obra = mysqli_real_escape_string($dbConnection, $autora_obra) ?: NULL;
   $tipo_obra = mysqli_real_escape_string($dbConnection, $tipo_obra) ?: NULL;
   $editora_obra = mysqli_real_escape_string($dbConnection, $editora_obra) ?: NULL;

   $sqlQuery = "INSERT INTO obras (titulo, resumo, ano, capa, url, autora_obra, tipo_obra, editora_obra) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'ssssssss', $titulo, $resumo, $ano, $capa, $url, $autora_obra, $tipo_obra, $editora_obra);
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

function alterarObraDb($cod_obra, $titulo, $resumo, $ano, $capa, $update_capa, $url, $autora_obra, $tipo_obra, $editora_obra) {
   $dbConnection = getConnection();
   
   $cod_obra = mysqli_real_escape_string($dbConnection, $cod_obra) ?: NULL;
   $titulo = mysqli_real_escape_string($dbConnection, $titulo) ?: NULL;
   $resumo = mysqli_real_escape_string($dbConnection, $resumo) ?: NULL;
   $ano = mysqli_real_escape_string($dbConnection, $ano) ?: NULL;
   $url = mysqli_real_escape_string($dbConnection, $url) ?: NULL;
   $autora_obra = mysqli_real_escape_string($dbConnection, $autora_obra) ?: NULL;
   $tipo_obra = mysqli_real_escape_string($dbConnection, $tipo_obra) ?: NULL;
   $editora_obra = mysqli_real_escape_string($dbConnection, $editora_obra) ?: NULL;
   
   $params = [$titulo, $resumo, $ano, $url, $autora_obra, $tipo_obra, $editora_obra, $cod_obra];
   $types = 'sssssssi';
   $sqlQuery = "UPDATE obras SET titulo = ?, resumo = ?, ano = ?, url = ?, autora_obra = ?, tipo_obra = ?, editora_obra = ? WHERE cod_obra = ?";
   
   // ajusta tipos, parâmetros e query para inserir campo 'capa'
   if ($update_capa) {
      $types = 's' . $types;
      array_unshift($params , $capa);
      $sqlQuery = str_replace("SET", "SET capa = ?,",  $sqlQuery);
   }
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, $types, ...$params);
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

function deletarObraDb($cod_obra) {
   $dbConnection = getConnection();
   
   $cod_obra = mysqli_real_escape_string($dbConnection, $cod_obra) ?: NULL;

   $sqlQuery = "DELETE FROM obras WHERE cod_obra = ?";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'i', $cod_obra);
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