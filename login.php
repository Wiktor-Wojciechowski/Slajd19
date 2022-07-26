<?php
require 'config.php';
$usernameoremail = "";
$login_err = $pass_err = "";

if (!empty($_SESSION["id"])) {
    header("Location: calculator.php");
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usernameoremail = $_POST["usernameoremail"];
        $password = $_POST["password"];

        if (!empty($usernameoremail)) {
            $stmt = $conn->prepare("SELECT * FROM user_tb WHERE (username = ? OR email = ?)");
            //specify type of each variable in the "" 3s - 3 vars of string type
            $stmt->bind_param("ss", $usernameoremail, $usernameoremail);
            $stmt->execute();

            $result = $stmt->get_result();

            $row = $result->fetch_assoc();

            if ($result->num_rows > 0) {

                if (password_verify($password, $row['password'])) {
                    $_SESSION["id"] = $row["id"];

                    echo
                    "<script defer>
                        alert('Logged in succesfully!');
                        window.location.href = 'calculator.php';
                    </script>";
                } else {
                    $pass_err = "Password Incorrect";
                }
            } else {
                $login_err = "User not registered";
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
    <link rel="stylesheet" href="css/registration-style.css">
</head>

<body>
    <div class="main">
        <div class="main-content-wrapper">
            <h1>Log in</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <article>
                    <label>Username or Email:</label><span class="error"><?php echo $login_err ?></span>
                    <input type="text" name="usernameoremail" required value="<?php echo $usernameoremail ?>">
                </article>
                <article>
                    <label>Password:</label><span class="error"><?php echo $pass_err ?></span>
                    <input type="password" name="password" required>
                </article>
                <input class="btn" type="submit" value="Log in">
            </form>
            <a href="register.php">Register instead</a>
            <a href="index.php">Home</a>
        </div>
        </main>
</body>

</html>