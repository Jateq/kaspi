<?php


include '../connect.php';

function transfer($senderId, $amount, $type)
{
    global $conn;

    try {
        $sqlSender = "UPDATE users SET amount_money = amount_money -  ? WHERE phone = ?";
        $stmtSender = $conn->prepare($sqlSender);
        $stmtSender->bind_param("di", $amount, $senderId);
        $stmtSender->execute();
        recordTransaction("+".trim($senderId), 'platej', $type , $amount);

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
if($curAmount < $amount){
    echo json_encode('Недостаточно средств');
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
