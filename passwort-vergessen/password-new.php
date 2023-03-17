<?php 
session_start();
require_once "controllerUserData.php";
$email = $_SESSION['email'];
if($email == false){
  header('Location: ../index.php');
}
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
	<h1>Neues Passwort</h1>
    <div class="content regform">
		<form action="password-new.php" method="POST" autocomplete="off">
			<?php 
			if(isset($_SESSION['info'])){
				?>
				<div class="infobox">
					<?php echo $_SESSION['info']; ?>
				</div>
				<?php
			}
			?>
			<?php
			if(count($errors) > 0){
				?>
				<div class="errorbox">
					<?php
					foreach($errors as $showerror){
						echo $showerror;
					}
					?>
				</div>
				<?php
			}
			?>
			<div>
				<input type="password" name="password" placeholder="Neues Passwort" minlength="8" required> <br>
				<input type="password" name="cpassword" placeholder="Passwort bestätigen" minlength="8" required><br><br>
				<input type="submit" name="change-password" value="Absenden">
			</div>
		</form>
	</div>   
</body>
</html>