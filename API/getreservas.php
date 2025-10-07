<?php

require "../config/connection.php";
header('Content-Type: application/json');

$sql = "SELECT * FROM reservas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $reservas = array();
    while($row = $result->fetch_assoc()) {
        $reservas[] = $row;
    }
    echo json_encode($reservas);
} else {
    echo json_encode(array());
}
$conn->close();
?>