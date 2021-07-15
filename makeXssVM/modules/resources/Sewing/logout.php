<?php
session_start();
session_destroy();
?>
<html>
    <head>
        <title>Sewing</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />


        <link rel="stylesheet" href="assets/css/index.css" />
        <link rel="stylesheet" href="assets/css/footer.css" />
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
                    <h1>MySewingXP -Logout</h1>
                </div>
                <div class="page-content">
                    <?php
                    echo "Logout erfolgreich! Zurück zur <a href='index.php'>Startseite.</a>";
                    ?>
                </div>
            </div>

        </div>
        <?php
        include('footer.php');
        ?>
        <!-- Scripts -->
        <script src="./assets/js/sideNav.js"></script>

    </body>
</html>

