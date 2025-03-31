<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Iniciar sesión
session_start();

// Incluir archivo de conexión
include('conexion.php');

// Comprobar si el formulario de inicio de sesión ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo y la contraseña del formulario
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Conectar a la base de datos
    $conn = conectar();

    // Consultar el cliente con el correo proporcionado
    $sql = "SELECT id, password, rol FROM Clientes WHERE mail = '$correo'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Si el usuario existe, obtener los datos
        $row = mysqli_fetch_assoc($result);
        // Verificar la contraseña encriptada
        if (password_verify($contraseña, $row['password'])) {
            // Si la contraseña es correcta, guardar el ClienteID en la sesión
            $_SESSION['ClienteID'] = $row['id'];
            $_SESSION['rol'] = $row['rol'];  // Guardamos el rol para controlar permisos

            // Redirigir al usuario a la tienda
            header("Location: tienda.php");
            exit();
        } else {
            echo "Credenciales incorrectas.";
        }
    } else {
        echo "No se encontró un usuario con ese correo.";
    }
}
?>

<!-- Formulario de login -->
<form action="" method="post">
    <input type="email" name="correo" placeholder="Correo electrónico" required>
    <input type="password" name="contraseña" placeholder="Contraseña" required>
    <input type="submit" value="Iniciar sesión">
</form>

