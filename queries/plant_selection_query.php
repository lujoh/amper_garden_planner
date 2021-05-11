<?php
//this file starts an sql query for the plant selection section and saves the result in a variable to be used in the plant selection area
include '../pwd.php';
$selection_error = false;
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DB);

if ($conn->connect_error) {
    $selection_error = true;
    die("Connection failed: " . $conn->connect_error);
}

$selection_sql = 
    "SELECT p.plant_id, p.plant_name
    FROM plants p;";

$selection_result = $conn->query($selection_sql);
if (!$selection_result){
    $selection_error = true;
}

$conn->close();
?>