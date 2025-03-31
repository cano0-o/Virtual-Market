<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('conexion.php');
$conn = conectar();

$id_entrega = $_POST['id_entrega'];
$estado = $_POST['estado'];

// Validar entrada
if (!in_array($estado, ['En tránsito', 'En camino', 'Entregado'])) {
    echo "Estado inválido.";
    exit();
}

// Actualizar el estado de la entrega
$sql_actualizar = "UPDATE Entregas SET estado = '$estado' WHERE id = $id_entrega";

if (mysqli_query($conn, $sql_actualizar)) {
    echo "Estado actualizado correctamente.";
    header("Location: actualizar_pedido.php"); // Redirigir de vuelta al formulario
    exit();
} else {
    echo "Error al actualizar el estado: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
