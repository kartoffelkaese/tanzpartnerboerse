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
    <title>Tanzpartnerbörse - Suche Tanzpartnerin</title>
</head>
<body>
<nav>
    <?php
        @include('menu.php');
        @require("db.inc.php");
        ?>
</nav>
<main>
    <h1>Suche Tanzpartnerin</h1>
    <div class="content container">
        <?php
        $stmt = $pdo->prepare('SELECT id, username, email, beitrag, jahr, grosse, suche_id, erfahrung, erstellt FROM benutzer WHERE suche_id = 1 ORDER BY erstellt DESC;');
        $stmt->execute();
        $tpsuche = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() <= 1) {
            echo "Leider noch keine Einträge! Erstelle doch einen, indem Du dich registrierst!";
          }
        foreach ($tpsuche as $f) :
        if (!empty($f['beitrag'])) { ?>
        <div class="benutzer">
            <?php echo $f['username']; ?><br>
            <hr>
            <span class="small">
            Größe: <?php echo $f['grosse']; ?> cm<br>
            Alter: <?php 
            if (date('Y') - $f['jahr'] < 0) {
                echo "0";
            } else {
                echo date('Y') - $f['jahr'] . " Jahre";
            }
            ?><br>
            Tanzerfahrung: <?php echo $f['erfahrung']; ?> <br>
            Erstellt: <?php 
                // Datum für Erstellt generieren
                $erstellt = new DateTime($f['erstellt']);
                $formatter = new IntlDateFormatter('de_DE', IntlDateFormatter::SHORT, IntlDateFormatter::NONE, 'Europe/Berlin', IntlDateFormatter::GREGORIAN);
                $formatter->setPattern('MMMM Y');
                $formattedDate = $formatter->format($erstellt);
                echo $formattedDate; ?><br>
            </span>
        </div>
        <div class="beitrag">
            <?php echo $f['beitrag'];?>
            <a href="kontakt.php?id=<?php echo $f['id']; ?>" id="kontakt" class="button">Kontakt</a><br>
            <?php
            if (isset($_SESSION['rolle']) && $_SESSION['rolle'] == 1) {
                echo '<a href="delete.php?id='. $f['id'].'" class="button">Löschen</a>';
            }
            ?>
        </div>
        <?php } endforeach; ?>
    </div>
</main>
</body>
</html>