<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'conexion.php';

// Conectar a la base de datos
$conn = conectar();

// Obtener datos enviados desde el formulario o petición
$carritoID = $_POST['carritoID']; // ID del carrito
$productoID = $_POST['productoID']; // ID del producto
$cantidad = $_POST['cantidad']; // Cantidad del producto

// Verificar que los datos requeridos no estén vacíos
if (empty($carritoID) || empty($productoID) || empty($cantidad)) {
    die("Error: Todos los campos son obligatorios.");
}

// Obtener el precio unitario del producto desde la tabla 'Productos'
$query = "SELECT precio FROM Productos WHERE id = '$productoID'";
$result = mysqli_query($conn, $query);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $precioUnitario = $row['precio'];
} else {
    die("Error: Producto no encontrado.");
}

// Calcular el subtotal
$subtotal = $precioUnitario * $cantidad;

// Insertar el producto en el carrito
$insertQuery = "INSERT INTO Carrito_Productos (CarritoID, ProductoID, Cantidad, PrecioUnitario, Subtotal) 
                VALUES ('$carritoID', '$productoID', '$cantidad', '$precioUnitario', '$subtotal')";

if (mysqli_query($conn, $insertQuery)) {
    echo "Producto agregado al carrito correctamente.";
} else {
    echo "Error al agregar producto al carrito: " . mysqli_error($conn);
}

// Cerrar conexión
mysqli_close($conn);
?>

