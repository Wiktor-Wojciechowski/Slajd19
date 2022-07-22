<?php
require 'config.php';

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $res = $conn->query("SELECT * FROM user_tb WHERE id='$id'");
    $row = $res->fetch_assoc();
    $name = $row["name"];
} else {
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>Welcome, <?php echo $name ?> </h1>
        <a href="logout.php">Log out</a>
    </header>
    <main>
        <div class="calculator"></div>
        <div class="calculator-result"></div>
    </main>
    <footer>

    </footer>

</body>

</html>