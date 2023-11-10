<?php
include("conexion.php");
// Verificar la conexión a la base de datos
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarioLogin = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $sql = "SELECT * FROM registro WHERE usuario = '$usuarioLogin' and contrasena = '$contrasena'";   
    $resultado = $conexion->query($sql);
    
    if ($resultado-> num_rows > 0) {
        // Hay resultados, haz algo aquí
        session_start();
        echo "Inicio de sesión exitoso.";
        $_SESSION['usuario'] = $usuarioLogin;
        header('Location: index.php');
    } else {
        echo "Inicio de sesión fallido. Verifica tus credenciales.";
    }
} else {
    include("index.php");
    echo("No esta entrando"); 
}
$conexion->close();
?>
<h1 class="bad" style="color: red;">Credenciales Incorrectas.<br> Inténtalo de nuevo.</h1>