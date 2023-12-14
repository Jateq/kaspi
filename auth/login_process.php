<?php
include '../connect.php';
session_start ();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $phone = htmlspecialchars($phone);
    $phone = str_replace(' ', '', $phone);
    $phone = str_replace(' ', '', $phone);
    if (!preg_match('/^\+77\d{9}$/', $phone)) {
        include 'login.html';
        $error_message = "Напишите номер в формате +77xxxxxxxxx.";
    }

    $query = "SELECT * FROM users WHERE phone = '$phone'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION["login"]="1";
            $_SESSION['phone'] = $phone;
            header("location:../main/index1.html");
        } else {
            include 'login.html';
            $error_message = "Неправильный пароль.";
        }
    } else {
        include 'login.html';
        $error_message = "Такого пользователя не существует.";
    }

}

echo "<script>document.getElementById('error').innerHTML = '<p class=\"auth-error\">$error_message</p>';</script>";
