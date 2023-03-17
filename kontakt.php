<?php
session_start();
if ($_SESSION['login'] != true) {
    $_SESSION['loginerror'] = "Zum Kontaktieren bitte zuerst einen Account anlegen oder einloggen.";
    $_SESSION['redirect'] = $_GET['id'];
    header("Location: registrieren.php");
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tanzpartnerbörse - Kontakt</title>
</head>
<body>
<nav>
    <?php
        @include('menu.php');
        @require("db.inc.php");
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare('SELECT username, beitrag, email FROM benutzer WHERE id = '. $_GET['id']);
            $stmt->execute();
            $to = $stmt->fetch(PDO::FETCH_ASSOC);
            // print_r($to);  
        }
        if (isset($_POST['kontakt'])) {
            $stmt = $pdo->prepare('SELECT username, email FROM benutzer WHERE username = :username');
            $stmt->execute(array(':username' => $_SESSION['username']));
            $from = $stmt->fetch(PDO::FETCH_ASSOC);
            include './emails/kontakt.php';
            $_SESSION['sent'] = "Deine Nachricht wurde gesendet!";
            header("Location: index.php");
        }
        ?>
</nav>
<main>
    <h1>Kontakt</h1>
    <div class="content">
    <form method="POST" class="kontaktform">
        <div class="from">
            <?php echo $to['username']; ?> schrieb: <br>
        </div>
        <div class="fromtext">
            <?php echo $to['beitrag']; ?>
        </div>
        <label for="nachricht">Was möchtest Du schreiben?</label> <br>
        <textarea name="nachricht" id="nachricht" required></textarea><br>
        <input type="submit" name="kontakt" value="Absenden">
    </form>
    </div>
</main>
</body>
</html>