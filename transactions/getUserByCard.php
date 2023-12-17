<?php
// Include your database connection file
include '../user.php';


session_start();
if (!isset($_SESSION["login"])) {
    header("location:../auth/login.html");
    exit();
}


$card = $_GET['card'];

$sessionUser = getUserByPhone($_SESSION['phone']);
$user = getUserByCard($card);


if( $user == $sessionUser){
    echo json_encode('error');
    return;
}

// Check if the phone number is not empty
if (!empty($user)) {
    // Output the user details as JSON
    echo json_encode($user);
}
?>