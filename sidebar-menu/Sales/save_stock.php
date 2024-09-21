<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stock_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = $_POST['date'];
$fields = ['12kg_empty', '12kg_load', '17kg_empty', '17kg_load', 'hose', 'srg', 'ind_srg', 'adap', 'ind_adap', 'lighter', 'stove'];
$data = [];

foreach ($fields as $field) {
    $data["opening_$field"] = $_POST["opening_$field"];
    $data["purchase_$field"] = $_POST["purchase_$field"];
    $data["sales_$field"] = $_POST["sales_$field"];
    $data["closing_$field"] = $_POST["closing_$field"];
}

$sql = "INSERT INTO stocks (date, opening_12kg_empty, purchase_12kg_empty, sales_12kg_empty, closing_12kg_empty,
        opening_12kg_load, purchase_12kg_load, sales_12kg_load, closing_12kg_load,
        opening_17kg_empty, purchase_17kg_empty, sales_17kg_empty, closing_17kg_empty,
        opening_17kg_load, purchase_17kg_load, sales_17kg_load, closing_17kg_load,
        opening_hose, purchase_hose, sales_hose, closing_hose,
        opening_srg, purchase_srg, sales_srg, closing_srg,
        opening_ind_srg, purchase_ind_srg, sales_ind_srg, closing_ind_srg,
        opening_adap, purchase_adap, sales_adap, closing_adap,
        opening_ind_adap, purchase_ind_adap, sales_ind_adap, closing_ind_adap,
        opening_lighter, purchase_lighter, sales_lighter, closing_lighter,
        opening_stove, purchase_stove, sales_stove, closing_stove)
        VALUES ('$date', '{$data['opening_12kg_empty']}', '{$data['purchase_12kg_empty']}', '{$data['sales_12kg_empty']}', '{$data['closing_12kg_empty']}',
        '{$data['opening_12kg_load']}', '{$data['purchase_12kg_load']}', '{$data['sales_12kg_load']}', '{$data['closing_12kg_load']}',
        '{$data['opening_17kg_empty']}', '{$data['purchase_17kg_empty']}', '{$data['sales_17kg_empty']}', '{$data['closing_17kg_empty']}',
        '{$data['opening_17kg_load']}', '{$data['purchase_17kg_load']}', '{$data['sales_17kg_load']}', '{$data['closing_17kg_load']}',
        '{$data['opening_hose']}', '{$data['purchase_hose']}', '{$data['sales_hose']}', '{$data['closing_hose']}',
        '{$data['opening_srg']}', '{$data['purchase_srg']}', '{$data['sales_srg']}', '{$data['closing_srg']}',
        '{$data['opening_ind_srg']}', '{$data['purchase_ind_srg']}', '{$data['sales_ind_srg']}', '{$data['closing_ind_srg']}',
        '{$data['opening_adap']}', '{$data['purchase_adap']}', '{$data['sales_adap']}', '{$data['closing_adap']}',
        '{$data['opening_ind_adap']}', '{$data['purchase_ind_adap']}', '{$data['sales_ind_adap']}', '{$data['closing_ind_adap']}',
        '{$data['opening_lighter']}', '{$data['purchase_lighter']}', '{$data['sales_lighter']}', '{$data['closing_lighter']}',
        '{$data['opening_stove']}', '{$data['purchase_stove']}', '{$data['sales_stove']}', '{$data['closing_stove']}')";

if ($conn->query($sql) === TRUE) {
    echo "Record saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
