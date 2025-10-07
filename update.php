<?php
include '../config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && isset($_POST["nome"]) &&  isset($_POST["quarto"]) && isset($_POST["checkin"]) && isset($_POST["checkout"]) && isset($_POST["estado"])) {

        $query = "UPDATE reservas SET cliente = ?, quarto = ?, checkin = ?, checkout = ?, estado = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "sssssi", $_POST["nome"], $_POST["quarto"], $_POST["checkin"], $_POST["checkout"], $_POST["estado"], $_POST["id"]);

            if (mysqli_stmt_execute($stmt)) {
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    header("Location: ../public/index1.php");
                    exit();
                } else {
                    echo "Nenhum Cliente encontrado com o ID especificado.";
                    exit();
                }
            } else {
                echo "Erro ao executar: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da query: " . mysqli_error($conn);
        }
    } else {
        echo "ERRO - Dados inválidos";
        die();
    }
} else {
    echo "ERRO";
    die();
}
