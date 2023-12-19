<?php

include '../connect.php';

function transfer($senderId, $amount, $type)
{
    global $conn;

    try {
        // Deduct the amount from the user's amount_money
        $sqlDeduct = "UPDATE users SET amount_money = amount_money - ? WHERE phone = ?";
        $stmtDeduct = $conn->prepare($sqlDeduct);
        $stmtDeduct->bind_param("di", $amount, $senderId);
        $stmtDeduct->execute();

        recordTransaction($senderId, 'deposit', $type, $amount);

        $sqlDeposit = "UPDATE users SET deposit = deposit + ? WHERE phone = ?";
        $stmtDeposit = $conn->prepare($sqlDeposit);
        $stmtDeposit->bind_param("di", $amount, $senderId);
        $stmtDeposit->execute();

        return true;
    } catch (Exception $e) {
        // Handle database connection errors
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
}

// Get the user details from the POST request
$senderId = $_POST['senderId'];
$amount = $_POST['amount'];
$type = $_POST['type'];

$curAmount = getCurrentAmount($senderId);
if ($curAmount < $amount) {
    echo json_encode($senderId);
    return;
}

// Call the transfer function
$result = transfer($senderId, $amount, $type);

// Send the result back as JSON
echo json_encode(['success' => $result]);

function getCurrentAmount($senderId)
{
    global $conn;

    try {
        $sql = "SELECT amount_money FROM users WHERE phone = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("d", $senderId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row['amount_money'];
        } else {
            return 'error';
        }
    } catch (Exception $e) {
        // Handle database connection errors
        echo "Connection failed: " . $e->getMessage();
        return 0;
    }
}
