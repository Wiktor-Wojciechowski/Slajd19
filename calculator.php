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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['input-result']) and is_numeric($_POST['input-result'])) {
        $result = $_POST['input-result'];

        $stmt = $conn->prepare('UPDATE user_tb SET sphere_volume = ? WHERE id = ?');
        $stmt->bind_param("di", $result, $_SESSION['id']);
        $stmt->execute();

        $saved_message = "<span class='saved-msg'>Volume saved!</span>";
    } else {
        $diameter_err = "Invalid input";
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
    <link rel="stylesheet" href="css/registration-style.css">
    <link rel="stylesheet" href="css/calculator-style.css">

</head>

<body>
    <div class="wrapper">
        <header>
            <h1 class="greeting">Welcome, <span><?php echo $name ?></span></h1>
            <div class="links">
                <span><a href="home.php"><img src="images/home.svg" title="Home" alt="Home"></a></span>
                <span><a href="calculator.php"><img src="images/calculator.png" title="Calculator" alt="Calculator"></a></span>
                <span><a href="logout.php"><img src="images/logout.png" title="Log Out" alt="Log Out"></a></span>

            </div>
        </header>
        <div class="main">
            <div class="main-content-wrapper">
                <h2>Sphere Volume Calculator</h2>
                <div class="calculator">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="form-1">
                        <article>
                            <label>Enter diameter:</label><span class="error"><?php echo $diameter_err ?></span>
                            <input id="diameter-input" type="text" name="diameter" autocomplete="off" value="<?php echo $diameter ?>"><span>(m)</span>
                        </article>
                        <article>
                            <input id="calc-btn" class="btn" type="submit" name="calculate" value="Calculate">
                        </article>
                        <div class="calculator-result">
                            <span>Volume = </span><?php echo "<span class='result'>" . $volume . "</span>" ?><span>(m<sup>3</sup>)</span>
                        </div>
                        <article>
                            <input class="btn" type="submit" name="save" value="Save">
                        </article>
                        <article>
                            <input class="input-result" type="hidden" value="0" name="input-result">
                        </article>
                        <article><span><?php echo $saved_message ?></span></article>

                    </form>

                </div>

            </div>
            </main>
        </div>
</body>
<script src="js/calculator.js" defer>
</script>

</html>