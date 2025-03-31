<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'conexion.php';

$conn = conectar();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit();
}

$clienteID = $_SESSION['id'];
$carritoID = $_SESSION['carritoID'];

// Obtener los productos del carrito
$sql = "SELECT p.nombre, p.precio, cd.Cantidad, (p.precio * cd.Cantidad) AS Subtotal
        FROM Carrito_Detalles cd
        JOIN Productos p ON cd.ProductoID = p.id
        WHERE cd.CarritoID = $carritoID";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>
<body>
    <h1>Mi Carrito</h1>
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td>$<?= htmlspecialchars($row['precio']) ?></td>
                    <td><?= htmlspecialchars($row['Cantidad']) ?></td>
                    <td>$<?= htmlspecialchars($row['Subtotal']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No hay productos en tu carrito.</p>
    <?php endif; ?>
    <br>
    <a href="tienda.php">Volver a la tienda</a>
</body>
</html>

<?php
$conn->close();
?>

