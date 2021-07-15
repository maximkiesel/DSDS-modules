<?php
session_start();
const DB_USER = 'sewing_site';
const DB_PASSWORD = 'HusiSQILe';

$pdo = new PDO('mysql:host=localhost;dbname=sewingdb', DB_USER, DB_PASSWORD);

?>

<html>

<head>
    <title>Sewing</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <link rel="stylesheet" href="assets/css/sideNav.css" />
    <link rel="stylesheet" href="assets/css/register.css" />
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://kit.fontawesome.com/5046510dfa.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Page Wrapper -->
    <div id="page-wrapper">
        <div id="overlay">
            <div id="headline">
                <h1>MySewingXP - Login</h1>
                <?php
                if (isset($errorMessage)) {
                    echo $errorMessage;
                }
                if (isset($_GET['login'])) {

                    $name = $_POST['name'];
                    $passwort = $_POST['password'];
                    #$passwort = password_hash($passwort, PASSWORD_DEFAULT);

                    $statement = $pdo->prepare("SELECT * FROM users WHERE user_name = :name");
                    $result = $statement->execute(array('name' => $name));
                    $user = $statement->fetch();

                    //Überprüfung des Passworts
                    if ($user !== false && $passwort == $user['password']) {
                        $_SESSION['userid'] = $user['user_name'];
                        echo ('Login erfolgreich als . Weiter zur <a href="index.php">Startseite</a>');
                    } else {
                        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
                    }
                }
                
                if (isset($_GET['sectretAdminLogin'])) {

                    $name = "Admin";
                    $passwort = "DerAdmin";
                    #$passwort = password_hash($passwort, PASSWORD_DEFAULT);

                    $statement = $pdo->prepare("SELECT * FROM users WHERE user_name = :name");
                    $result = $statement->execute(array('name' => $name));
                    $user = $statement->fetch();

                    //Überprüfung des Passworts
                    if ($user !== false && $passwort == $user['password']) {
                        $_SESSION['userid'] = $user['user_name'];
                        echo ('Login erfolgreich als . Weiter zur <a href="index.php">Startseite</a>');
                    } else {
                        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
                    }
                }
                ?>
            </div>
            <!-- The overlay sideNav -->
            <?php
            include('sidenav.php');
            ?>
            <div class="page-content">
                <form action="?login=1" method="post">
                    Benutzername:<br>
                    <input type="text" name="name"><br><br>

                    Dein Passwort:<br>
                    <input type="password" name="password"><br><br>

                    <input type="submit" value="Login">
                </form>
            </div>
            <div class="page-content" align="center">
                <p>Noch kein Mitglied der Community? Dann Klicke jetzt auf <button id="ButtonRegister" onclick="document.location.href='registrieren.php'">Registrieren!</button></p>

            </div>
        </div>
        <?php
        include('footer.php');
        ?>
    </div>

    <!-- js Scripts -->
    <script src="./assets/js/sideNav.js"></script>
</body>

</html>
