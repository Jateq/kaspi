<?php
session_start();
if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
    include "../connect.php";

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 2525000) {
            $em = "Sorry, your file is too large.";
            header("Location: user.php?error=$em");
            exit();
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png", "HEIC", "webp");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $phone = $_SESSION['phone'];
                $new_img_name = $phone . '.' . $img_ex_lc;
                $img_upload_path = 'users/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $updateSql = "UPDATE users SET user_image = '$new_img_name' WHERE phone = '$phone'";
                mysqli_query($conn, $updateSql);
                header("Location:user.php");
                exit();
            } else {
                $em = "You can't upload files of this type";
                header("Location: user.php?error=$em");
                exit();
            }
        }
    } else {
        $em = "Unknown error occurred!";
        header("Location: user.php?error=$em");
        exit();
    }

} else {
    header("Location: user.php");
    exit();
}
