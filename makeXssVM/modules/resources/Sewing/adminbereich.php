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
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/5046510dfa.js" crossorigin="anonymous"></script>
</head>
<body class="is-preload">
<!-- Page Wrapper -->
<div id="page-wrapper">
    <div id="overlay">
        <div id="headline">
            <h1>MySewingXP - AdminBereich</h1>
        </div>
        <?php
        include('sidenav.php');
        ?>
        <div class="page-content">
            <?php
            $sql = "SELECT * FROM users";
            foreach ($pdo->query($sql) as $row) {
                echo "Name: " . $row['user_name'] . " Review: " . $row['password'] ." Email: ". $row['email'] ."<br />";
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

