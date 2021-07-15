<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<body>
    <?php
    session_start();
    define('DB_USER', 'sewing_site');
    define('DB_PASSWORD', 'HusiSQILe');

    if (isset($_SESSION['userid'])) {
        $pdo = new PDO('mysql:host=localhost;dbname=sewingdb', DB_USER, DB_PASSWORD);

        $name = $_SESSION['userid'];
        $Statement = $pdo->prepare("SELECT * FROM users WHERE user_name ='$name'");
        $Statement->execute();
        $userRow = $Statement->fetch();

        if ($userRow['isAdmin'] == 1) {
            echo "All Namen und Emails der User:<br><br>";
            $sql = "SELECT * FROM users";
            foreach ($pdo->query($sql) as $row) {
                echo "Name: " . $row['user_name'] . "<br>" . " Email: " . $row['email'] . "<br><br>";
            }
        }
    }
    ?>
</body>

</html>