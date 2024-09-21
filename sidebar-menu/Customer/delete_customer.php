<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP is an empty string
$dbname = "customer_db"; // Your database name

$customerId = $_GET['id'];
$conn = new mysqli('localhost', 'username', 'password', 'database');
$sql = "DELETE FROM customers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $customerId);
$stmt->execute();
$conn->close();
header("Location: viewCustomer.html");
exit();
?>
