<?php
include '../config/connection.php';

$id = $_GET['id'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quarto = $_POST["quarto"];
    $update = "UPDATE reservas SET quarto = '$quarto' WHERE id = $id";
    mysqli_query($conn, $update);
    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Atribuir Quarto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('pousada.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.4); /* camada escura para contraste */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .card {
            backdrop-filter: blur(6px);
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        h3 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .btn-group-custom {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <div class="card">
        <h3>Atribuir Quarto à Reserva #<?= $id ?></h3>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Número do Quarto:</label>
                <input type="text" name="quarto" class="form-control" required>
            </div>

            <div class="btn-group-custom mt-4">
                <button type="submit" class="btn btn-success w-100">Guardar</button>
                <a href="index.php" class="btn btn-secondary w-100">Cancelar</a>
                <a href="index.php" class="btn btn-outline-light w-100" style="background-color:#0d6efd; color:white;">Voltar</a>
            </div>
        </form>
    </div>

</body>
</html>
