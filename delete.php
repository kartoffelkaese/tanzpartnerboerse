<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tanzpartnerbörse - Löschen</title>
</head>
<body>
    <?php
        @require("db.inc.php");
        if ($_SESSION['rolle'] == 1) {
            if (isset($_GET['id'])) {
                $stmt = $pdo->prepare('DELETE FROM benutzer WHERE id = '. $_GET['id']);
                $stmt->execute();
                $_SESSION['deleted'] = "User wurde gelöscht.";
                header("Location: index.php");
            }
        } else {
            echo "nope.";
        }
        ?>
</body>
</html>