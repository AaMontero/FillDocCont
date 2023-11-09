<!DOCTYPE html>
<html>

<head>
    <title class="titulo">Formulario PHP</title>
    <link rel="stylesheet" href="style_formulario.css">
</head>

<body>


    <script>
        var listaFormasPago = [];

        function functionAgregar() {
            event.preventDefault();
            const valor = document.getElementById("monto_forma_pago");
            const valorValue = valor.value;
            const forma = document.getElementById("forma_pago");
            const formaValue = forma.value;
            var cadena = "$" + valorValue + " con " + formaValue;
            listaFormasPago.push(cadena);
            console.log("Lista");
            listaFormasPago.forEach((element) => console.log(element));
            valor.value = "";
            forma.value = "";
            document.getElementById("formas_pago").value = JSON.stringify(listaFormasPago);
            alert("Se agrego: " + cadena);
        }

        function functionAgregarPagare() {
            event.preventDefault();
            const valor = document.getElementById("valor_pagare");
            const valorValue = valor.value;
            const fecha = document.getElementById("fecha_pago_pagare");
            const fechaValue = fecha.value;
            var cadena = "$" + valorValue + " con Pagaré Fecha:  " + fechaValue;
            listaFormasPago.push(cadena);
            console.log("Lista");
            listaFormasPago.forEach((element) => console.log(element));
            valor.value = "";
            fecha.value = "";
            document.getElementById("formas_pago").value = JSON.stringify(listaFormasPago);
            alert("Se agrego: " + cadena);
        }
        document.addEventListener("DOMContentLoaded", function() {

            const pagareCheckbox = document.getElementById("pagareCheckbox");
            const otroCheckbox = document.getElementById("otroCheckbox");
            const pagareFields = document.getElementById("divPagareCheckbox");
            const otroFields = document.getElementById("divOtrosCheckbox");

            pagareCheckbox.addEventListener("change", function() {
                if (pagareCheckbox.checked) {
                    console.log("Esta entrando a este metodo");
                    pagareFields.style.display = "flex";
                    pagareFields.style.alignItems = "center";
                } else {
                    pagareFields.style.display = "none";
                }
            });

            otroCheckbox.addEventListener("change", function() {
                if (otroCheckbox.checked) {
                    console.log("Esta entrando a este metodo otros");
                    otroFields.style.display = "flex";
                    otroFields.style.alignItems = "center";
                } else {
                    otroFields.style.display = "none";
                }
            });
        });
    </script>
    <?php
    // Cedula -> edit_numero_cedula 
    // Nombres y apellidos -> edit_nombres_apellidos 
    // RUC -> edit_RUC
    // fechaActual -> edit_fecha_contrato
    // ciudad -> edit_ciudad
    // provincia -> edit_provincia
    // correo -> edit_email 
    // contrato -> edit_contrato_id
    // lugar de la sala -> edit_sala_lugar
    // numero de cliente -> edit_num_cliente
    // años del contrato -> edit_anios_contrato
    // monto del contrato -> edit_monto_contrato 
    // monto en letras del contrato -> edit_monto_contrato_texto
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
    // Numero de cuotas pagare -> edit_num_cuotas 

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
    $nombres = $email = $apellidos = $ciudad  = $provincia = $ubicacionSala = $cedula = $contrato = $formasPago = $pagareText = $montoCuotaPagare = "";
    $aniosContrato = $montoContrato = $numCuotas=  $valor_pagare =  0;
    $bonoQory = $bonoQoryInt = $pagareBoolean = $otroFormaPagoBoolean = false;
    $fechaActual = $fechaVencimiento = date("Y-m-d");
    // Variable para rastrear errores
    $errorNombres = $errorCedula = $errorApellidos = $errorUbicacionSala =  $errorCiudad = $errorCorreo = $erroraniosContrato = $errorMontoContrato = $errorProvincia = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombres = test_input($_POST["nombres"]);
        $email = test_input($_POST["email"]);
        $apellidos = test_input($_POST["apellidos"]);
        $ciudad = test_input($_POST["ciudad"]);
        $numCedula = test_input($_POST["cedula"]);
        $provincia = test_input($_POST["provincia"]);
        $ubicacionSala = test_input($_POST["ubicacion_sala"]);
        $aniosContrato = test_input($_POST["anios_contrato"]);
        $montoContrato = test_input($_POST["monto_contrato"]);
        $valida = (strlen($numCedula) == 10 && strlen($nombres) > 3 && strlen($apellidos) > 3 && strlen($ciudad) > 3 && strpos($email, "@") !== false &&  strlen($ubicacionSala) > 3 && $aniosContrato != 0 && $montoContrato != 0 && strlen($provincia) > 3);
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
            $okBono = isset($_POST['bono_hospedaje']); 
            if ($okBono == 1) {
                $bonoQory = true;
            } else {
                $bonoQory = false;
            }
            $okBonoInt = isset($_POST['bono_hospedaje_internacional']);
            if ($okBonoInt == 1) {
                $bonoQoryInt = true;
            } else {
                $bonoQoryInt = false;
            }
            $formasPagoString = json_decode($_POST["formas_pago"]);
            foreach ($formasPagoString as $forma) {
                $formasPago = $formasPago.$forma.'\n'; 
                
            }
            $funciones = new DocumentGenerator();
            $funciones->generarDiferimiento($contrato, $numero_sucesivo, $ciudad, $numCedula, $fechaActual, $nombre_cliente);
            $funciones->generarVerificacion($nombre_cliente, $numero_sucesivo, $numCedula);
            $funciones->generarBeneficiosAlcance($contrato, $numero_sucesivo, $nombre_cliente, $numCedula, $bonoQory, $bonoQoryInt);
            $funciones->generarCheckList($contrato, $numero_sucesivo, $ciudad, $provincia,  $numCedula, $email, $fechaActual, $nombre_cliente, $ubicacionSala);
            $funciones->generarContrato($contrato, $nombre_cliente, $numero_sucesivo, $numCedula , $montoContrato, $aniosContrato, $formasPago, $email ,$fechaActual, $ciudad); 
            $funciones->generarPagare($nombre_cliente, $numCedula, $numero_sucesivo, $fechaVencimiento, $ciudad, $email, 1500 /*$valor_pagare*/, $fechaActual, 1/*$numCuotas*/,$montoCuotaPagare ,$pagareText); 
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
            if (strlen($provincia) <= 3) {
                $errorProvincia = "La provincia debe contener al menos 3 caracteres";
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
        <!-- Hidden -->
        <input type="hidden" id="formas_pago" name="formas_pago">
        <!-- Nombres -->
        Nombres: <input type="text" name="nombres" value="<?php echo $nombres; ?>">
        <?php if (!empty($errorNombres)) {
            echo "<span style='color: red;'>$errorNombres</span>";
        } ?>
        <br><br>
        <!-- Apellidos -->
        Apellidos: <input type="text" name="apellidos" value="<?php echo $apellidos; ?>">
        <?php if (!empty($errorApellidos)) {
            echo "<span style='color: red;'>$errorApellidos</span>";
        } ?>
        <br><br>
        <!-- Cédula -->
        Cedula: <input type="text" name="cedula" value="<?php echo $cedula; ?>">
        <?php if (!empty($errorCedula)) {
            echo "<span style='color: red;'>$errorCedula</span>";
        } ?>
        <br>
        <br>
        <!-- Email -->
        Correo Electrónico: <input type="text" name="email" value="<?php echo $email; ?>">
        <?php if (!empty($errorCorreo)) {
            echo "<span style='color: red;'>$errorCorreo</span>";
        } ?>
        <br><br>
        <!-- Ciudad -->
        Ciudad: <input type="text" name="ciudad" value="<?php echo $ciudad; ?>">
        <?php if (!empty($errorCiudad)) {
            echo "<span style='color: red;'>$errorCiudad</span>";
        } ?>
        <br><br>
        <!-- Provincia -->
        Provincia: <select class="select-provincia" type="text" name="provincia" value="<?php echo $provincia; ?>">
            <option value="Azuay" <?php if ($provincia === "Azuay") echo "selected"; ?>>Azuay</option>
            <option value="Bolivar" <?php if ($provincia === "Bolívar") echo "selected"; ?>>Bolívar</option>
            <option value="Canar" <?php if ($provincia === "Canar") echo "selected"; ?>>Cañar</option>
            <option value="Carchi" <?php if ($provincia === "Carchi") echo "selected"; ?>>Carchi</option>
            <option value="Chimborazo" <?php if ($provincia === "Chimborazo") echo "selected"; ?>>Chimborazo</option>
            <option value="Cotopaxi" <?php if ($provincia === "Cotopaxi") echo "selected"; ?>>Cotopaxi</option>
            <option value="El Oro" <?php if ($provincia === "El Oro") echo "selected"; ?>>El Oro</option>
            <option value="Esmeraldas" <?php if ($provincia === "Esmeraldas") echo "selected"; ?>>Esmeraldas</option>
            <option value="Galapagos" <?php if ($provincia === "Galapagos") echo "selected"; ?>>Galápagos</option>
            <option value="Guayas" <?php if ($provincia === "Guayas") echo "selected"; ?>>Guayas</option>
            <option value="Imbabura" <?php if ($provincia === "Imbabura") echo "selected"; ?>>Imbabura</option>
            <option value="Loja" <?php if ($provincia === "Loja") echo "selected"; ?>>Loja</option>
            <option value="Los Rios" <?php if ($provincia === "Los Rios") echo "selected"; ?>>Los Ríos</option>
            <option value="Manabi" <?php if ($provincia === "Manabi") echo "selected"; ?>>Manabí</option>
            <option value="Morona" <?php if ($provincia === "Morona") echo "selected"; ?>>Morona Santiago</option>
            <option value="Napo" <?php if ($provincia === "Napo") echo "selected"; ?>>Napo</option>
            <option value="Orellana" <?php if ($provincia === "Orellana") echo "selected"; ?>>Orellana</option>
            <option value="Pastaza" <?php if ($provincia === "Pastaza") echo "selected"; ?>>Pastaza</option>
            <option value="Pichincha" <?php if ($provincia === "Pichincha") echo "selected"; ?>>Pichincha</option>
            <option value="Santa Ana" <?php if ($provincia === "Santa Ana") echo "selected"; ?>>Santa Elena</option>
            <option value="Santo domingo " <?php if ($provincia === "Santo Domingo ") echo "selected"; ?>>Santo Domingo </option>
            <option value="Sucumbios" <?php if ($provincia === "Sucumbios") echo "selected"; ?>>Sucumbíos</option>
            <option value="Tungurahua" <?php if ($provincia === "Tungurahua") echo "selected"; ?>>Tungurahua</option>
            <option value="Zamora Chinchipe" <?php if ($provincia === "Zamora Chinchipe") echo "selected"; ?>>Zamora Chinchipe</option>
        </select>
    <!-- Agrega más provincias según tus necesidades -->
                
        <?php if (!empty($errorProvincia)) {
            echo "<span style='color: red;'>$errorProvincia</span>";
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
        <input type="checkbox" name="forma_pago" value="<?php echo $pagareBoolean; ?>" id="pagareCheckbox"> Pagaré <br>
        <div id="divPagareCheckbox" style="display:none ; margin-top:10px ; margin-bottom: 5px">
            <label for="valor" style="margin-right:10px">Valor:</label>
            <input type="number" id="valor_pagare" name="valor" placeholder="Ingrese el valor" style="margin-right:10px">
            <label for="fechaPago" style="margin-right:10px">Fecha de Pago:</label>
            <input type="date" id="fecha_pago_pagare" name="fechaPago" style="margin-right:10px">
            <button onclick="functionAgregarPagare()">+</button>
        </div>

        <input type="checkbox" value="<?php echo $otroFormaPagoBoolean; ?>" id="otroCheckbox"> Otro <br>
        <div id="divOtrosCheckbox" style="display:none; margin-top:10px; margin-bottom: 5px">
            <label for="valor" style="margin-right:10px">Valor:</label>
            <input type="number" id="monto_forma_pago" name="montoPago" placeholder="Ingrese el valor" style="margin-right:10px">
            <label for="formaPago" style="margin-right:10px">Forma:</label>
            <input type="text" id="forma_pago" name="formaPago" style="margin-right:10px">
            <button onclick="functionAgregar()">+</button>
        </div>
        <br>
        <ul id="listaFormasPagoUl"></ul>

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