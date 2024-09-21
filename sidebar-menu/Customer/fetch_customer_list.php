<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customer_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get pagination and search parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 10;
$search = isset($_GET['search']) ? $_GET['search'] : '';

$offset = ($page - 1) * $entries;

// SQL query to fetch customer data
$sql = "SELECT customer_id, customer_name, gstin, phone_number 
        FROM customers 
        WHERE customer_id LIKE '%$search%' 
        OR customer_name LIKE '%$search%' 
        OR phone_number LIKE '%$search%' 
        LIMIT $offset, $entries";

$result = $conn->query($sql);

// Handle SQL errors
if ($result === false) {
    die(json_encode(['success' => false, 'message' => 'Query failed: ' . $conn->error]));
}

$customers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}

// Get total count for pagination
$sqlTotal = "SELECT COUNT(*) as total FROM customers 
             WHERE customer_id LIKE '%$search%' 
             OR customer_name LIKE '%$search%' 
             OR phone_number LIKE '%$search%'";
$totalResult = $conn->query($sqlTotal);
$totalRow = $totalResult->fetch_assoc();
$totalPages = ceil($totalRow['total'] / $entries);

// Return JSON response
echo json_encode([
    'success' => true,
    'customers' => $customers,
    'totalPages' => $totalPages
]);

$conn->close();
?>
