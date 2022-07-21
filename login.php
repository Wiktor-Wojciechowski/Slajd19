<?php
require 'config.php';

use function mysqli_real_escape_string as mres;

if (!empty($_SESSION["id"])) {
    header("Location: calculator.php");
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usernameoremail = $_POST["usernameoremail"];
        $password = $_POST["password"];

        $result = $conn->query(sprintf(
            "SELECT * FROM user_tb WHERE (username = '%s' OR email = '%s') AND password = '%s'",
            mres($conn, $usernameoremail),
            mres($conn, $usernameoremail),
            mres($conn, $password)
        ));
        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            $_SESSION["id"] = $row["id"];
            $_SESSION["logged-in"] = true;
            header("Location: calculator.php");
        } else {
            echo "User not registered";
        }
    }
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <label>Username or Email: <input type="text" name="usernameoremail"></label>
        <label><input type="password" name="password"></label>
        <input type="submit" value="Log in">
    </form>
    <a href="register.php">Register instead</a>
    <a href="home.php"></a>
</body>

</html>