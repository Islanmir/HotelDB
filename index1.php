<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<style>
    body {
        background-image: url('hotel.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }
</style>

<body>
    <?php include '../config/connection.php'; ?>
    <div class="d-flex justify-content-center m-3">
        <a href="createformaddreserva.php" class="btn btn-primary me-3">
            <i class="bi bi-calendar-plus"></i> Adicionar Reserva
        </a>
        <a href="createformadduser.php" class="btn btn-primary me-3">
            <i class="bi bi-calendar-plus"></i> Registar Novo Utilizador
        </a>
        <a href="logout.php" class="btn btn-primary">
            <i class="bi bi-logout"></i> Logout
        </a>
    </div>
    <?php include 'reservas.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>