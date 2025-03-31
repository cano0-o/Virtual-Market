<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'conexion.php';

$conn = conectar();

$ClienteID = $_SESSION['id'];

// Consultar el historial de compras del cliente
$sql_historial = "SELECT c.CarritoID, f.Repartidor, f.EstadoEntrega, f.FechaGeneracion 
                  FROM Carritos c
                  JOIN FichasEntrega f ON c.CarritoID = f.CarritoID
                  WHERE c.ClienteID = $ClienteID AND c.Estado = 'Comprado'
                  ORDER BY f.FechaGeneracion DESC";
$result_historial = $conn->query($sql_historial);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras</title>
</head>
<body>
    <h1>Historial de Compras</h1>
    <?php if ($result_historial->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Carrito ID</th>
                <th>Repartidor</th>
                <th>Estado de Entrega</th>
                <th>Fecha de Generación</th>
            </tr>
            <?php while ($compra = $result_historial->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($compra['CarritoID']) ?></td>
                    <td><?= htmlspecialchars($compra['Repartidor']) ?></td>
                    <td><?= htmlspecialchars($compra['EstadoEntrega']) ?></td>
                    <td><?= htmlspecialchars($compra['FechaGeneracion']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No hay compras registradas.</p>
    <?php endif; ?>
    <a href="principal.php">Volver</a>
</body>
</html>
<?php
$conn->close();
?>

