<?php
session_start();
include('conexion.php');
$conn = conectar();

// Obtener todos los pedidos
$sql_pedidos = "SELECT e.id AS id_entrega, e.estado, c.total, r.nombre AS repartidor, e.fecha_entrega
                FROM Entregas e
                JOIN Repartidores r ON e.id_repartidor = r.id
                JOIN Compras c ON c.id = e.id_cliente";
$result_pedidos = mysqli_query($conn, $sql_pedidos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Pedido</title>
</head>
<body>
    <h1>Actualizar Estado de Pedido</h1>
    <?php if (mysqli_num_rows($result_pedidos) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID Entrega</th>
                    <th>Estado Actual</th>
                    <th>Total</th>
                    <th>Repartidor</th>
                    <th>Fecha de Entrega</th>
                    <th>Actualizar Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($pedido = mysqli_fetch_assoc($result_pedidos)): ?>
                    <tr>
                        <td><?php echo $pedido['id_entrega']; ?></td>
                        <td><?php echo $pedido['estado']; ?></td>
                        <td><?php echo $pedido['total']; ?></td>
                        <td><?php echo $pedido['repartidor']; ?></td>
                        <td><?php echo $pedido['fecha_entrega'] ? $pedido['fecha_entrega'] : 'Pendiente'; ?></td>
                        <td>
                            <form action="procesar_actualizacion.php" method="post">
                                <input type="hidden" name="id_entrega" value="<?php echo $pedido['id_entrega']; ?>">
                                <select name="estado" required>
                                    <option value="En tránsito" <?php echo $pedido['estado'] == 'En tránsito' ? 'selected' : ''; ?>>En tránsito</option>
                                    <option value="En camino" <?php echo $pedido['estado'] == 'En camino' ? 'selected' : ''; ?>>En camino</option>
                                    <option value="Entregado" <?php echo $pedido['estado'] == 'Entregado' ? 'selected' : ''; ?>>Entregado</option>
                                </select>
                                <button type="submit">Actualizar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay pedidos para actualizar.</p>
    <?php endif; ?>

    <?php mysqli_close($conn); ?>
</body>
</html>

