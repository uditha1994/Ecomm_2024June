<?php
header("Content-Type: application/json"); // Set JSON response type
session_start(); // Start the session

// Include the database connection class
require_once '../connection.php';

try {
    // Decode the JSON data received from the client
    $data = json_decode(file_get_contents("php://input"));

    // Check for required fields
    if (isset($data->product_name, $data->product_code, $data->manufacturer, $data->category, $data->price, $data->stock_quantity)) {
        // Create a new database connection instance
        $dbConnection = new DatabaseConnection();
        $conn = $dbConnection->getConnection();

        // Sanitize and prepare the data
        $product_name = $conn->real_escape_string($data->product_name);
        $product_code = $conn->real_escape_string($data->product_code);
        $manufacturer = $conn->real_escape_string($data->manufacturer);
        $category = $conn->real_escape_string($data->category);
        $price = $conn->real_escape_string($data->price);
        $stock_quantity = $conn->real_escape_string($data->stock_quantity);

        // Insert data into the products database
        $sql = "INSERT INTO products (product_name, product_code, manufacturer, category, price, stock_quantity) 
                VALUES ('$product_name', '$product_code', '$manufacturer', '$category', '$price', '$stock_quantity')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to the index page
            echo json_encode(["status" => 200, "message" => "Product registered successfully"]);
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