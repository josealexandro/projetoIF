<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/config.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function getConnection() {
   try {
      $dbConnection = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE, PORT) ?? null;
      mysqli_set_charset($dbConnection, "utf8");
   } catch (mysqli_sql_exception $e) {
      echo "Database could not be connected: " . $e->getMessage();
      die();
   }
   return $dbConnection;
}
?>