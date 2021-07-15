<?php
session_start();
define('DB_USER', 'sewing_site');
define('DB_PASSWORD', 'HusiSQILe');
define('SITE_ROOT', realpath(dirname(__FILE__)));
?>
<html>

<head>
    <title>Sewing</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <link rel="stylesheet" href="assets/css/sideNav.css" />
    <link rel="stylesheet" href="assets/css/profile.css">
    <script src="https://kit.fontawesome.com/5046510dfa.js" crossorigin="anonymous"></script>
</head>

<body class="is-preload">
    <?php
    if (!isset($_SESSION['userid'])) {
        $show_form = false;
    } else {
        $show_form = true;
    }
    $pdo = new PDO('mysql:host=localhost;dbname=sewingdb', DB_USER, DB_PASSWORD);
    $error = null;

    ?>

    <!-- Page Wrapper -->
    <div id="page-wrapper">

        <div id="headline">
            <h1>Profile</h1>
        </div>
        <!-- The overlay -->
        <div id="overlay">
            <?php
            include('sidenav.php');
            ?>

            <?php
            if ($show_form) {
                $name = $_SESSION['userid'];
                $imageStatement = $pdo->prepare("SELECT COUNT(*) FROM pictures Where user_name = '$name'");
                $imageStatement->execute();
                $countPosts = $imageStatement->fetch();

                $imageStatement = $pdo->prepare("SELECT COUNT(*) FROM comments Where user_name = '$name'");
                $imageStatement->execute();
                $countCommentsMade = $imageStatement->fetch();

                $imageStatement = $pdo->prepare("SELECT COUNT(*) FROM sewingdb.comments as c, sewingdb.pictures as p Where p.user_name = '$name' and p.pic_id = c.pic_id and c.user_name != '$name'");
                $imageStatement->execute();
                $countCommentsGot = $imageStatement->fetch();

                $imageStatement = $pdo->prepare("SELECT * FROM users WHERE user_name ='$name'");
                $imageStatement->execute();
                $userRow = $imageStatement->fetch();

                if (isset($_POST['delete'])) {
                    $imageStatement = $pdo->prepare("DELETE FROM pictures WHERE user_name ='$name'");
                    $imageStatement->execute();

                    $imageStatement = $pdo->prepare("DELETE FROM users WHERE user_name ='$name'");
                    $imageStatement->execute();

                    $imageStatement = $pdo->prepare("DELETE FROM comments WHERE user_name ='$name'");
                    $imageStatement->execute();

                    session_destroy();
                    header("Location: login.php");
                    die();
                }

                if (isset($_POST['deleteUser'])) {

                    $userName = $_POST['text'];
                    $imageStatement = $pdo->prepare("DELETE FROM pictures WHERE user_name ='$userName'");
                    $imageStatement->execute();
                    $wasDeleted = $imageStatement->fetch();

                    $imageStatement = $pdo->prepare("DELETE FROM users WHERE user_name ='$userName'");
                    $imageStatement->execute();

                    $imageStatement = $pdo->prepare("DELETE FROM comments WHERE user_name ='$userName'");
                    $imageStatement->execute();

                    if ($wasDeleted == 1) {
                        echo "user $userName wurde erfolgreich gelöscht";
                    } else {
                        echo "user $userName existiert nicht";
                    }
                }

                if (isset($_POST['showEmails'])) {
                    header("Location: showEmails.php");
                    die();
                }
            } else {
                header("Location: login.php");
                die();
            }

            if ($show_form) {
            ?>
                <div id="page-content">
                    <div id="grid-item">

                        <?php
                        echo "<font size='+4'><b>$name</b> </font>";
                        ?>

                        <br><br>
                    </div>


                    <div id="grid-item">
                        <form action="?submit=1" method="post">
                            <input type="submit" class='delete' value="Profil löschen" name="delete">
                        </form>
                        <br><br>
                    </div>

                    <div id="grid-item">
                        <?php
                        echo "Bilder hochgeladen: $countPosts[0]<br><br>";
                        echo "Erstellte Kommentare: $countCommentsMade[0]<br><br>";
                        echo "Kommentare zu Bildern erhalten: $countCommentsGot[0]";
                        ?>
                    </div>

                    <div id="grid-item">
                        <?php

                        echo "User Name: $userRow[0]<br><br>";
                        echo "Email: $userRow[2]";

                        ?>
                    </div>

                    <?php

                    if ($userRow['isAdmin'] == 1) {
                        echo "<div id='grid-item'>";
                        echo "<br><br><br>";
                        echo "<font size='+2'><b>Admin Panel</b> </font> <br><br>";

                    ?>
                        <form action="?submit=1" method="post">
                            <input type="submit" class='deleteUser' value="Email-Addressen anzeigen" name="showEmails">
                        </form>

                </div>
                <div id="grid-item">
                    <br><br><br><br><br>
                    <form action="?submit=1" method="post">
                        <input type="text" name="text" value="User Name eingeben">
                        <input type="submit" class='deleteUser' value="Profil löschen" name="deleteUser">
                    </form>
                </div>

            <?php
                    }
            ?>

        </div>

    </div>

<?php
            }
            include('footer.php');
?>

<!-- Scripts -->
<script src="./assets/js/sideNav.js"></script>

</body>

</html>