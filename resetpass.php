<?php
require "../config/connection.php";
require "../src/enviaremail.php";

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_password'], $_POST['confirm_password'], $_POST['code'])) {

    if ($_POST["new_password"] == $_POST["confirm_password"]) {
        $password_encripted = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

        // Atualizar password e limpar recoverCode/RecoverExpirationTime
        $query = mysqli_prepare($conn, "UPDATE employees SET password = ?, recoverCode = NULL, RecoverExpirationTime = NULL 
                                        WHERE RecoverCode = ? AND RecoverExpirationTime >= NOW()");
        mysqli_stmt_bind_param($query, "ss", $password_encripted, $_POST['code']);

        if (mysqli_stmt_execute($query) && mysqli_stmt_affected_rows($query) > 0) {
            // Buscar email e username para enviar email de confirmação
            $getUser = mysqli_prepare($conn, "SELECT email, username FROM employees WHERE password = ?");
            mysqli_stmt_bind_param($getUser, "s", $password_encripted);
            mysqli_stmt_execute($getUser);
            $result = mysqli_stmt_get_result($getUser);

            if ($row = $result->fetch_assoc()) {
                $email = $row['email'];
                $username = $row['username'];
                $assunto = "Password Alterada com Sucesso";
                $mensagem = "Olá $username,<br><br>
                            A sua password foi alterada em " . date("d/m/Y H:i:s") . ".<br>
                            Se não foi você, contacte imediatamente o administrador.";
                enviar_email($email, $username, $assunto, $mensagem);
            }

            $success = "Password redefinida com sucesso! Já pode fazer login.";
        } else {
            $error = "Código inválido ou expirado.";
        }
    } else {
        $error = "Passwords não coincidem.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Redefinir Password</h3>

                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success">
                                <?php echo $success; ?>
                                <div class="mt-3 text-center">
                                    <a href="login.php" class="btn btn-success">Voltar para Login</a>
                                </div>
                            </div>
                        <?php elseif (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>


                        <form action="resetpass.php" method="post">
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Nova Password:</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirmar Password:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <input type="hidden" name="code" value="<?php echo htmlspecialchars($_GET['code'] ?? ''); ?>">
                            <button type="submit" class="btn btn-primary w-100">Redefinir Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>