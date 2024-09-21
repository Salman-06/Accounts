<?php
// save_od_data.php

header('Content-Type: application/json');

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sales_db"; // Use the existing sales_db

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get the posted data
$data = json_decode(file_get_contents('php://input'), true);

$date = $data['date'];
$initialTotal = $data['initialTotal'];
$odCollectedList = $data['odCollectedList'];
$outstandingList = $data['outstandingList'];
$odCollectedTotal = $data['odCollectedTotal'];
$outstandingTotal = $data['outstandingTotal'];
$finalCalculatedTotal = $data['finalCalculatedTotal'];

// Prepare and execute the SQL statements
$conn->autocommit(FALSE); // Start transaction

try {
    // Insert the main record
    $stmt = $conn->prepare("INSERT INTO od_main (date, initial_total, od_collected_total, outstanding_total, final_calculated_total) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdddd", $date, $initialTotal, $odCollectedTotal, $outstandingTotal, $finalCalculatedTotal);
    $stmt->execute();
    $mainId = $stmt->insert_id;
    $stmt->close();

    // Insert the OD Collected records
    $stmt = $conn->prepare("INSERT INTO od_collected (main_id, name, cash, gpay) VALUES (?, ?, ?, ?)");
    foreach ($odCollectedList as $item) {
        $stmt->bind_param("isdd", $mainId, $item['name'], $item['cash'], $item['gpay']);
        $stmt->execute();
    }
    $stmt->close();

    // Insert the Outstanding records
    $stmt = $conn->prepare("INSERT INTO outstanding (main_id, name, amount) VALUES (?, ?, ?)");
    foreach ($outstandingList as $item) {
        $stmt->bind_param("isd", $mainId, $item['name'], $item['amount']);
        $stmt->execute();
    }
    $stmt->close();

    $conn->commit(); // Commit transaction
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    $conn->rollback(); // Rollback transaction
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>
