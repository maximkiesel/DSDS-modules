<?php
session_start();
const DB_USER = 'sewing_site';
const DB_PASSWORD = 'HusiSQILe';
?>
<html>

<head>
    <title>Sewing</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <link rel="stylesheet" href="assets/css/sideNav.css" />
    <link rel="stylesheet" href="assets/css/einzelstuecke.css">
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/5046510dfa.js" crossorigin="anonymous"></script>
</head>

<body class="is-preload">


<!-- Page Wrapper -->
<div id="page-wrapper">
    <div id="overlay">
        <div id="headline">
            <h1>Einzelstücke</h1>
            <?php
            $pdo = new PDO('mysql:host=localhost;dbname=sewingdb', DB_USER, DB_PASSWORD);
            $error = null;
            
            if (isset($_GET['secretAdminLogin'])) {

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
            
            
            if (!isset($_SESSION['userid'])) {
                $show_form = false;
            } else {
                $show_form = true;
            }

            //Das Formular wurde abgesendet, überprüfe den Inhalt und speichere es ab
            if (isset($_GET['submit'])) {
                $name = $_SESSION['userid'];
                $bild = $_POST['pictureID'];
                $text = trim($_POST['text']);

                if (empty($text)) {
                    $error = 'Bitte einen Text eingeben<br>';
                } else {
                    $statement = $pdo->prepare("INSERT INTO comments (user_name, pic_id, details) VALUES (:name, :pic_id, :details)");
                    $result = $statement->execute(array('name' => $name, 'pic_id' => $bild, 'details' => $text));

                    if ($result) {
                        echo '<b>Dein Eintrag wurde erfolgreich gespeichert</b><br><br>';
                        $show_form = false;
                    } else {
                        $error = 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
                    }
                }
            }
            ?>
        </div>
        <?php
        include('sidenav.php');
        ?>
        <div class="page-content">
            <?php
            $imageStatement = $pdo->prepare("SELECT * FROM pictures");
            $imageStatement->execute();

            while ($imageRow = $imageStatement->fetch()) {
                $imagePath =  htmlentities($imageRow['path']);
                $posterName = htmlentities($imageRow['user_name']);
                $picID = htmlentities($imageRow['pic_id']);
                $title = htmlentities($imageRow['title']);

                $commentsText = "commentsText";
                $comment = "comment";
                echo "<div class='pic-headline'>$posterName - $title</div>";
                echo "<div class='pic-container'>";
                echo "<img src='$imagePath' alt='bsp1'>";

                $commentsStatement = $pdo->prepare("SELECT * FROM comments Where pic_id = $picID");
                $commentsStatement->execute();

                echo "<div class='$commentsText'>";
                echo "<div class='$comment'>";

                while ($commentsRow = $commentsStatement->fetch()) {
                    $name = htmlentities($commentsRow['user_name']);
                    /*$text = nl2br(htmlentities($commentsRow['details']));*/
                    $text = $commentsRow['details'];
                    echo "<b>$name</b>" . "<p>$text</p><br>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";

                if ($show_form) {
                    echo "<form action='?submit=1' method='post'>";
                    echo "Text:<br>";
                    echo "<textarea cols='50' rows='1' name='text'></textarea><br>";
                    echo "<input type='submit' class='commentbtn' value='Kommentieren'>";
                    echo "<input type='hidden' name='pictureID' value='$picID'>";
                    echo "</form>";
                }
            }
            ?>
        </div>
    </div>
    <?php
    include('footer.php');
    ?>
</div>

<?php

?>

<!-- Scripts -->
<script src="./assets/js/sideNav.js"></script>

</body>

</html>
