<?php
try {
  $pdo = new PDO(   
    "mysql:host=localhost;dbname=;charset=utf8", "", "");
}
catch (PDOException $e) {
  echo 'Fehler bei der Verbindung:  ' . $e->getMessage();
  exit();
}
?>
