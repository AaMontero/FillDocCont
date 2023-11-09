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
      <h1 class="bad" style="color: red;">ERROR DE AUTENTIFICACION</h1>
      <?php
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    
    ?>