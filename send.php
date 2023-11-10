<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    session_start();
    $sql = "SELECT * FROM registro WHERE usuario = '$usuario' and contrasena = '$contrasena'";
    $resultado = $conexion->query($sql);
    $filas = mysqli_num_rows($resultado);

    if ($filas) {
        header("location: index.php");
        // Importante: detener la ejecución después de redirigir
    } 
}else {
    include("login.php");
    ?>
    <h1 class="bad" style="color: red;">Credenciales Incorrectas.<br> Inténtalo de nuevo.</h1>
    <?php
}

//Validacion de Credenciales
function verificar_credenciales($usuario, $contrasena) {
    $conexion = new mysqli("localhost", "root", "", "contratosdb");

    // Verificar la conexión a la base de datos
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Escapar los datos para evitar inyección SQL (mejor aún, usar sentencias preparadas)
    $usuario = $conexion->real_escape_string($usuario);
    $contrasena = $conexion->real_escape_string($contrasena);

    // Consultar la base de datos para verificar las credenciales
    $sql = "SELECT * FROM registro WHERE usuario = '$usuario'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        $row = $resultado->fetch_assoc();
        $stored_password = $row['contrasena'];

        // Verificar la contraseña utilizando password_verify
        if (password_verify($contrasena, $stored_password)) {
            // Las credenciales son válidas

            // Iniciar la sesión y almacenar datos del usuario
            session_start();
            $_SESSION['usuario'] = $usuario;
           // $_SESSION['contrasena'] = $contrasena;

            // Redirigir al usuario a la página con el formulario personalizado
            header('Location: send.php');
            exit(); // Importante: detener la ejecución después de la redirección
        } else {
            echo "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    } else {
        echo "Credenciales incorrectas. Inténtalo de nuevo.";
    }

    $conexion->close();
}
?>