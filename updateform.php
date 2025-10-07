<?php
    include '../config/connection.php';
 
    $data = NULL;
    if( $_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) ){ 
        $query = "SELECT * FROM reservas WHERE id =".$_GET["id"].";";        
        $result = mysqli_query($conn,$query); 
        if($result){ 
            $data = mysqli_fetch_assoc($result); 
        }else{
            echo "Erro - Aconteceu algo inesperado na base de dados!";
            die();
        } 
    }
    else{
        echo "Erro - Aconteceu algo inesperado!";
        die();
    } 
?>

<!DOCTYPE html>
<html lang="en">
<style>
    body {
        background-image: url('piscina.jpg'); 
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }
    .form-label {
        font-weight: bold;
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Reserva</title>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    <form action="update.php" method="post" class="container mt-5">
        <div class="mb-3">
            <input type="hidden" id="id" name="id" value="<?php echo $data["id"];?>" >
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" required
            value="<?php echo $data["cliente"];?>" >
        </div>
        <div class="mb-3">
            <label for="quarto" class="form-label">Quarto:</label>
            <input type="text" id="quarto" name="quarto" class="form-control" placeholder="Quarto" required
            value="<?php echo $data["quarto"];?>" >
        </div>
        <div class="mb-3">
            <label for="checkin" class="form-label">Data de Check-in:</label>
            <input type="date" id="checkin" name="checkin" class="form-control" required
            value="<?php echo $data["checkin"];?>" >
        </div>
        <div class="mb-3">
            <label for="checkout" class="form-label">Data de Check-out:</label>
            <input type="date" id="checkout" name="checkout" class="form-control" required
            value="<?php echo $data["checkout"];?>" >
        </div>
        <div class="mb-3">
            <label for="checkout" class="form-label">Estado:</label>
            <input type="text" id="estado" name="estado" class="form-control" placeholder="Estado" required
            value="<?php echo $data["estado"];?>" >
        </div>
        <button type="submit" class="btn btn-success w-100 mb-2">
            <i class="bi bi-plus-circle"></i> Actualizar Reserva
        </button>
        <a href="index1.php" class="btn btn-secondary w-100">
            <i class="bi bi-arrow-left-circle"></i> Voltar ao Início
        </a>
    </form>
</body>
</html>