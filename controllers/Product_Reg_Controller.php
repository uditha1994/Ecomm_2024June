<?php
header("Content-Type: application/json"); // Set JSON response type

require_once '../connection.php';

try{
    $data = json_decode(file_get_contents("php://input"));

    if(isset($data->product_name, $data->product_code, $data->manufacturer
    ,$data->category, $data->price, $data->stock_quantity)){

        $dbConnection = new DatabaseConnection();
        $conn = $dbConnection->getConnection();

        $product_name = $conn->real_escape_string($data->product_name);
        $product_code = $conn->real_escape_string($data->product_code);
        $manufacturer = $conn->real_escape_string($data->manufacturer);
        $category = $conn->real_escape_string($data->category);
        $price = $conn->real_escape_string($data->price);
string: $stock_quantity = $conn->real_escape_string($data->stock_quantity);

        $sql = "INSERT INTO `products`(`product_name`, `product_code`, 
        `manufacturer`, `category`, `price`, `stock_quantity`) VALUES 
        ('$product_name', '$product_code', `$manufacturer`, `$category`, 
        `$price`, `$stock_quantity`);

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["status" => 200, "message" => "Product registered successfully"]);
        } else {
            echo json_encode(["status" => 500, "message" => "Error: " . $conn->error]);
        }
    }
} catch(Exception $e){
    echo json_encode(["status" => 500, "message" => "Server error: " . $e->getMessage()]);
}