<?php
session_start();
require_once "controllerUserData.php"; 
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Tanzpartnerbörse</title>
</head>
<body>
<nav>
    <?php
        @include('../menu.php');
    ?>
</nav>
<main>
	<h1>Passwort zurücksetzen</h1>
	<div class="content regform">
	<form action="passwort-vergessen.php" method="POST" autocomplete="">
		<p>Bitte die E-Mail-Adresse eingeben</p>
		<?php
			if(count($errors) > 0){
				?>
				<div class="errorbox">
					<?php 
						foreach($errors as $error){
							echo $error;
						}
					?>
				</div>
				<?php
			}
		?>
				<input type="email" name="email" placeholder="E-Mail-Adresse eingeben" value="<?php echo $email ?>" required> <br>
				<input type="submit" name="check-email" value="Weiter">
	</form>
	</div>
</main>
</body>
</html>