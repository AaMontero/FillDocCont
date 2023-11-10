
<?php
session_start();  // Si no se ha iniciado la sesión
include("conexion.php");
$usuarioReg = $_POST['usuario'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
// Consulta SQL para insertar en la base de datos
$sql = "INSERT INTO registro (usuario, email, contrasena) VALUES ('$usuarioReg', '$email', '$contrasena')";

// Ejecutar la consulta y verificar errores
if ($conexion->query($sql) === TRUE) {
    // Consulta SQL para verificar el registro
    $sql2 = "SELECT * FROM registro WHERE usuario = '$usuarioReg' AND contrasena = '$contrasena'";
    // Ejecutar la consulta y verificar errores
    $resultado2 = $conexion->query($sql2);
    if ($resultado2 !== false && $resultado2->num_rows > 0) {
        $mensaje = "Registro exitoso.<br>¡Gracias por registrarte!<br>Redirigiendo a la página de Registro...";
        echo $mensaje;
        header("refresh:2;url=registro.php"); // Redirige a "registro.php" después de 2 segundos
        exit;
    } else {
        echo "Error en el registro: " . $conexion->error;
    }
} else {
    echo "Error en el registro: " . $conexion->error;
}

$conexion->close();
?>
