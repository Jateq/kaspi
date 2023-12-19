<?php
include '../connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Perform validation (add more validation as needed)
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        // Handle validation error
        header("location: ../path_to_change_password_page_with_error");
        exit;
    }

    // Retrieve the user from the database based on the current session
    $phone = $_SESSION['phone'];
    $query = "SELECT * FROM users WHERE phone = '$phone'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the current password
        if (password_verify($currentPassword, $user['password'])) {
            if ($newPassword === $confirmPassword) {
                // Update the password in the database
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE users SET password = '$hashedPassword' WHERE phone = '$phone'";
                mysqli_query($conn, $updateQuery);

                // Redirect to a success page or any other desired action
                header("location: user.php?state=successfully");
                exit;
            } else {
                header("location: user.php?error=mismatch");
                exit;
            }
        } else {
            // Handle incorrect current password error
            header("location: user.php?error=incorrect");
            exit;
        }
    } else {
        // Handle user not found error
        header("location: user.php?error=user_not_found");
        exit;
    }
} else {
    // Handle invalid request error
    header("location: user.php?error=invalid");
    exit;
}
?>
<?php
