<?php 
session_start();
require "connection.php";
$email = "";
$name = "";
$errors = array();
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM benutzer WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE benutzer SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
					include '../emails/new-pw-otp.php';
                if($mail){
                    $info = "Wir haben einen Code zum zurücksetzen des Passwortes an $email gesendet.";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Der Code konnte nicht gesendet werden. Bitte melden Sie sich bei uns unter <a href='mailto:info@tanzstudio-schlegl.de?Subject=Tanzpartnerbörse - OTP konnte nicht gesendet werden.'>info@tanzstudio-schlegl.de</a>!";
                }
            }else{
                $errors['db-error'] = "Etwas ist schief gelaufen!";
            }
        }else{
            $errors['email'] = "Bitte melden Sie sich bei uns unter <a href='mailto:info@tanzstudio-schlegl.de?Subject=Tanzpartnerbörse - E-Mail existiert nicht'>info@tanzstudio-schlegl.de</a>!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM benutzer WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Bitte ein neues Passwort vergeben.";
            $_SESSION['info'] = $info;
            header('location: password-new.php');
            exit();
        }else{
            $errors['otp-error'] = "Der eingegebene Code ist falsch!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Die Passwörter stimmen nicht überein!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE benutzer SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $_SESSION['pwchange'] = "Das Passwort wurde geändert. Sie können jetzt mit dem neuen Passwort einloggen.";
                header('Location: ../login.php');
            }else{
                $errors['db-error'] = "Etwas ist schief gelaufen!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: ../index.html');
    }
?>