<?php
// Include the connection file
include 'connect.php';

function getAllUsers() {
    global $conn; // Assuming $conn is your mysqli connection variable

    try {
        // SQL query to select all values from the users table
        $sql = "SELECT * FROM users";

        // Execute the query
        $result = $conn->query($sql);

        // Fetch all rows as associative arrays
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        // Return the result
        return $users;
    } catch (Exception $e) {
        // Handle database connection errors
        echo "Connection failed: " . $e->getMessage();
    }
}


function getUserByPhone($phone)
{
    global $conn; // Assuming $conn is your mysqli connection variable

    try {
        // SQL query to select a user based on phone number
        $sql = "SELECT * FROM users WHERE phone = ?";

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $phone);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the user as an associative array
        $user = $result->fetch_assoc();

        // Return the result
        return $user;
    } catch (Exception $e) {
        // Handle database connection errors
        echo "Connection failed: " . $e->getMessage();
    }
}



