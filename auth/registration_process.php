<?php

include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $name = htmlspecialchars($name);
    $surname = htmlspecialchars($surname);
    $phone = str_replace(' ', '', $phone);
    if (!preg_match('/^\+77\d{9}$/', $phone)) {
        include 'registration.html';
        $error_message = "Invalid phone number format. Please use the format +77xxxxxxxxx.";
        exit;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);


    // Insert the user into the database
    $query = "INSERT INTO users (name, surname, phone, password) VALUES ('$name', '$surname', '$phone', '$password')";

    // Execute the query (you should use prepared statements to prevent SQL injection)
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION["login"]="1";
        $_SESSION['phone'] = $phone;
        header("location:../main/index1.html");
    } else {
        include 'registration.html';
        $error_message = "Incorrect password. Please try again.";
    }
}


echo "<script>document.getElementById('error').innerHTML = '<p class=\"auth-error\">$error_message</p>';</script>";
