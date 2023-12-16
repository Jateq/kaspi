<?php
// Include your database connection file
include '../user.php';


session_start();
if (!isset($_SESSION["login"])) {
    header("location:../auth/login.html");
    exit();
}


$phone = $_GET['phone'];

if( $phone == $_SESSION['phone']){
    echo json_encode('error');
    return;
}

// Check if the phone number is not empty
if (!empty($phone)) {
    // Use your getUserByPhone function to get user details
    $user = getUserByPhone($phone);

    // Output the user details as JSON
    echo json_encode($user);
}
?>