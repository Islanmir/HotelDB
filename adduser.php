<?php

include '../config/connection.php';
function encryptPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['employeeName']) && !empty($_POST['email'])) {

        $hashedPassword = encryptPassword($_POST['password']);
        $query = "INSERT INTO employees (username, password, employeeName, email) 
          VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "ssss", $_POST["username"], $hashedPassword, $_POST["employeeName"], $_POST["email"]);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: ../public/index1.php");
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
} else {
    echo "Erro - Pedido HTTP inválido.";
    die();
}

