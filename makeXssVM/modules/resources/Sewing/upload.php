<?php
session_start();
const DB_USER = 'sewing_site';
const DB_PASSWORD = 'HusiSQILe';
define('SITE_ROOT', realpath(dirname(__FILE__)));
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
        <div id="overlay">
            <div id="headline">
                <h1>MySewingXP - Upload</h1>
            </div>
            <?php
            include('sidenav.php');
            ?>
            <div class="page-content">

                <?php
                if (!is_null($error)) { //Ein Fehler ist aufgetreten
                    echo $error;
                }

                //Ausgabe des Formulars nur wenn $showForm == true ist
                if ($show_form) :
                ?>
                    <form action="?submit=1" method="post" enctype="multipart/form-data">
                        Enter title:<br>
                        <input type="text" name="tileOfFile" id="tileOfFile"><br><br>
                        Select image to upload:<br>
                        <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
                        <input type="submit" value="Upload Image" name="submit">
                    </form>
                <?php
                else :
                    echo "Du musst eingelogt sein um ein Bild hochladen zu können klicke hier <a href=\"login.php\">Login</a>";
                endif;

                if (isset($_GET['submit'])) {

                    $file_type = $_FILES['fileToUpload']['type'];
                    $allowed = array("image/jpeg", "image/png");

                    if (!in_array($file_type, $allowed)) {
                        echo "only jpeg and png are allowed";
                    } else {

                        $username = $_SESSION['userid'];
                        $title = trim($_POST['tileOfFile']);
                        $imageName = $_FILES['fileToUpload']['tmp_name'];
                        $path = "/images/uploads/";
                        $fi = new FilesystemIterator(SITE_ROOT . $path, FilesystemIterator::SKIP_DOTS);
                        $elemntCount = iterator_count($fi) + 1;
                        $fileName = $_SESSION['userid'] . $elemntCount . '.jpg';
                        $fullPath = SITE_ROOT . $path . $fileName;
                        $savePath = "images/uploads/$fileName";

                        $uploaded = move_uploaded_file($imageName, $fullPath);

                        echo "<div class='pic-container'> image uploaded";
                        echo "<img src='images/uploads/$fileName' alt='$path$fileName'> </div>";

                        if ($uploaded) {
                            $imageStatement = $pdo->prepare("INSERT INTO pictures (path,user_name,title) VALUES(:savePath,:username,:title)");
                            $imageStatement->execute(array('savePath' => $savePath, 'username' => $username, 'title' => $title));
                        } else {
                            echo "Upload failed!";
                        }
                    }
                }
                ?>
            </div>
        </div>
        <?php
        include('footer.php');
        ?>
    </div>


    <!-- Scripts -->
    <script src="./assets/js/sideNav.js"></script>

</body>

</html>