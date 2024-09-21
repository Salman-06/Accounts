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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $purchaseId = isset($_POST['id']) ? $_POST['id'] : null;  // Get the ID from the POST data

    // Get the other fields from the form data
    $purchaseDate = $_POST['purchaseDate'];
    $purchaseBill = $_POST['purchaseBill'];
    $itemDetails = $_POST['itemDetails'];
    $given12kg = $_POST['given12kg'];
    $load17kg = $_POST['load17kg'];
    $given17kg = $_POST['given17kg'];
    $amount12kg = $_POST['amount12kg'];
    $amount17kg = $_POST['amount17kg'];
    $totalPurchaseValue = $_POST['totalPurchaseValue'];

    if ($purchaseId) {
        // **Update** the existing record if an ID is provided
        $sql = "UPDATE purchases SET 
                    purchase_date = ?, 
                    purchase_bill = ?, 
                    item_details = ?, 
                    given12kg = ?, 
                    load17kg = ?, 
                    given17kg = ?, 
                    amount12kg = ?, 
                    amount17kg = ?, 
                    total_purchase_value = ? 
                WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssiiiiiddi', $purchaseDate, $purchaseBill, $itemDetails, $given12kg, $load17kg, $given17kg, $amount12kg, $amount17kg, $totalPurchaseValue, $purchaseId);
        $stmt->execute();
    } else {
        // **Insert** a new record if no ID is provided
        $sql = "INSERT INTO purchases (purchase_date, purchase_bill, item_details, given12kg, load17kg, given17kg, amount12kg, amount17kg, total_purchase_value) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssiiiiidd', $purchaseDate, $purchaseBill, $itemDetails, $given12kg, $load17kg, $given17kg, $amount12kg, $amount17kg, $totalPurchaseValue);
        $stmt->execute();
    }

    // Return a success response if rows are affected
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);  // Return failure if no rows were affected
    }
}
?>