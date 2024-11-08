<?php
header("Content-Type: application/json"); // Set JSON response type

// Include the database connection class
include_once '../connection.php';

try {

    // Decode the JSON data received from the client
    $data = json_decode(file_get_contents("php://input"));

    // Check for required fields
    if (isset($data->email, $data->password)) {
        // Create a new database connection instance
        $dbConnection = new DatabaseConnection();
        $conn = $dbConnection->getConnection();

        // Sanitize and prepare the data    
        $email = $conn->real_escape_string($data->email);
        $password = $conn->real_escape_string($data->password);

        // Query the database
        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                echo json_encode(["status" => 200, "message" => "Login successful"]);
            } else {
                echo json_encode(["status" => 401, "message" => "Invalid Password"]);
            }
        } else {
            echo json_encode(["status" => 404, "message" => "User not found"]);
        }

        // Close the connection
        $conn->close();

    } else {
        echo json_encode(["status" => 400, "message" => "Invalid input. Required fields are missing."]);
    }

} catch (Exception $e) {
    echo json_encode([
        "status" => 500,
        "message" => "Server error: "
            . $e->getMessage()
    ]);
}