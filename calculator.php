<?php
require 'config.php';

//get the user's name, if not logged in redirect to login.php
if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $res = $conn->query("SELECT * FROM user_tb WHERE id='$id'");
    $row = $res->fetch_assoc();
    $name = $row["name"];
} else {
    header("Location: login.php");
}

$diameter_err = "";
$diameter = $volume = 0;
$saved_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diameter = $_POST["diameter"];
    if (is_numeric($diameter)) {
        $radius = $diameter / 2.0;
        $pi = 3.14;
        $volume = round(4 / 3 * $pi * ($radius ** 3), 5);
    } else {
        $diameter_err = "Invalid input";
    }
    if (isset($_POST['save'])) {
        $stmt = $conn->prepare('UPDATE user_tb SET sphere_volume = ? WHERE id = ?');
        $stmt->bind_param("di", $volume, $_SESSION['id']);
        $stmt->execute();

        $saved_message = "Volume saved!";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sphere Volume Calculator</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/calculator-style.css">
    <link rel="stylesheet" href="css/registration-style.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <h1 class="greeting">Welcome, <span><?php echo $name ?></span></h1>
            <span><a href="logout.php">Log out</a></span>
            <span><a href="home.php">Home</a></span>
        </header>
        <main>
            <div class="main-content-wrapper">
                <h2>Sphere Volume Calulator</h2>
                <div class="calculator">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="form-1">
                        <article>
                            <label>Enter diameter:</label><span class="error"><?php echo $diameter_err ?></span>
                            <input type="text" name="diameter" value="<?php echo $diameter ?>"><span>(m)</span>
                        </article>
                        <article>
                            <input class="btn" type="submit" name="calculate" value="Calculate">
                        </article>
                        <article>
                            <input class="btn" type="submit" name="save" value="Save">
                        </article>
                        <article><span><?php echo $saved_message ?></span></article>

                    </form>
                </div>
                <div class="calculator-result">
                    <?php echo "Volume = " . $volume ?><span>(m<sup>3</sup>)</span>
                </div>
            </div>
        </main>
        <footer>

        </footer>
    </div>
</body>

</html>