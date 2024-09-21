<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP is an empty string
$dbname = "sales_db"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data and handle empty values
$date = isset($_POST['date']) ? $_POST['date'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$load12kg = isset($_POST['12kg_load']) ? $_POST['12kg_load'] : 0;
$empty12kg = isset($_POST['12kg_empty_received']) ? $_POST['12kg_empty_received'] : 0;
$load17kg = isset($_POST['17kg_load']) ? $_POST['17kg_load'] : 0;
$empty17kg = isset($_POST['17kg_empty_received']) ? $_POST['17kg_empty_received'] : 0;
$srg = isset($_POST['srg']) ? $_POST['srg'] : 0;
$adap = isset($_POST['adap']) ? $_POST['adap'] : 0;
$stove = isset($_POST['stove']) ? $_POST['stove'] : 0;
$lighter = isset($_POST['lighter']) ? $_POST['lighter'] : 0;
$tube = isset($_POST['tube']) ? $_POST['tube'] : 0;
$totalAmount = isset($_POST['total_amount']) ? $_POST['total_amount'] : 0;
$deposit = isset($_POST['deposit']) ? $_POST['deposit'] : 0;
$amountPaid = isset($_POST['amount_paid']) ? $_POST['amount_paid'] : 0;
$od_collected = isset($_POST['od_collected']) ? $_POST['od_collected'] : 0;
$amountOD = isset($_POST['amount_od']) ? $_POST['amount_od'] : 0;

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO sales (date, name, load12kg, empty12kg, load17kg, empty17kg, srg, adap, stove, lighter, tube, total_amount, deposit, amount_paid, od_collected, amount_od) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssiiiiiiiiiddddd", $date, $name, $load12kg, $empty12kg, $load17kg, $empty17kg, $srg, $adap, $stove, $lighter, $tube, $totalAmount, $deposit, $amountPaid, $od_collected, $amountOD);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "<script>
            alert('New record created successfully');
            window.location.href = 'salesEntry.html'; // Replace with your actual form URL
          </script>";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
