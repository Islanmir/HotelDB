<?php
session_start();
//Limparar todas as variáveis de sessão
session_unset();
//Destruir a sessão
session_destroy();
//Redirecionar para a página de index
header("Location: index.php");
die();