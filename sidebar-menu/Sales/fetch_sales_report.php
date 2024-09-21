<?php
// fetch_sales_report.php

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

$fromDate = $_GET['fromDate'];
$toDate = $_GET['toDate'];

// SQL query to fetch sales data between selected dates
$sql = "SELECT * FROM sales WHERE date >= '$fromDate' AND date <= '$toDate'";
$result = $conn->query($sql);

// Fetch data and encode to JSON
$salesData = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $salesData[] = $row;
    }
}

echo json_encode($salesData);

$conn->close();
?>
