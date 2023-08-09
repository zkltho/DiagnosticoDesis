<?php
// Crear la conexión
$conn = new mysqli("localhost","root", "", "resultados");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}else{
    //echo "funciona";
}
?>