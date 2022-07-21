<?php
require 'config.php';
$_SESSION = [];
session_unset();
session_destroy();

echo
"<script>
    window.addEventListener('load', function() {
        alert('You have been logged out');
    });
</script>";

header("location: login.php");
