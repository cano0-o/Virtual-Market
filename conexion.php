<?php

function conectar() {
    $host = "localhost";
    $user = "root";
    $pass = "password";  // Cambia la contraseña si es necesario
    $bd = "virtualmarket";
    $conn = mysqli_connect($host, $user, $pass, $bd);

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    mysqli_set_charset($conn, "utf8");
    return $conn;
}

?>
