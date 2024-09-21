<?php
// Assuming you're using a MySQL database connection in $conn
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

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Parse the incoming DELETE request to get the ID
    parse_str(file_get_contents("php://input"), $_DELETE);
    $purchaseId = isset($_DELETE['id']) ? $_DELETE['id'] : null;

    if ($purchaseId) {
        // Delete the purchase with the given ID
        $sql = "DELETE FROM purchases WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $purchaseId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);  // Return success response
        } else {
            echo json_encode(['success' => false]);  // Return failure response if no rows were deleted
        }
    } else {
        echo json_encode(['success' => false]);  // Return failure response if no ID is provided
    }
}
?>