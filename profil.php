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
    <title>Tanzpartnerbörse - Profil</title>
</head>
<body>
<nav>
    <?php
        // include('errors.php');
        @include('menu.php');
        @require_once("db.inc.php");
        $stmt = $pdo->prepare('SELECT * FROM benutzer WHERE username = :username');
        $stmt->execute(array(':username' => $_SESSION['username']));
        $user = $stmt->fetch();
        
        if(isset($_POST['beitragchange'])) {
            $stmt = $pdo->prepare('UPDATE benutzer SET beitrag = :beitragneu WHERE username = :username');
            $stmt->execute(array(':username' => $_SESSION['username'],
                                 ':beitragneu' => $_POST['beitragneu']));
            header("refresh:0");
        }
    ?>
</nav>
<main>
    <h1>Profil</h1>
    <div class="content">
        <table>
        <tr>
                <td>Name:</td>
                <td><?php echo $user['username'] ?></td>
            </tr>
            <tr>
                <td>E-Mail:</td>
                <td><?php echo $user['email'] ?></td>
            </tr>
            <tr>
                <td>Erfahrung:</td>
                <td><?php echo $user['erfahrung'] ?></td>
            </tr>
            <tr>
                <td style="vertical-align:top;">Beitrag:</td>
                <td><?php echo $user['beitrag'] ?></td>
            </tr>
            <tr>
                <td style="vertical-align:top;">Beitrag ändern:</td>
                <td>
                <form method="POST">
                    <textarea name="beitragneu" cols="30" rows="10"></textarea><br>
                    <input type="submit" name="beitragchange">
                </form>
                </td>
            </tr>
        </table>
        <?php
            if(isset($_POST['delete'])) {
                $stmt = $pdo->prepare('DELETE FROM benutzer WHERE id = :id');
                $stmt->execute(array(':id' => $user['id']));
                session_destroy();
                header('refresh:1;url=index.php');
            }
        ?>
        <form method="POST">
        <input type="submit" name="delete" id="delete" value="Anzeige und Profil löschen" class="button">
        </form>
    </div>
</main>
</body>
</html>