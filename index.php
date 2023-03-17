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
    <title>Tanzpartnerbörse</title>
</head>
<body>
<nav>
    <?php
        @include('menu.php');
    ?>
</nav>
<main>
    <h1>Tanzpartnerbörse</h1>
    <div class="content">
        <?php
        if(isset($_SESSION['sent']) || isset($_SESSION['deleted'])) {
            echo '<div class="infobox">';
            echo $_SESSION['sent'];
            echo $_SESSION['deleted'];
            unset($_SESSION['sent']);
            unset($_SESSION['deleted']);
            echo '</div>';
        }
        ?>
        <div class="suche">
            <a href="suche_f.php">Ich suche eine Tanzpartnerin</a>
            <a href="suche_m.php">Ich suche einen Tanzpartner</a>
        </div>
    </div>
    <br>
    <div class="content">
        <div class="suche">
            <a href="https://tanzstudio-schlegl.de">Zurück zur Homepage</a>
        </div>
    </div>
</main>
</body>
</html>