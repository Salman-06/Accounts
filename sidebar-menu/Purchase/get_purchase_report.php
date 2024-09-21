<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP is an empty string
$dbname = "purchase_db"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the date range from GET parameters
$fromDate = $_GET['fromDate'];
$toDate = $_GET['toDate'];

// Prepare the SQL query to fetch purchases within the date range
$sql = "SELECT * FROM purchases WHERE purchase_date BETWEEN ? AND ? ORDER BY purchase_date ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $fromDate, $toDate);
$stmt->execute();

$result = $stmt->get_result();
$purchases = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $purchases[] = $row;
    }
}

// Close the connection
$stmt->close();
$conn->close();

// Return the purchases as JSON
header('Content-Type: application/json');
echo json_encode($purchases);
?>