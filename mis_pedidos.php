<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'conexion.php';  // Incluir archivo de conexión

if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit();
}

$id_cliente = $_SESSION['id_cliente'];

// Llamar a la función conectar() para obtener la conexión
$conn = conectar();

// Obtener los pedidos del cliente
$sql = "SELECT Compras.id, Compras.total, Entregas.fecha_entrega, Entregas.estado
        FROM Compras
        INNER JOIN Carritos ON Compras.id_carrito = Carritos.id
        LEFT JOIN Entregas ON Carritos.id = Entregas.id_carrito
        WHERE Carritos.id_cliente = $id_cliente";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($pedido = mysqli_fetch_assoc($result)) {
        echo "<p>Pedido ID: " . $pedido['id'] . "<br>";
        echo "Total: $" . $pedido['total'] . "<br>";
        echo "Fecha de entrega: " . $pedido['fecha_entrega'] . "<br>";
        echo "Estado: " . $pedido['estado'] . "</p>";
    }
} else {
    echo "<p>No tienes pedidos.</p>";
}

// Cerrar la conexión
mysqli_close($conn);
?>
