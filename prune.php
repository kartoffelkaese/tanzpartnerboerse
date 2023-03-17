<?php
    @require("db.inc.php");
    $stmt = $pdo->prepare("DELETE FROM benutzer WHERE erstellt < NOW() - INTERVAL 1 YEAR");
    $stmt->execute();
?>

