<?php
require 'config.php';
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/registration-style.css">
    <link rel="stylesheet" href="css/about-style.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="header-wrapper">
                <h1>About</h1>
                <ul>
                    <li><a href="index.php"><img src="images/home.svg" alt="Home" title="Home"></a></li>
                    <li><a href="calculator.php"><img src="images/calculator.png" alt="Calculator" title="Calculator"></a></li>
                    <li><a href="logout.php"><img src="images/logout.png" alt="Log Out" title="Log Out"></a></li>
                </ul>
            </div>
        </header>
        <div class="main">
            <div class="main-content-wrapper">
                <section>

                    <h3>Sphere Volume Calculator</h3>
                </section>
                <section>
                    <p>This Sphere Volume Calculator allows you to
                        calculate and save the volume of a sphere of
                        a given diameter
                    </p>
                </section>
                <hr>
                <section>
                    <p>"Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt
                        ut labore et dolore magna aliqua. Ut
                        enim ad minim veniam, quis nostrud exercitation
                        ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                        eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                        qui officia deserunt mollit anim id est laborum."
                    </p>
                </section>
            </div>
        </div>
    </div>
</body>

</html>