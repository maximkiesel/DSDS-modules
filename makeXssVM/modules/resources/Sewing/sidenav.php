<?php
echo '<div id="myNav" class="overlay">

            <!-- Button to close the overlay navigation -->
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

            <!-- Overlay content -->
            <div class="overlay-content">
                <ul class="links">';

            if (!isset($_SESSION['userid'])) {
                echo "<a id='login'><a href='login.php'>Login</a>";
            } else {
                $userid = $_SESSION['userid'];
                echo "<a id='profile'><a href='profile.php'>Profile</a>";
                echo "<a>Benutzer: " . "$userid" . "</a>";
                echo "<a id='logout'><a href='logout.php'>Logout</a>";
            }
            ?>
<a href="index.php">Startseite</a>
<a href="aboutMe.php">Über mich</a>
<a href="einzelstuecke.php">Einzelstücke</a>
<a href="upload.php">Upload</a>
<a href="impressum.php">Impressum</a>
</ul>
</div>
</div>
<!-- Use any element to open/show the overlay navigation menu -->
<div id="sideNavButton">
    <button id="ButtonMenu" onclick="openNav()">Menü <i class="fas fa-bars"></i></button>
</div>
