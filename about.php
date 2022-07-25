<?php
require 'config.php';
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/registration-style.css">
    <link rel="stylesheet" href="css/about-style.css">
</head>

<body>
    <div class="main">
        <div class="main-content-wrapper">
            <section>
                <h1>About</h1>
                <h3>Sphere Volume Calculator</h3>
            </section>
            <section>
                <p>This Sphere Volume Calculator allows you to
                    calculate and save the volume of a sphere of
                    a given diameter</p>
            </section>
            <section>

            </section>
        </div>
    </div>
</body>

</html>