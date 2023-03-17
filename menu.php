<div class="menu">
            <?php
            if (isset($_SESSION["login"]) && ($_SESSION["login"] == "true")) {
                echo '<ul><li><a href="https://tanzstudio-schlegl.de/tanzpartnerboerse/index.php">Home</a> </li>';
                echo '<li><a href="https://tanzstudio-schlegl.de/tanzpartnerboerse/profil.php">Profil</a> </li>';
                echo '<li><a href="https://tanzstudio-schlegl.de/tanzpartnerboerse/logout.php">Ausloggen</a></li></ul>';
            } else {                
                echo '<ul><li><a href="https://tanzstudio-schlegl.de/tanzpartnerboerse/index.php">Home</a> </li>';
                echo '<li><a href="https://tanzstudio-schlegl.de/tanzpartnerboerse/login.php">Login</a> </li>';
                echo '<li><a href="https://tanzstudio-schlegl.de/tanzpartnerboerse/registrieren.php">Registrieren</a></li></ul>';
            }
            ?>
        </div>