<?php
include "../config/connection.php"; // ficheiro com a ligação à base de dados

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]); // garante que é número

    // Apagar reserva pelo ID
    $sql = "DELETE FROM reservas WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Volta para a listagem de reservas
        header("Location: ../public/index1.php?msg=apagado");
        exit;
    } else {
        echo "Erro ao eliminar: " . mysqli_error($conn);
    }
} else {
    echo "ID inválido.";
}
