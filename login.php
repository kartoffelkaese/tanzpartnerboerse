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
    <title>Tanzpartnerbörse - Login</title>
</head>
<body>
<nav>
<?php
    @include('menu.php');
    @require("db.inc.php");

    if (!empty($_POST)) {
        $stmt = $pdo->prepare('SELECT rolle, password FROM benutzer WHERE username = :username');
        $stmt->execute(array(':username' => $_POST['username']));
        $password = $stmt->fetch();

        if (password_verify($_POST['password'], $password['password'])) {
            $_SESSION['login'] = "true";
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['rolle'] = $password['rolle'];
            if (isset($_SESSION['redirect'])) {
                header("Location: ./kontakt.php?id=". $_SESSION['redirect']);
            } else {
            header("Location: ./index.php");
            }
        } else {
            $msg = "Falsche Daten. Möchtest Du dich vielleicht registrieren?";
        }
    }
?>
</nav>
<main>
    <h1>Login</h1>
    <div class="content regform">
    <?php
    if(!empty($_SESSION['regsuccess']) || !empty($_SESSION['pwchange'])) {
        echo '<div class="infobox">';
        echo $_SESSION['regsuccess'];
        echo $_SESSION['pwchange'];
        unset($_SESSION['regsuccess']);
        echo '</div>';
    }

    // captcha
    $min  = 1;
    $max  = 20;
    $num1 = rand($min, $max);
    $num2 = rand($min, $max);
    $sum  = $num1 + $num2;   
    ?>
    <form method="POST">
        <label for="name">Benutzername:</label>
        <input type="text" name="username" id="username" ><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" ><br>
        <?php 
        if($msg) {
            echo '<div class="errorbox">';
            echo $msg;
            echo '</div>';
        }
        ?>
        <label for="capt"><?php echo $num1 . '+' . $num2; ?>?</label>
        <input type="text" id="capt" class="capt" placeholder="Ergebnis"><br>
        <input type="submit" value="Einloggen" data-res="<?php echo $sum; ?>" disabled>
    </form>
    <style>
        .pwvergessen {
            padding: 10px 0 0 0;
            font-size: 0.6em;
        }
        .pwvergessen a {
            color: hsl(0, 0%, 0%);
        }
    </style>
    <div class="pwvergessen">
        <a href="passwort-vergessen/passwort-vergessen.php">Passwort vergessen</a>
    </div>
    </div>
    <script src="captcha.js"></script>
</main>
</body>
</html>