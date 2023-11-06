<!DOCTYPE html>
<html>

<head>
    <title class="titulo">Formulario PHP</title>
    <link rel="stylesheet" href="style_formulario.css">
</head>

<body>
    <?php
    // Cedula -> edit_numero_cedula 
    // Nombres y apellidos -> edit_nombres_apellidos 
    // RUC -> edit_RUC
    // fechaActual -> edit_fecha_contrato
    // ciudad -> edit_ciudad
    // correo -> edit_email 
    // contrato -> edit_contrato_id
    // lugar de la sala -> edit_sala_lugar
    // numero de cliente -> edit_num_cliente
    // años del contrato -> edit_anios_contrato
    // monto del contrato -> edit_monto_contrato 
    // forma de pago(Varias) -> edit_forma_pago
    // pagare -> edit_pagaré 
    // fecha en texto -> edit_fecha_texto 
    // fecha vencimiento -> edit_fecha_vencimiento 
    // monto pagaré -> edit_monto_pagare 
    // numero de cuotas -> edit_num_cuotas
    // monto de cada cuota -> edit_monto_cuota_pagare
    // bono hospedaje -> edit_bono_hospedaje
    // bono hospedaje internacional -> edit_bono_hospedaje_intern
    // monto texto del pagare -> edit_monto_pagare_text
    // Texto para el check 16 -> edit_texto_bono_hospedaje
    // Texto para el check 17 -> edit_texto_bono_int_hospedaje

    use PhpOffice\PhpWord\TemplateProcessor;

    include("metodos.php");
    include("conexion.php");
    require 'vendor/autoload.php'; //Librería para cargar documentos de word
    $content = "";


    //Se busca dentro de la base de datos el mayor numero de contacto 
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
    $nombres = $email = $apellidos = $ciudad = $ubicacionSala = $cedula = $contrato = "";
    $aniosContrato = $montoContrato = 0;
    $bonoQory = $bonoQoryInt = $pagareBoolean = $otroFormaPagoBoolean = false;
    $fechaActual = $fechaVencimiento = date("Y-m-d");
    // Variable para rastrear errores
    $errorNombres = $errorCedula = $errorApellidos = $errorUbicacionSala =  $errorCiudad = $errorCorreo = $erroraniosContrato = $errorMontoContrato = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombres = test_input($_POST["nombres"]);
        $email = test_input($_POST["email"]);
        $apellidos = test_input($_POST["apellidos"]);
        $ciudad = test_input($_POST["ciudad"]);
        $numCedula = test_input($_POST["cedula"]);
        $valida = (strlen($numCedula) == 10 && strlen($nombres) > 3 && strlen($apellidos) > 3 && strlen($ciudad) > 3 && strpos($email, "@") !== false);
        if ($valida) {
            $cedula = $numCedula;
            $contrato = "QT" . $ciudad;
            $nombre_cliente = $nombres . " " . $apellidos;
            $insercion = "INSERT INTO contratos (ciudad, nombre, fecha)     
                VALUES ('$ciudad', '$nombre_cliente', '$fechaActual')";

            if ($conexion->query($insercion) === TRUE) {
                //echo "Contrato creado exitosamente con numero: " . $contrato;
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
            if (strlen($ubicacionSala) <= 3) {
                $errorUbicacionSala = "La ubicación debe contener al menos 3 caracteres";
            }
            if (($aniosContrato == 0)) {
                $erroraniosContrato = "Ingrese la cantidad de años del contrato";
            }
            if ($montoContrato == 0) {
                $errorMontoContrato = "Ingrese el monto del contrato";
            }
        }
        $okBono = isset($_POST['bono_hospedaje']);
        if ($okBono == 1) {
            $bonoQory = true;
        } else {
            $bonoQory = false;
        }
        $okBonoInt = isset($_POST['bono_hospedaje_internacional']); 
        if($okBonoInt == 1){
            $bonoQoryInt = true;
        }else{
            $bonoQoryInt = false;
        }

        $funciones = new DocumentGenerator();
        $funciones->generarDiferimiento($contrato, $numero_sucesivo, $ciudad, $numCedula, $fechaActual, $nombre_cliente);
        $funciones->generarVerificacion($nombre_cliente, $numero_sucesivo, $numCedula);
        $funciones->generarBeneficiosAlcance($contrato, $numero_sucesivo, $nombre_cliente, $numCedula, $bonoQory, $bonoQoryInt);
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

        <!-- Ubicacion de la sala -->
        Ubicación de la sala: <input type="text" name="ubicacion_sala" value="<?php echo $ubicacionSala; ?>">
        <?php if (!empty($errorUbicacionSala)) {
            echo "<span style='color: red;'>$errorUbicacionSala</span>";
        } ?>
        <br><br>

        <!-- Años del contrato -->
        Años del contrato: <input type="number" name="anios_contrato" value="<?php echo $aniosContrato; ?>">
        <?php if (!empty($erroraniosContrato)) {
            echo "<span style='color: red;'>$erroraniosContrato</span>";
        } ?>
        <br><br>

        <!-- Monto del contrato -->
        Monto del contrato: <input type="number" name="monto_contrato" value="<?php echo $montoContrato; ?>">
        <?php if (!empty($errorMontoContrato)) {
            echo "<span style='color: red;'>$errorMontoContrato</span>";
        } ?>
        <br><br>

        <!-- Forma de pago (añadir más de una) -->
        Forma de pago:
        <br>
        <input type="checkbox" name="forma_pago[]" value="<?php echo $pagareBoolean; ?>" id="pagareCheckbox"> Pagare <br>
        <input type="checkbox" name="forma_pago[]" value="<?php echo $otroFormaPagoBoolean; ?>" id="otroCheckbox"> Otro (Tipo, Cantidad) <br>
        <br>

        <!-- Campos adicionales para "Pagare" -->
        <?php
        if (isset($_POST['forma_pago']) && in_array('pagare', $_POST['forma_pago'])) {
            echo 'Monto: <input type="text" name="monto_pagare"><br>';
            echo 'Fecha: <input type="text" name="fecha_pagare"><br>';
        }
        ?>
        <!-- Fecha de vencimiento -->
        Fecha de vencimiento: <input type="date" name="fecha_vencimiento" value="<?php echo $fechaVencimiento; ?>">
        <br><br>

        <!-- Bono hospedaje Qory Loyalty -->
        Bono hospedaje Qory Loyalty: <input type="checkbox" name="bono_hospedaje" id="bono_hospedaje_checkbox" value="1">

        <br><br>

        <!-- Bono de hospedaje internacional Qory Loyalty -->
        Bono de hospedaje internacional Qory Loyalty: <input type="checkbox" name="bono_hospedaje_internacional" id="bono_hospedaje_internacional_checkbox" value="<?php echo $bonoQoryInt ?>">
        <br><br>


        <!-- Aquí está el botón para ejecutar el código -->
        <div class="divBoton">
            <input type="submit" name="submit" value="Generar Documentos">
        </div>
    </form>

</body>

</html>