<!-- procesar_registro.php -->
<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $sql = "INSERT INTO registro (usuario, email, contrasena) VALUES ('$usuario', '$email', '$contrasena')";
    if ($conexion->query($sql) === TRUE) {
        echo "Registro exitoso.";
    } else {
        echo "Error en el registro: " . $conexion->connect_error;
    }

    $conexion->close();
}
?>
