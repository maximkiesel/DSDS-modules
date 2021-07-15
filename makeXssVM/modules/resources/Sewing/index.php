<?php
session_start();
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
                    <h1>MySewingXP</h1>
                </div>
                <?php
                include('sidenav.php');
                ?>
                <div class="page-content">
                    <p class="p1" >Willkommen auf MySewingXP!</p> <br>
                    <p class="p2">Dies ist ein Platz um sich über das Nähen auszutauschen.
                        Ihr werdet hier verschiedene Schnittmuster finden mit denen ich bereits gearbeitet habe.
                        Ich bin schon ganz gespannt auf eure Meinungen und Erfahrungen.
                    </p> <br>
                    <p class="p2">
                        Wer ich bin? Das erfahrt ihr gleich <a href="aboutMe.php">hier</a>, oder ihr wuselt euch durch die Seite mit Hilfe des Menüs oben Links.
                    </p>
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

<?php
