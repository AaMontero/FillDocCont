<!DOCTYPE html>
<html>
<head>
    <title>Formulario PHP</title>
</head>
<body>

<?php
// Definir variables para almacenar los datos del formulario
$nombre = $email = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = test_input($_POST["nombre"]);
    $email = test_input($_POST["email"]);
    
    // Mostrar los datos recibidos
    echo "<h2>Tus datos:</h2>";
    echo "Nombre: $nombre<br>";
    echo "Correo electrónico: $email<br>";
}

// Función para validar y limpiar los datos del formulario
function test_input($data) {
    $data = trim($data); // Eliminar espacios en blanco al inicio y al final
    $data = stripslashes($data); // Eliminar barras invertidas
    $data = htmlspecialchars($data); // Evitar ataques de seguridad
    return $data;
}
?>

<h2>Formulario de Ejemplo</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Nombre: <input type="text" name="nombre">
    <br><br>
    Correo Electrónico: <input type="text" name="email">
    <br><br>
    <input type="submit" name="submit" value="Enviar">
</form>

</body>
</html>
