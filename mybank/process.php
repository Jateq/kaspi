<?php
include '../user.php';

 session_start();
 if (!isset($_SESSION["login"])) {
     header("location:../auth/login.html");
     exit();
 }
global $conn;

function getUserCardNumberByPhone($phone){
    $user = getUserByPhone($_SESSION['phone']);
    return $user['card_number'];
}

?>