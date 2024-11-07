<?php
header("Content-Type: application/json"); // Set JSON response type

// Include the database connection class
include_once '../connection.php';
// require_once '../connection.php';

try {
    // Decode the JSON data received from the client
    $data = json_decode(file_get_contents("php://input"));

    // Check for required fields
    if (isset($data->email, $data->firstname, $data->lastname, $data->contact, $data->dob)) {
        // Create a new database connection instance
        $dbConnection = new DatabaseConnection();
        $conn = $dbConnection->getConnection();

        // Sanitize and prepare the data
        $email = $conn->real_escape_string($data->email);
        $firstname = $conn->real_escape_string($data->firstname);
        $lastname = $conn->real_escape_string($data->lastname);
        $contact = $conn->real_escape_string($data->contact);
        $address1 = $conn->real_escape_string($data->address1 ?? '');
        $address2 = $conn->real_escape_string($data->address2 ?? '');
        $address3 = $conn->real_escape_string($data->address3 ?? '');
        $dob = $conn->real_escape_string($data->dob);
        $status = 1;

        // Insert data into the database
        $sql = "INSERT INTO users (email, fname, lname, contactNo, addressLine01, addressLine02, addressLine03, dob, `status`) 
                VALUES ('$email', '$firstname', '$lastname', '$contact', '$address1', '$address2', '$address3', '$dob', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["status" => 200, "message" => "Registration successful"]);
        } else {
            echo json_encode(["status" => 500, "message" => "Error: " . $conn->error]);
        }

        // Close the connection
        $conn->close();
    } else {
        echo json_encode(["status" => 400, "message" => "Invalid input. Required fields are missing."]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => 500, "message" => "Server error: " . $e->getMessage()]);
}
?>