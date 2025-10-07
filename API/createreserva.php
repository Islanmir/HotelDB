<?php
require "../config/connection.php";
header('Content-Type: application/json');

// Lê o corpo do request
$body = json_decode(file_get_contents('php://input'), true);

$cliente  = $body['cliente']  ?? '';
$checkin  = $body['checkin']  ?? '';
$checkout = $body['checkout'] ?? '';

// ---------- Validação ----------
if (empty($cliente) || empty($checkin) || empty($checkout)) {
    echo json_encode([
        "success" => false,
        "error" => "Campos obrigatórios em falta"
    ]);
    exit;
}

if ($checkin >= $checkout) {
    echo json_encode([
        "success" => false,
        "error" => "Data de check-in deve ser anterior ao check-out"
    ]);
    exit;
}

// ---------- Inserir reserva sem quarto ----------
$query = "INSERT INTO reservas (cliente, quarto, checkin, checkout, estado) 
          VALUES (?, NULL, ?, ?, ?)";
$stmt = $conn->prepare($query);

$estado = "ativa"; // já fica ativa
$stmt->bind_param("ssss", $cliente, $checkin, $checkout, $estado);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "reserva_id" => $stmt->insert_id,
        "estado" => $estado
    ]);
} else {
    echo json_encode([
        "success" => false,
        "error" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>

