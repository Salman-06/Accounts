<?php


if (isset($_GET['id'])) {
    $customerId = $_GET['id'];

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP is an empty string
$dbname = "customer_db"; // Your database name
    // Database connection
    $conn = new mysqli('localhost', 'username', 'password', 'database');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM customers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $customerId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $customer = $result->fetch_assoc();
        echo json_encode($customer);  // Return data as JSON
    } else {
        echo json_encode(['error' => 'Customer not found']);
    }

    $conn->close();
}
?>
