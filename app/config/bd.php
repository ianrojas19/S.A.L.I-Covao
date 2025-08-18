<?php
// Crear conexión
$conn = mysqli_connect('localhost', 'root', '', 'u518021603_sali');

// Verificar conexión
if (!$conn) {
    die('Conexión fallida: ' . mysqli_connect_error());
}
?>
