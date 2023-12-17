<?php


include '../connect.php';

function transferMoneyFromCardtf($senderId, $amount, $cardNumber)
{
    global $conn;

    try {
        $sqlSender = "UPDATE users SET amount_money = amount_money - 250.0 - ? WHERE phone = ?";
        $stmtSender = $conn->prepare($sqlSender);
        $stmtSender->bind_param("di", $amount, $senderId);
        $stmtSender->execute();
        recordTransaction("+".trim($senderId), 'perevod', 'перевод на карту другого банка ' . $cardNumber, $amount);

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
function isLuhnValid($number)
{
    $sum = 0;
    $numDigits = strlen($number);
    $parity = $numDigits % 2;

    for ($i = $numDigits - 1; $i >= 0; $i--) {
        $digit = (int)$number[$i];
        if ($i % 2 == $parity) {
            $digit *= 2;
            if ($digit > 9) {
                $digit -= 9;
            }
        }
        $sum += $digit;
    }

    return $sum % 10 == 0;
}

if (!isLuhnValid($cardNumber)) {
    echo json_encode('Такой карты не существует');
    return;
}

// Call the transfer function
$result = transferMoneyFromCardtf($senderId, $amount, $cardNumber);


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
