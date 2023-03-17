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
    <title>Tanzpartnerbörse - Registrieren</title>
</head>
<body>
<nav>
<?php
    // include('errors.php');
    @include('menu.php');
    @require_once("db.inc.php");
    
    if (!empty($_POST)) {
        $usertest = $pdo->prepare("SELECT COUNT(username) AS num FROM benutzer WHERE username = :username");
        $usertest->bindValue(':username', $_POST['username']);
        $usertest->execute();
        $row = $usertest->fetch(PDO::FETCH_ASSOC);
        if($row['num'] > 0){
            $gibtsschon = TRUE;
        } elseif ($_POST['jahr'] > date('Y')) {
            $zukunftsmensch = TRUE;
        } else {
            $stmt = $pdo->prepare("INSERT INTO benutzer (id, username, email, rolle, beitrag, jahr, grosse, suche_id, erfahrung, password) VALUES ('', :username, :email, '', :beitrag, :jahr, :grosse, :suche_id, :erfahrung, :password)");
        if ($stmt->execute(array(
            ':username' => $_POST['username'],
            ':email' => $_POST['email'],
            ':beitrag' => $_POST['beitrag'],
            ':jahr' => $_POST['jahr'],
            ':grosse' => $_POST['grosse'],
            ':suche_id' => $_POST['suche_id'],
            ':erfahrung' => $_POST['erfahrung'],
            ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT)))) {
                $_SESSION['regsuccess'] = "Du kannst dich jetzt einloggen";
                include('./emails/reginfo.php');
                $dat = "login.php";
                header("Location: $dat");

            }
        }
    }
    // captcha
    $min  = 1;
    $max  = 20;
    $num1 = rand($min, $max);
    $num2 = rand($min, $max);
    $sum  = $num1 + $num2;
?>
</nav>
<main>
    <h1>Registrieren</h1>
    <div class="content regform">
    <?php
        if(isset($_SESSION['loginerror'])) {
            echo '<div class="infobox">';
            echo $_SESSION['loginerror'];
            unset($_SESSION['loginerror']);
            echo '</div>';
        }
        ?>
    <form method="POST">
        <label for="username">Benutzername:</label>
        <input type="text" name="username" id="username" <?php if (isset($_POST['username'])) echo "value='" . $_POST['username'] . "'";?> required><br>
        <?php
        if (!empty($gibtsschon)) {
            echo '<div class="errorbox">Diesen Benutzernamen gibt es bereits. Bitte wähle einen anderen.</div>';
        }
        ?>
        <label for="suche_id">Ich suche:</label>
        <select name="suche_id" id="suche_id" required><br>
            <option value="">-</option>
            <option value="0" <?php if (isset($_POST['suche_id']) && $_POST['suche_id'] == "0") echo ' selected'; ?>>eine Tanzpartnerin</option>
            <option value="1" <?php if (isset($_POST['suche_id']) && $_POST['suche_id'] == "1") echo ' selected'; ?>>einen Tanzpartner</option>
        </select><br>
        <label for="email">E-Mail:</label>
        <input type="email" name="email" id="email" <?php if (isset($_POST['email'])) echo "value='" . $_POST['email'] . "'";?> required><br>
        <label for="password">Passwort:</label>
        <input type="password" name="password" id="password" minlength="8" title="Mindestens 8 Zeichen" required><br>
        <label for="jahr">Geburtsjahr:</label>
        <input type="text" name="jahr" id="jahr" pattern="\d{4}" title="4-stelliges Geburtsjahr" <?php if (isset($_POST['jahr'])) echo "value='" . $_POST['jahr'] . "'";?> required><br>
        <?php
            if (!empty($zukunftsmensch)) {
            echo '<div class="errorbox">Bist Du wirklich nach ' . date('Y') . ' geboren?</div>';
            }
        ?>
        <label for="grosse">Größe (in cm):</label>
        <input type="text" name="grosse" id="grosse" pattern="\d{3}" title="3-stellige Größe in cm" <?php if (isset($_POST['grosse'])) echo "value='" . $_POST['grosse'] . "'";?> required><br>
        <label for="erfahrung">Tanzerfahrung:</label>
        <select name="erfahrung" id="erfahrung" required>
            <option value="">-</option>
            <option value="keine Tanzerfahrung" <?php if (isset($_POST['erfahrung']) && $_POST['erfahrung'] == "keine Tanzerfahrung") echo ' selected'; ?>>keine Tanzerfahrung</option>
            <option value="Anfängerkurs" <?php if (isset($_POST['erfahrung']) && $_POST['erfahrung'] == "Anfängerkurs") echo ' selected'; ?>>Anfängerkurs</option>
            <option value="Fortschrittskurs" <?php if (isset($_POST['erfahrung']) && $_POST['erfahrung'] == "Fortschrittskurs") echo ' selected'; ?>>Fortschrittskurs</option>
            <option value="ca. 1 Jahr" <?php if (isset($_POST['erfahrung']) && $_POST['erfahrung'] == "ca. 1 Jahr") echo ' selected'; ?>>ca. 1 Jahr</option>
            <option value="2 Jahre" <?php if (isset($_POST['erfahrung']) && $_POST['erfahrung'] == "2 Jahre") echo ' selected'; ?>>2 Jahre</option>
            <option value="3 Jahre" <?php if (isset($_POST['erfahrung']) && $_POST['erfahrung'] == "3 Jahre") echo ' selected'; ?>>3 Jahre</option>
            <option value="mehr als 3 Jahre" <?php if (isset($_POST['erfahrung']) && $_POST['erfahrung'] == "mehr als 3 Jahre") echo ' selected'; ?>>mehr als 3 Jahre</option>
        </select><br>
        <label for="beitrag" style="vertical-align: top;">Beschreibung:</label>
        <textarea name="beitrag" id="beitrag" cols="30" rows="6" placeholder="Wenn dieses Feld ausgefüllt ist, dann erscheint Dein Profil mit diesem Text in der Suche! Wenn Du nur auf einen Beitrag antworten willst, musst Du das nicht ausfüllen."><?php if (isset($_POST['beitrag'])) echo $_POST['beitrag'];?></textarea><br>
        <details>
            <summary>Wie funktioniert das hier?</summary>
            <p>Die Kommunikation zwischen den Beiteiligten erfolgt per Mail.<br><br>Über den Button "Kontakt" bekommt die angeschriebene Person eine E-Mail von unserem System (in der die E-Mail-Adresse der schreibenden Person ersichtlich ist).<br><br>Mit einer Antwort auf die von unserem System erhalten E-Mail werden beide E-Mail-Adressen für beide Parteien sichtbar.<br><br>Gestellte Anzeigen werden nach 12 Monaten gelöscht.</p>
        </details>
        <label for="capt"><?php echo $num1 . '+' . $num2; ?>?</label>
        <input type="text" id="capt" class="capt" placeholder="Ergebnis"><br>
        <input type="submit" value="Registrieren" data-res="<?php echo $sum; ?>" disabled>
    </form>
    </div>
    <script src="captcha.js"></script>
</main>
</body>
</html>