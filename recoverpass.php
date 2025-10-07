<?php

require "../config/connection.php";
require "../src/enviaremail.php";

if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];
   $codigo_aleatorio = bin2hex(random_bytes(16));

   $query =mysqli_prepare($conn, "UPDATE employees SET recoverCode=?,RecoverExpirationTime = NOW() + INTERVAL 5 MINUTE WHERE username = ?");
   mysqli_stmt_bind_param($query, "ss", $codigo_aleatorio, $email);

   if(mysqli_stmt_execute($query) && mysqli_stmt_affected_rows($query) > 0) {
       $link_recuperação="http://localhost/HotelDB/resetpass.php?code=" . $codigo_aleatorio;
       $assunto = "Recuperar password";
       $mensagem = "Clique no link para redifinir a sua password: <a href=".$link_recuperação. ">Redefinir password</a>. Este link é válido por 5 minutos.";
       enviar_email($email, "usuario", $assunto, $mensagem);
       echo "Um email foi enviado para ". htmlspecialchars($email);
    } else {
         echo "Email não encontrado.";
     }   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de password</title>
</head>
<body>
    <h2>Recuperação de password</h2>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <button type="submit">Recuperar Password</button>
    </form>
</body>
</html>