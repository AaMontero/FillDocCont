<!DOCTYPE html>
<html>

<head>
    <title class="titulo">Formulario PHP</title>
    <link rel="stylesheet" href="style_formulario.css">
</head>

<body>
    <?php

    use PhpOffice\PhpWord\TemplateProcessor;

    include("conexion.php");
    require 'vendor/autoload.php'; //Librería para cargar documentos de word
    $content = "";
    $templateWord = new TemplateProcessor("Contrato.docx");
    $templateWord->setValue('edit_numero_cedula', '0000000000');
    $pathToSave = 'docs/documentoEditado2.docx';
    $templateWord->saveAs($pathToSave);
    
    echo $content;


    //Se busca dent ro de la base de datos el mayor numero de contacto 
    $consulta = "SELECT MAX(id) AS max_numero FROM contratos"; //Consulta SQL 
    $resultado = $conexion->query($consulta); //Se almacena lo obtenido en una variable 
    if ($resultado) {
        //Si existe el resultado se asigna un nuevo número 
        $fila = $resultado->fetch_assoc();
        $numero_sucesivo = $fila['max_numero'] + 1;
    } else {
        $numero_sucesivo = 1; // Si no hay contratos en la base de datos
        echo ("No existe el resultado");
    }
    $nombres = $email = $apellidos = $ciudad =  "";
    $cedula = "";
    $contrato = "";
    $fecha_actual = date("Y-m-d");
    // Variable para rastrear errores
    $errorNombres = "";
    $errorCedula = "";
    $errorApellidos = "";
    $errorCiudad = "";
    $errorCorreo = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombres = test_input($_POST["nombres"]);
        $email = test_input($_POST["email"]);
        $apellidos = test_input($_POST["apellidos"]);
        $ciudad = test_input($_POST["ciudad"]);
        $numCedula = test_input($_POST["cedula"]);
        $valida = (strlen($numCedula) == 10 && strlen($nombres) > 3 && strlen($apellidos) > 3 && strlen($ciudad) > 3 && strpos($email, "@") !== false);
        if ($valida) {
            $cedula = $numCedula;
            $contrato = "QT" . $numero_sucesivo . $ciudad;
            $nombre_cliente = $nombres . " " . $apellidos;
            $insercion = "INSERT INTO contratos (ciudad, nombre, fecha)     
                VALUES ('$ciudad', '$nombre_cliente', '$fecha_actual')";

            if ($conexion->query($insercion) === TRUE) {
                echo "Contrato creado exitosamente con numero: " . $contrato;
            } else {
                echo "Error al crear el contrato: " . $conexion->error;
            }
        } else {
            $errores = array();
            if (strlen($nombres) <= 3) {
                $errorNombres = "El nombre debe tener al menos 3 caracteres";
            }
            if (strlen($apellidos) <= 3) {
                $errorApellidos = "El apellido debe tener al menos 3 caracteres";
            }
            if (strlen($ciudad) <= 3) {
                $errorCiudad = "La ciudad debe contener al menos 3 caracteres";
            }
            if (strpos($email, "@") === false) {
                $errorCorreo = "El formato del correo ingresado no es válido";
            }
            if (strlen($cedula) !== 10) {
                $errorCedula = "El formato del correo ingresado no es válido";
            }
        }
    }


    $conexion->close();

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <h2 class="tituloH2">Formulario para Contratos</h2>
    <form class="formularioBox" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Nombres: <input type="text" name="nombres" value="<?php echo $nombres; ?>">
        <?php if (!empty($errorNombres)) {
            echo "<span style='color: red;'>$errorNombres</span>";
        } ?>
        <br><br>
        Apellidos: <input type="text" name="apellidos" value="<?php echo $apellidos; ?>">
        <?php if (!empty($errorApellidos)) {
            echo "<span style='color: red;'>$errorApellidos</span>";
        } ?>
        <br><br>
        Cedula: <input type="text" name="cedula" value="<?php echo $cedula; ?>">
        <?php if (!empty($errorCedula)) {
            echo "<span style='color: red;'>$errorCedula</span>";
        } ?>
        <br>
        <br>
        Correo Electrónico: <input type="text" name="email" value="<?php echo $email; ?>">
        <?php if (!empty($errorCorreo)) {
            echo "<span style='color: red;'>$errorCorreo</span>";
        } ?>
        <br><br>
        Ciudad: <input type="text" name="ciudad" value="<?php echo $ciudad; ?>">
        <?php if (!empty($errorCiudad)) {
            echo "<span style='color: red;'>$errorCiudad</span>";
        } ?>
        <br><br>
        <!--Aqui esta el botón para ejecutar el código-->
        <div class="divBoton">
            <input type="submit" name="submit" value="Generar Documentos">
        </div>
    </form>
</body>

</html>