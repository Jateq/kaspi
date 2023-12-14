<?php

session_start ();
if(!isset($_SESSION["login"])) {
    header("location:../auth/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>kaspi</title>
</head>
<body>
<a href="logout.php">logout</a>
</body>
</html>