<?php
include '../connect.php'; // users.Assuming you have a filusers.e for database connection

function transferMoney($senderId, $receiverId, $amount)
{
    global $conn;

    try {
        // Update sender's amount
        $sqlSender = "UPDATE users SET amount_money = amount_money - ? WHERE phone = ?";
        $stmtSender = $conn->prepare($sqlSender);
        $stmtSender->bind_param("di", $amount, $senderId);
        $stmtSender->execute();

        // Update receiver's amount
        $sqlReceiver = "UPDATE users SET amount_money = amount_money + ? WHERE phone = ?";
        $stmtReceiver = $conn->prepare($sqlReceiver);
        $stmtReceiver->bind_param("di", $amount, $receiverId);
        $stmtReceiver->execute();

        // Return success
        return true;
    } catch (Exception $e) {
        // Handle database connection errors
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
}

// Get the user details from the POST request
$senderId = $_POST['senderId'];
$receiverId = $_POST['receiverId'];
$amount = $_POST['amount'];

// Call the transfer function
$result = transferMoney($senderId, $receiverId, $amount);

// Send the result back as JSON
echo json_encode(['success' => $result]);

