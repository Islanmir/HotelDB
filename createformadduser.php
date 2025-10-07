<!DOCTYPE html>
<html lang="en">
<style>
    body {
        background-image: url('pousada.jpg'); 
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
    <title>Novo Registo</title>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>

    <form action="adduser.php" method="post" class="container mt-5">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="mb-3">
            <label for="employeeName" class="form-label">Nome do Funcionário:</label>
            <input type="text" id="employeeName" name="employeeName" class="form-control" placeholder="Nome do Funcionário" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <button type="submit" class="btn btn-success w-100 mb-2">
            <i class="bi bi-plus-circle"></i> Adicionar Utilizador
        </button>
        <a href="index1.php" class="btn btn-secondary w-100">
            <i class="bi bi-arrow-left-circle"></i> Voltar ao Início
        </a>
</body>
</html>