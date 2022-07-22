<?php
//gets connection from config
require 'config.php';
//declare vars
$name_err = $username_err = $email_err = $password_err = $confirmpassword_err = "";
$name = $username = $email = $password = $confirmpassword = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") /*<-check if form was submitted*/ {



    //validate name
    if (empty($_POST["name"])) {
        $name_err = "Name is required";
    } else {
        $name = validate($_POST["name"]);
        //check if name contains only letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $name_err = "Only letters and white spaces";
        }
    }



    //validate username
    if (empty($_POST["username"])) {
        $username_err = "Username is required";
    } else {
        $username = validate($_POST["username"]);
    }



    //validate email
    if (empty($_POST["email"])) {
        $email_err = "Email is required";
    } else {
        $email = validate($_POST["email"]);
        //php email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format";
        }
    }



    //validate password
    if (empty($_POST["password"])) {
        $password_err = "Password is required";
    } else {
        $password = validate($_POST["password"]);
    }



    //validate confirm password
    if (empty($_POST["confirmpassword"])) {
        $confirmpassword_err = "Passwords need to match";
    } else {
        $confirmpassword = validate($_POST["confirmpassword"]);
    }



    //check if username taken
    $stmt = $conn->prepare("SELECT * FROM user_tb WHERE username = ?");
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $username_err = "Username taken";
    } else /* if username not taken check if email taken*/ {

        $stmt = $conn->prepare("SELECT * FROM user_tb WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $email_err = "Email taken";
        } else {

            // Validate password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);

            if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8 || strlen($password) > 50) {
                $password_err = 'Password should be between 8 and 50 characters long and should include at least one upper case letter, one number, and one special character.';
            } else {
                //check is passwords match
                if ($password !== $confirmpassword) {
                    $confirmpassword_err = "Passwords need to match";
                } else {
                    //register the user
                    $stmt = $conn->prepare("INSERT INTO user_tb(name, username, email, password) VALUES (?,?,?,?)");
                    $stmt->bind_param("ssss", $name, $username, $email, $password);
                    $stmt->execute();

                    echo "<script>alert('Registration successful!');
                            window.location = 'login.php';</script>";
                }
            }
        }
    }


    //check if email taken
}
//validate inputs
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registration-style.css">
    <link rel="stylesheet" href="css/general.css">
    <title>Register</title>
</head>

<body>
    <header>

    </header>
    <main>
        <div class="main-content-wrapper">
            <div>
                <h1>Sign up</h1>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <article>
                    <label for="name">Name:</label><input id="name" type="text" name="name" required value="<?php echo $name ?>">
                    <span class="error"><?php echo $name_err ?></span>
                </article>
                <article>
                    <label for="username">Username:</label><input id="username" type="text" name="username" required value="<?php echo $username ?>">
                    <span><?php echo $username_err ?></span>
                </article>
                <article>
                    <label>Email:</label><input type="email" name="email" required value="<?php echo $email ?>">
                    <span><?php echo $email_err ?></span>
                </article>
                <article>
                    <label>Password:</label><input type="password" name="password" required value="<?php echo $password ?>">
                    <span><?php echo $password_err ?></span>
                </article>
                <article>
                    <label>Confirm Password:</label><input type="password" name="confirmpassword" required value="<?php echo $confirmpassword ?>">
                    <span><?php echo $confirmpassword_err ?></span>
                </article>
                <input class="sign-up-btn" type="submit" value="Sign up">
            </form>
            <section>
                <a href="login.php">Login instead</a>
                <a href="home.php">Home</a>
            </section>
        </div>
    </main>


</body>

</html>