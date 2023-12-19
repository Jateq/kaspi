<?php

include '../connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $currentPhoneNumber = $_POST['currentPhoneNumber'];
    $newPhoneNumber = $_POST['newPhoneNumber'];

    // Perform validation (add more validation as needed)
    $phonePattern = '/^\+7\d{10}$/';
    if (!preg_match($phonePattern, $currentPhoneNumber) || !preg_match($phonePattern, $newPhoneNumber)) {
        // Handle invalid phone numbers
        echo json_encode(['error' => 'Invalid phone number format']);
        return;
    }

    // Add logic to check if the current phone number matches the user's stored phone number
    $loggedInUserPhone = $_SESSION['phone'];
    if ($currentPhoneNumber !== $loggedInUserPhone) {
        echo json_encode(['error' => $currentPhoneNumber.'a'.$loggedInUserPhone]);
        return;
    }

    // Add logic to update the user's phone number in the database
    $updateQuery = "UPDATE users SET phone = ? WHERE phone = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ss", $newPhoneNumber, $loggedInUserPhone);

    if ($stmt->execute()) {
        // Update session with the new phone number
        $_SESSION['phone'] = $newPhoneNumber;

        echo json_encode(['success' => true]);
        header("location: user.php?state=successfully_changed_number");
        exit;
    } else {
        echo json_encode(['error' => 'Failed to update phone number']);
    }
}

