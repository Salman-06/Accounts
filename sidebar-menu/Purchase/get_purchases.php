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
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Check if the request is for a specific purchase by ID
    if (isset($_GET['id'])) {
        $purchaseId = $_GET['id'];
        
        // SQL query to fetch a single purchase by its ID
        $sql = "SELECT * FROM purchases WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $purchaseId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $purchaseData = $result->fetch_assoc();
            echo json_encode($purchaseData);  // Return the purchase data as JSON
        } else {
            echo json_encode(null);  // Return null if no data is found
        }
    } else {
        // Existing logic to fetch all purchases (if no id is provided)
        $sql = "SELECT * FROM purchases";
        $result = $conn->query($sql);
        
        $purchases = [];
        while ($row = $result->fetch_assoc()) {
            $purchases[] = $row;
        }
        
        echo json_encode($purchases);  // Return all purchases
    }
}
?>