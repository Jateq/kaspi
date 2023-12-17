<?php

include '../user.php';


function transferMoneyFromCard($senderId, $amount, $cardNumber)
{
    global $conn;

    try {
        // Update sender's amount
        $sqlSender = "UPDATE users SET amount_money = amount_money - ? WHERE phone = ?";
        $stmtSender = $conn->prepare($sqlSender);
        $stmtSender->bind_param("di", $amount, $senderId);
        $stmtSender->execute();
        recordTransaction( "+".trim($senderId), 'perevod', 'перевод на карту каспи ' . $cardNumber, $amount);

        // Update receiver's amount
        $sqlReceiver = "UPDATE users SET amount_money = amount_money + ? WHERE card_number = ?";
        $stmtReceiver = $conn->prepare($sqlReceiver);
        $stmtReceiver->bind_param("ds", $amount, $cardNumber);
        $stmtReceiver->execute();
        $tempUser = getUserByCard($cardNumber);
        recordTransaction($tempUser['phone'], 'perevod', 'перевод от ' . "+".trim($senderId), $amount);


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
$cardNumber = $_POST['cardNumber'];


$curAmount = getCurrentAmount($senderId);
if($curAmount < $amount){
    echo json_encode('Недостаточно средств');
    return;
}



// Call the transfer function
$result = transferMoneyFromCard($senderId, $amount, $cardNumber);



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
