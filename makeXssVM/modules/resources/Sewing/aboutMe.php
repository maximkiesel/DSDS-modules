<?php
session_start();
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
            <h1>MySewingXP - Über mich </h1>
        </div>
        <?php
        include('sidenav.php');
        ?>
        <div class="page-content">
            <img src="images/überMich/me2.jpg" class="pics">
            <p class="p2">
                Hallo meine lieben Nähfreunde.
                Ich bin Frieda und eine Mädelsmama durch und durch.
                Meine beiden Wunschkinder sind Sommerkinder: 2017 und 2020 geboren.
            </p>
            <img src="images/überMich/fridolin.jpg" class="pics2">
            <p class="p2">
                Durch meine Arbeit als Pädagogin habe ich in einer Wohngruppe das Häkeln für mich entdeckt.
                Dann entstanden viele Stofftiere und Puppen. Die Plüschtiere habe ich schon immer gerne aus alten Kindersachen mit der Hand zusammen genäht.
                Zum nähen kam ich durch eine Freundin mit alter Nähmaschine im Herbst 2017.
                Auch wenn nur noch der Grad-Stich funktioniert hat, ich war sofort begeistert wie schnell es ging und wie schnell einfache Sachen entstehen.
                Nach zwei weiteren Besuchen stand fest, ich brauche eine Nähmaschine.
                Gesagt getan...erstmal eine gebrauchte über Ebay-Kleinanzeigen.
            </p>
            <div id="picAboutme">
                <img src="images/überMich/me3.jpg" class="pics3">
            </div>

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
