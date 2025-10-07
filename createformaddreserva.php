<!-- formulario em html para adicionar reservas -->
<!DOCTYPE html>
<html lang="en">
<style>
    body {
        background-image: url('../public/pousada.jpg'); 
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }
    .form-label {
        color: white !important;
        font-weight: bold;
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Reserva</title>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    <form action="../src/controller/addreserva.php" method="post" class="container mt-5">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" required>
        </div>
        <div class="mb-3">
            <label for="quarto" class="form-label">Quarto:</label>
            <input type="text" id="quarto" name="quarto" class="form-control" placeholder="Quarto" required>
        </div>
        <div class="mb-3">
            <label for="checkin" class="form-label">Data de Check-in:</label>
            <input type="date" id="checkin" name="checkin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="checkout" class="form-label">Data de Check-out:</label>
            <input type="date" id="checkout" name="checkout" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="hidden" id="status" name="status" value="Ativa" >
            <input type="hidden" id="employeeID" name="employeeID" value="<?php echo $_SESSION['employeeID']; ?>" >
        </div>
        <button type="submit" class="btn btn-success w-100 mb-2">
            <i class="bi bi-plus-circle"></i> Adicionar Reserva
        </button>
        <a href="../public/index1.php" class="btn btn-secondary w-100">
            <i class="bi bi-arrow-left-circle"></i> Voltar ao Início
        </a>
    </form>
</body>
</html>