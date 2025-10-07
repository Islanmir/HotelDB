<?php
session_start();
include '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nome']) && !empty($_POST['quarto']) && !empty($_POST['checkin']) && !empty($_POST['checkout'])) {
        
        $employeeID = $_SESSION['employeeID']; // vem da sessão!

        $query = "INSERT INTO reservas (cliente, quarto, checkin, checkout, estado, employeeID)
                  VALUES (?, ?, ?, ?, 'Ativa', ?)";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "ssssi", 
                $_POST["nome"], $_POST["quarto"], $_POST["checkin"], $_POST["checkout"], $employeeID);

            if (mysqli_stmt_execute($stmt)) {
                header("Location:index.php");
                exit;
            } else {
                echo "Erro ao executar: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da query: " . mysqli_error($conn);
        }
    } else {
        echo "Erro - Por favor preencha todos os campos.";
    }
}
?>
