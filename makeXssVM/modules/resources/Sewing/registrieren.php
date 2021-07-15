<?php
session_start();
const DB_USER = 'sewing_site';
const DB_PASSWORD = 'HusiSQILe';

$pdo = new PDO('mysql:host=localhost;dbname=sewingdb', DB_USER, DB_PASSWORD);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registrierung</title>
    <link rel="stylesheet" href="assets/css/index.css" />
    <link rel="stylesheet" href="assets/css/register.css" />
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="is-preload">
    <!-- Page Wrapper -->
    <div id="page-wrapper">
        <div id="overlay">
            <div id="headline">
                <h1>MySewingXP - Registrieren</h1>

            </div>
            <div id="sideNavButton">
                <button id="ButtonBack" onclick="document.location.href='login.php'">Zurück</button>
                <!--<span onclick="openNav()">Menü</span>-->
            </div>

            <div class="page-content">

                <?php
                $showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

                if (isset($_GET['register'])) {
                    $error = false;
                    $email = $_POST['email'];
                    $name = $_POST['name'];
                    $passwort = $_POST['passwort'];
                    $passwort2 = $_POST['passwort2'];

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
                        $error = true;
                    }
                    if (strlen($name) == 0) {
                        echo 'Bitte ein Benutzernamen eingeben<br>';
                        $error = true;
                    }

                    if (strlen($passwort) == 0) {
                        echo 'Bitte ein Passwort angeben<br>';
                        $error = true;
                    }
                    if ($passwort != $passwort2) {
                        echo 'Die Passwörter müssen übereinstimmen<br>';
                        $error = true;
                    }

                    //Überprüfe, dass die Benutzername noch nicht vergeben wurde
                    if (!$error) {
                        $statement = $pdo->prepare("SELECT * FROM users WHERE user_name = :name");
                        $result = $statement->execute(array('name' => $name));
                        $user = $statement->fetch();

                        if ($user !== false) {
                            echo 'Dieser Benutzername ist bereits vergeben<br>';
                            $error = true;
                        }
                    }

                    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
                    if (!$error) {
                        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
                        $result = $statement->execute(array('email' => $email));
                        $user = $statement->fetch();

                        if ($user !== false) {
                            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
                            $error = true;
                        }
                    }

                    //Keine Fehler, wir können den Nutzer registrieren
                    if (!$error) {
                        #$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
                        $passwort_hash = $passwort;

                        $statement = $pdo->prepare("INSERT INTO users (email, password, user_name) VALUES (:email, :passwort, :name)");
                        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'name' => $name));

                        if ($result) {
                            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
                            $showFormular = false;
                        } else {
                            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
                        }
                    }
                }

                if ($showFormular) {
                ?>
                    <form action="?register=1" method="post">
                        E-Mail:<br>
                        <input type="email" name="email"><br><br>

                        Benutzername:<br>
                        <input type="text" name="name"><br><br>

                        Dein Passwort:<br>
                        <input type="password" name="passwort"><br>

                        Passwort wiederholen:<br>
                        <input type="password" name="passwort2"><br><br>

                        <input type="submit" value="Abschicken">
                    </form>

                <?php
                } //Ende von if($showFormular)
                ?>
            </div>
        </div>
        <?php
        include('footer.php');
        ?>
    </div>

</body>

</html>