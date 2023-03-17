<?php
    session_start();
    if(isset($_POST)) {
        echo "yes";
    } else {
        echo "no";
    }

    $min  = 1;
    $max  = 10;
    $num1 = rand($min, $max);
    $num2 = rand($min, $max);
    $sum  = $num1 + $num2;
    $_SESSION['captcha'] = $sum;

    echo $num1 . " + " . $num2 . " = " . '<form method="POST"><input type="text" name="captcha" id="captcha"><input type="submit"></form>';

?>