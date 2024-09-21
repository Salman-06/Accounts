<?php
// fetch_total_amount.php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sales_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = $_GET['date'];

// SQL query to fetch the total amount for the selected date
$sql = "SELECT SUM(total_amount) AS total_amount FROM sales WHERE date = '$date'";
$result = $conn->query($sql);

$totalAmount = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalAmount = $row['total_amount'];
}

echo json_encode(['total_amount' => $totalAmount]);

$conn->close();
?>
