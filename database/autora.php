<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');

function buscarAutoraDb($cod_autora) {
   $dbConnection = getConnection();

   $cod_autora = mysqli_real_escape_string($dbConnection, $cod_autora);

   $sqlQuery = "SELECT * FROM autoras WHERE cod_autora = ? LIMIT 0,1";
   $statement = mysqli_stmt_init($dbConnection);

   if (!mysqli_stmt_prepare($statement, $sqlQuery)) {
      exit('Erro SQL');
   }

   mysqli_stmt_bind_param($statement, 'i', $cod_autora);
   mysqli_stmt_execute($statement);
   $result = mysqli_stmt_get_result($statement);

   $row = mysqli_fetch_assoc($result);

   mysqli_close($dbConnection);
   return $row;
}

function buscarAutoraNomeDb($pesquisa) {
   $dbConnection = getConnection();

   $pesquisa = mysqli_real_escape_string($dbConnection, $pesquisa);

   $sqlQuery = "SELECT * FROM autoras WHERE nome LIKE '%" . $pesquisa . "%'";
   $result = mysqli_query($dbConnection, $sqlQuery);

   $rows = mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : array();

   mysqli_close($dbConnection);
   return $rows;
}

function obterAutorasDb() {
   $dbConnection = getConnection();
   
   $sqlQuery = "SELECT * FROM autoras";
   $result = mysqli_query($dbConnection, $sqlQuery);

   $rows = mysqli_num_rows($result) > 0 ? mysqli_fetch_all($result, MYSQLI_ASSOC) : array();

   mysqli_close($dbConnection);
   return $rows;
}

function criarAutoraDb($nome, $biografia, $foto, $data_nasc, $data_morte, $instagram, $facebook, $twitter, $site_autora) {
   $dbConnection = getConnection();
   
   $nome = mysqli_real_escape_string($dbConnection, $nome) ?: NULL;
   $biografia = mysqli_real_escape_string($dbConnection, $biografia) ?: NULL;
   $foto = $foto ?: NULL;
   $data_nasc = mysqli_real_escape_string($dbConnection, $data_nasc) ?: NULL;
   $data_morte = mysqli_real_escape_string($dbConnection, $data_morte) ?: NULL;
   $instagram = mysqli_real_escape_string($dbConnection, $instagram) ?: NULL;
   $facebook = mysqli_real_escape_string($dbConnection, $facebook) ?: NULL;
   $twitter = mysqli_real_escape_string($dbConnection, $twitter) ?: NULL;
   $site_autora = mysqli_real_escape_string($dbConnection, $site_autora) ?: NULL;

   $sqlQuery = "INSERT INTO autoras (nome, biografia, foto, data_nasc, data_morte, instagram, facebook, twitter, site_autora) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'sssssssss', $nome, $biografia, $foto, $data_nasc, $data_morte, $instagram, $facebook, $twitter, $site_autora);
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

function alterarAutoraDb($cod_autora, $nome, $biografia, $foto, $update_foto, $data_nasc, $data_morte, $instagram, $facebook, $twitter, $site_autora) {
   $dbConnection = getConnection();
   
   $cod_autora = mysqli_real_escape_string($dbConnection, $cod_autora) ?: NULL;
   $nome = mysqli_real_escape_string($dbConnection, $nome) ?: NULL;
   $biografia = mysqli_real_escape_string($dbConnection, $biografia) ?: NULL;
   $data_nasc = mysqli_real_escape_string($dbConnection, $data_nasc) ?: NULL;
   $data_morte = mysqli_real_escape_string($dbConnection, $data_morte) ?: NULL;
   $instagram = mysqli_real_escape_string($dbConnection, $instagram) ?: NULL;
   $facebook = mysqli_real_escape_string($dbConnection, $facebook) ?: NULL;
   $twitter = mysqli_real_escape_string($dbConnection, $twitter) ?: NULL;
   $site_autora = mysqli_real_escape_string($dbConnection, $site_autora) ?: NULL;

   $params = [$nome, $biografia, $data_nasc, $data_morte, $instagram, $facebook, $twitter, $site_autora, $cod_autora];
   $types = 'ssssssssi';
   $sqlQuery = "UPDATE autoras SET nome = ?, biografia = ?, data_nasc = ?, data_morte = ?, instagram = ?, facebook = ?, twitter = ?, site_autora = ? WHERE cod_autora = ?";
   
   // ajusta tipos, parâmetros e query para inserir campo fotos
   if ($update_foto) {
      $types = 's' . $types;
      array_unshift($params , $foto);
      $sqlQuery = str_replace("SET", "SET foto = ?,",  $sqlQuery);
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

function deletarAutoraDb($cod_autora) {
   $dbConnection = getConnection();
   
   $cod_autora = mysqli_real_escape_string($dbConnection, $cod_autora) ?: NULL;

   $sqlQuery = "DELETE FROM autoras WHERE cod_autora = ?";
   $statement = mysqli_stmt_init($dbConnection);

   try {
      mysqli_stmt_prepare($statement, $sqlQuery);
      mysqli_stmt_bind_param($statement, 'i', $cod_autora);
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