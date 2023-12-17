<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "kaspi";

$conn = mysqli_connect($servername, $username, $password, $database);



if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}





function recordTransaction($phone, $type, $name, $amount)
{
    global $conn;

    try {
        $sql = "INSERT INTO transaction_history (phone_number, transaction_type, name, amount) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssd", $phone, $type, $name, $amount);
        $stmt->execute();
    } catch (Exception $e) {
        // Handle database connection errors or transaction recording errors
        echo "Transaction recording failed: " . $e->getMessage();
    }
}

function getTransactionHistory($phone, $transactionType = null)
{
    global $conn;

    try {
        $sql = "SELECT phone_number, transaction_type, name, amount, created_at
                FROM transaction_history
                WHERE phone_number = ?
                " . ($transactionType ? "AND transaction_type = ?" : "") . "
                ORDER BY created_at DESC";

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare($sql);

        if ($transactionType) {
            $stmt->bind_param("ss", $phone, $transactionType);
        } else {
            $stmt->bind_param("s", $phone);
        }

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the transactions as an associative array
        $transactions = [];
        while ($row = $result->fetch_assoc()) {
            $transactions[] = $row;
        }

        // Return the result
        return $transactions;
    } catch (Exception $e) {
        // Handle database connection errors
        echo "Connection failed: " . $e->getMessage();
    }
}

