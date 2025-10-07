<?php
session_start();
require "../config/connection.php";
require "../src/enviaremail.php"; // função de envio de email

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {

        $query = "SELECT * FROM employees WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $_POST["username"]);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($_POST["password"], $row["password"])) {
                // Password correta, guardar dados na sessão
                $_SESSION["username"] = $row["username"];
                $_SESSION["employeeID"] = $row["employeeID"];

                // Enviar email ao administrador
                $assunto = "Login de funcionário";
                $mensagem = "O funcionário " . $row["username"] . " efetuou login em " . date("d/m/Y H:i:s");
                enviar_email("trplm1980@gmail.com", "Administrador", $assunto, $mensagem);

                header("Location: index1.php");
                exit();
            } else {
                echo "Usuário ou senha inválidos.";
                exit();
            }
        } else {
            echo "Usuário ou senha inválidos.";
        }
    } else {
        echo "ERRO - Faltam dados";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hotel DB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('hotel.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
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

        .title {
            text-align: center;
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 30px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);
        }

        .card {
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.9);
        }

        footer {
            position: absolute;
            bottom: 15px;
            width: 100%;
            text-align: center;
            color: white;
            font-weight: 500;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8);
        }
    </style>
</head>

<body>
    <div class="overlay"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">

                <!-- Título do hotel -->
                <h1 class="title">Hotel DB</h1>

                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Login</h3>
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>

                            <div class="text-center mt-3">
                                <a href="recoverpass.php" class="btn btn-link">Esqueci-me da Password</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer>
        25057 - Teresa Monteiro - 2025
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

