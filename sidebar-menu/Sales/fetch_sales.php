<?php
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

// SQL query to fetch sales data
$sql = "SELECT * FROM sales";
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
