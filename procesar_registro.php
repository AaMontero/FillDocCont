<!-- procesar_registro.php -->
<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $sql = "INSERT INTO registro (usuario, email, contrasena) VALUES ('$usuario', '$email', '$contrasena')";
    if ($conexion->query($sql) === TRUE) {   
        $mensaje = "Registro exitoso.<br>¡Gracias por registrarte!<br>Redirigiendo a la página de Registro...";
        echo $mensaje;
        header("refresh:2;url=registro.php"); // Redirige a "registro.php" después de 2 segundos
        exit;
    
    } else {
        echo "Error en el registro: " . $conexion->connect_error;
    }

    $conexion->close();
}
?>
