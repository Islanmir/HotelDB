<?php

include "../config/connection.php"; // ligação à BD
include "../src/enviaremail.php"; // função de envio de email

if (isset($_GET["id"]) && isset($_GET["estado"])) {
    $id = intval($_GET["id"]);
    $estado = $_GET["estado"];

    $sql = "UPDATE reservas SET estado='$estado' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Reserva atualizada com sucesso.";

        enviar_email("trplm1980@gmail.com","Raquel Monteiro", "Actualização de Reserva", "Uma reserva foi atualizada com sucesso.");

        header("Location: ../public/index1.php"); // volta à listagem
        exit;
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }
}

?>
