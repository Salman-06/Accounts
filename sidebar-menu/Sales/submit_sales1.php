<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sales_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$date = $_POST['date'];
$name = $_POST['name'];
$load = $_POST['load'];
$loadQty = $_POST['loadQty'];
$empty = $_POST['empty'];
$emptyQty = $_POST['emptyQty'];
$srg = $_POST['srg'];
$adap = $_POST['adap'];
$stove = $_POST['stove'];
$lighter = $_POST['lighter'];
$tube = $_POST['tube'];  // Assuming tube is equivalent to hose in the form
$total_amount = $_POST['total_amount'];
$deposit = $_POST['deposit'];
$amount_paid = $_POST['amount_paid'];
$amount_od = $_POST['amount_od'];
$od_collected = $_POST['od_collected'];  // Set this to a default or dynamically if needed

// Initialize fields for load and empty columns
$load12kg = $load == "12kg" ? $loadQty : 0;
$empty12kg = $empty == "12kg" ? $emptyQty : 0;
$load17kg = $load == "17kg" ? $loadQty : 0;
$empty17kg = $empty == "17kg" ? $emptyQty : 0;

// Insert data into the sales table
$sql = "INSERT INTO sales (date, name, load12kg, empty12kg, load17kg, empty17kg, srg, adap, stove, lighter, tube, total_amount, deposit, amount_paid, od_collected, amount_od)
        VALUES ('$date', '$name', $load12kg, $empty12kg, $load17kg, $empty17kg, $srg, $adap, $stove, $lighter, $tube, $total_amount, $deposit, $amount_paid, $od_collected, $amount_od)";

if ($conn->query($sql) === TRUE) {
    echo "Sales entry successfully inserted.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
