<?php
include("conexion.php");

    ($_SERVER['REQUEST_METHOD'] == 'POST'); 
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    session_start();
    $sql = "SELECT * FROM registro WHERE usuario = '$usuario' and contrasena = '$contrasena'";
    $resultado = $conexion->query($sql);
    $filas=mysqli_num_rows($resultado);
    if($filas){
        header("location:index.php");
    }else{
        ?>
        <?php
        include("login.php");
      ?>
      <h1 class="bad" style="color: red;">Credenciales Incorrectas.<br> Inténtalo de nuevo.</h1>
      <?php
    }
    if (verificar_credenciales($usuario, $contrasena)) {
      // Iniciar la sesión y almacenar datos del usuario
      $_SESSION['usuario'] = $usuario;
  
      // Redirigir al usuario a la página con el formulario personalizado
      header('Location: formulario_personalizado.php');
      function verificar_credenciales($usuario,$contrasena) {
        $conexion = new mysqli("localhost", "tu_usuario", "tu_contraseña", "tu_base_de_datos");

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Escapar los datos para evitar inyección SQL (mejor aún, usar sentencias preparadas)
    $usuario = $conexion->real_escape_string($usuario);
    $contrasena = $conexion->real_escape_string($contrasena);

    // Consultar la base de datos para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$usuario'";
    $result = $conexion->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['contrasena'];

        // Verificar la contraseña
        if (password_verify($contrasena, $stored_password)) {
            // Las credenciales son válidas
        }
    }
    }
  } else {
      echo "Credenciales incorrectas. Inténtalo de nuevo.";
  }
  
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    
    ?>