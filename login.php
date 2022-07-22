<?php
require 'config.php';
$usernameoremail = "";

if (!empty($_SESSION["id"])) {
    header("Location: calculator.php");
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usernameoremail = $_POST["usernameoremail"];
        echo $usernameoremail;
        $password = $_POST["password"];

        if (!empty($usernameoremail)) {
            $stmt = $conn->prepare("SELECT * FROM user_tb WHERE (username = ? OR email = ?)");
            //specify type of each variable in the "" 3s - 3 vars of string type
            $stmt->bind_param("ss", $usernameoremail, $usernameoremail);
            $stmt->execute();

            $result = $stmt->get_result();

            $row = $result->fetch_assoc();

            if ($result->num_rows > 0) {
                if ($row['password'] == $password) {
                    $_SESSION["id"] = $row["id"];

                    header("Location: calculator.php");
                } else {
                    echo "Password incorrect";
                }
            } else {
                echo "User not registered";
            }
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
    <title>Log in</title>
    <link rel="stylesheet" href="css/general.css">
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <article>
            <label>Username or Email: <input type="text" name="usernameoremail" required value="<?php echo $usernameoremail ?>"></label>
        </article>
        <article>
            <label><input type="password" name="password" required></label>
        </article>
        <input type="submit" value="Log in">
    </form>
    <a href="register.php">Register instead</a>
    <a href="home.php"></a>
</body>

</html>