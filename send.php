<?php
include("conexion.php");

$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
session_start();
$_SESSION['usuario']=$usuario;
<<<<<<< HEAD
$consulta="SELECT * FROM login where usuario='$usuario' and clave='$clave'";
=======


//$conexion=mysqli_connect("localhost","root","","contratosdb");

$consulta="SELECT*FROM login where usuario='$usuario' and clave='$clave'";
>>>>>>> 974a5aea2c1c29d37d7a2bbbda1588786e782797
$resultado=mysqli_query($conexion,$consulta);
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