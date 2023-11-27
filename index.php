<!DOCTYPE html>
<html>

<head>
    <title class="titulo">Formulario PHP</title>

    <link rel="stylesheet" href="style_formulario.css">
</head>

<body>
    <?php
    session_start();
    $usuarioLogin =  $_SESSION['usuario']; ?>

    <script>
        var listaFormasPago = [];
        var pagareBoolean = false;

        function functionAgregar() {
            event.preventDefault();
            const valor = document.getElementById("monto_forma_pago");
            const forma = document.getElementById("forma_pago");
            const formaValue = forma.value;
            const valorValue = valor.value;
            if (valorValue === "" || formaValue === "") {
                alert("Por favor, complete todos los campos antes de agregar una forma de pago.");
            } else {
                var cadena = "$" + valorValue + " con " + formaValue;
                listaFormasPago.push(cadena);
                console.log("Lista");
                listaFormasPago.forEach((element) => console.log(element));
                valor.value = "";
                forma.value = "";
                document.getElementById("formas_pago").value = JSON.stringify(listaFormasPago);
                alert("Se agregó: " + cadena);
            }
        }

        function functionAgregarPagare() {
            if (pagareBoolean == true) {
                alert("Ya se agrego un Pagaré previamente");
            } else {
                event.preventDefault();
                const valor = document.getElementById("valor_pagare");
                const fecha = document.getElementById("fecha_pago_pagare");
                const cuotas = document.getElementById("n_cuotas_pagare");
                const valorValue = valor.value;
                const fechaValue = fecha.value;
                const cuotasValue = cuotas.value;
                if (valorValue === "" || fechaValue === "" || cuotasValue === "") {
                    alert("Por favor, complete todos los campos antes de agregar el Pagaré.");
                } else {
                    document.getElementById("pagare_cuotas_info").value = JSON.stringify(cuotasValue);
                    document.getElementById("pagare_monto_info").value = JSON.stringify(valorValue);
                    document.getElementById("pagare_fecha_info").value = JSON.stringify(fechaValue);
                    var cadena = "$" + valorValue + " con Pagaré Fecha: " + fechaValue;
                    listaFormasPago.push(cadena);
                    console.log("Lista");
                    listaFormasPago.forEach((element) => console.log(element));
                    valor.value = "";
                    fecha.value = "";
                    cuotas.value = "";
                    document.getElementById("formas_pago").value = JSON.stringify(listaFormasPago);
                    document.getElementById("contiene_pagare").value = "true";
                    pagareBoolean = true;
                    alert("Se agregó: " + cadena);
                }
            }

        }

        function functionAgregarCreditoDirecto() {
            event.preventDefault();
            const creditoDirectoValor = document.getElementById("monto_credito_directo");
            const creditoDirectoFecha = document.getElementById("fecha_inicio_cred_dir");
            const creditoDirectoNumCuotas = document.getElementById("meses_credito_directo");
            const creditoDirectoAbono = document.getElementById("abono_credito_directo");
            const CDValor = creditoDirectoValor.value;
            const CDFechaIni = creditoDirectoFecha.value;
            const CDNumCuotas = creditoDirectoNumCuotas.value;
            const CDAbono = creditoDirectoAbono.value;
            console.log(CDValor, CDFechaIni, CDNumCuotas, CDAbono);
            if (CDValor == "" || CDFechaIni == "" || CDNumCuotas == "") {
                alert("Por favor complete todos los campos del Credito Directo");
            } else {
                document.getElementById("cred_dir_fecha_inicio").value = JSON.stringify(CDFechaIni);
                document.getElementById("cred_dir_num_cuotas").value = JSON.stringify(CDNumCuotas);
                document.getElementById("cred_dir_valor").value = JSON.stringify(CDValor);
                document.getElementById("cred_dir_abono").value = JSON.stringify(CDAbono);
                listaFormasPago.push("Se inserto un Credito Directo");
                document.getElementById("contiene_credito_directo").value = "true";
                document.getElementById("formas_pago").value = JSON.stringify(listaFormasPago);
                alert("Se agrego un Credito Directo");
            }

        }
        document.addEventListener("DOMContentLoaded", function() {
            const pagareCheckbox = document.getElementById("pagareCheckbox");
            const otroCheckbox = document.getElementById("otroCheckbox");
            const credDirectoCheckBox = document.getElementById("creditoDirectoCheckbox");
            const pagareFields = document.getElementById("divPagareCheckbox");
            const otroFields = document.getElementById("divOtrosCheckbox");
            const creditoDirectoFields = document.getElementById("divCreditoDirectoCheckBox");
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
            credDirectoCheckBox.addEventListener("change", function() {
                if (credDirectoCheckBox.checked) {
                    console.log("Esta entrando al metodo de credito directo");
                    creditoDirectoFields.style.display = "flex";
                    creditoDirectoFields.style.alignItems = "center";

                } else {
                    creditoDirectoFields.style.display = "none";
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
    // Texto de monto del contrato -> edit_texto_anios_contrato
    // creditoDirecto - saldo previo -> edit_saldo_previo_1 
    // CreditoDIrecto - fecha pago -> edit_fecha_pago_1
    // CreditoDirecto - cuotas restantes -> edit_cuotas_rest_1
    // CreditoDirecto - pago mensual -> edit_pago_mensual_1
    // CreditoDirecto - Saldo a la fecha -> edit_saldo_fecha_1
    // CheckList Anexo 2-> edit_anexo2
    // Anexo  3 clausula CD -> edit_clausula_CD

    use PhpOffice\PhpWord\TemplateProcessor;

    include("metodos.php");
    include("conexion.php");
    require 'vendor/autoload.php'; //Librería para cargar documentos de word
    $content = "";
    //Se busca dentro de la base de datos el mayor numero de contacto 
    $consulta = "SELECT MAX(contrato_id) AS max_numero FROM contratos"; //Consulta SQL 
    $resultado = $conexion->query($consulta); //Se almacena lo obtenido en una variable 
    if ($resultado) {
        //Si existe el resultado se asigna un nuevo número 
        $fila = $resultado->fetch_assoc();
        $numero_sucesivo = $fila['max_numero'] + 1;
        echo ($numero_sucesivo);
    } else {
        $numero_sucesivo = 1; // Si no hay contratos en la base de datos
        echo ("no esta entrando dentro del if");
    }

    $nombres = $email = $apellidos = $ciudad = $provincia = $ubicacionSala = $cedula = $contrato = $formasPago = $pagareText = $montoCuotaPagare = "";
    $aniosContrato = $montoContrato = $numCuotas =  $valor_pagare =  0;
    $bonoQory = $bonoQoryInt = $pagareBoolean = $otroFormaPagoBoolean = $contienePagare = $contieneCreditoDirecto =  false;
    date_default_timezone_set('America/Guayaquil');
    $fechaActual = $fechaVencimiento = $fechaInicioCredDir = date("Y-m-d");
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
            $ciudad_diccionario = [
                "Quito" => "UIO",
                "quito" => "UIO",
                "Guayaquil" => "GYE",
                "guayaquil" => "GYE",
                "santo domingo" => "STO",
                "Santo domingo" => "STO",
                "Santo Domingo" => "STO",
            ];
            if (array_key_exists($ciudad, $ciudad_diccionario)) {
                $codigo_ciudad = $ciudad_diccionario[$ciudad];
                if ($contieneCreditoDirecto) {
                    $contrato = "CD_QT" . $codigo_ciudad;
                } else {
                    $contrato = "QT" . $codigo_ciudad;
                }
            } else {
                $codigo_ciudad = $ciudad;
                if ($contieneCreditoDirecto) {
                    $contrato = "CD_QT" . $codigo_ciudad;
                } else {
                    $contrato = "QT" . $codigo_ciudad;
                }
            }

            $nombre_cliente = $nombres . " " . $apellidos;

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
            //Adquirir valores pasados desde JS 
            $numCuotas = json_decode($_POST["pagare_cuotas_info"]);
            $valorPagare = json_decode($_POST["pagare_monto_info"]);
            $fechaVencimiento = json_decode($_POST["pagare_fecha_info"]);
            $formasPagoString = json_decode($_POST["formas_pago"]);
            $fechaInicioCredDir = json_decode($_POST["cred_dir_fecha_inicio"]);
            $numCuotasCredDir = json_decode($_POST["cred_dir_num_cuotas"]);
            $montoCredDir = json_decode($_POST["cred_dir_valor"]);
            $abonoCredDir = json_decode($_POST["cred_dir_abono"]);
            echo ($fechaInicioCredDir);
            echo ($numCuotasCredDir);
            echo ($montoCredDir);
            echo ($abonoCredDir);
            $montoPagado = $montoContrato - $valorPagare;
            //Comentario y generación del Query de inserción
            $comentario = ($valorPagare != 0) ? "Fecha Pagare: " . $fechaVencimiento : "";
            $insercion2 = "INSERT INTO contratos (contrato_id, codigo, cedula, titular, valor_contrato, valor_pagado, pagare_valor, usuario, email, comentario)
            VALUES ($numero_sucesivo, '$contrato', '$cedula', '$nombre_cliente', " . floatval($montoContrato) . ", " . floatval($montoPagado) . ", " . floatval($valorPagare) . ", '$usuarioLogin', '$email', ' Fecha del pagare  $fechaVencimiento');";


            if ($formasPagoString == "") {
                echo ("Inserte una forma de pago");
            } else {
                foreach ($formasPagoString as $forma) {
                    $formasPago = $formasPago . $forma . "\n \n";
                }
                $contienePagare = (json_decode($_POST["contiene_pagare"]) == "true");
                $contieneCreditoDirecto = (json_decode($_POST["contiene_credito_directo"]) == "true");
                $funciones = new DocumentGenerator();
                $rutaCarpetaSave = $funciones->crearCarpetaCliente($nombre_cliente, $fechaActual);
                //echo($rutaCarpetaSave); 
                $funciones->generarVerificacion($nombre_cliente, $numero_sucesivo, $numCedula, $rutaCarpetaSave);
                $funciones->generarDiferimiento($contrato, $numero_sucesivo, $ciudad, $numCedula, $fechaActual, $nombre_cliente, $rutaCarpetaSave);
                if ($contieneCreditoDirecto != 1 && $contienepagare != 1) {
                    $funciones->generarContrato($contrato, $nombre_cliente, $numero_sucesivo, $numCedula, $montoContrato, $aniosContrato, $formasPagoString, $email, $fechaActual, $ciudad, $rutaCarpetaSave);
                    $funciones->generarBeneficiosAlcance($contrato, $numero_sucesivo, $nombre_cliente, $numCedula, $bonoQory, $bonoQoryInt, $rutaCarpetaSave, true);
                    $funciones->generarCheckList($contrato, $numero_sucesivo, $ciudad, $provincia,  $numCedula, $email, $fechaActual, $nombre_cliente, $ubicacionSala, $rutaCarpetaSave, "Descuento para pagos con tarjeta");
                }
                if ($contieneCreditoDirecto == 1) {
                    
                    $funciones->generarCheckList($contrato, $numero_sucesivo, $ciudad, $provincia,  $numCedula, $email, $fechaActual, $nombre_cliente, $ubicacionSala, $rutaCarpetaSave, "Débito Automatico");
                    $funciones->generarBeneficiosAlcance($contrato, $numero_sucesivo, $nombre_cliente, $numCedula, $bonoQory, $bonoQoryInt, $rutaCarpetaSave, false);
                    $funciones->generarContrato($contrato, $nombre_cliente, $numero_sucesivo, $numCedula, $montoContrato, $aniosContrato, $formasPagoString, $email, $fechaActual, $ciudad, $rutaCarpetaSave);
                    echo(gettype($fechaInicioCredDir));
                    $funciones->generarPagaresCredito($fechaInicioCredDir, $montoCredDir, $numCuotasCredDir,$rutaCarpetaSave,$numero_sucesivo,$nombre_cliente)  ;
                }
                if ($contienePagare == 1) {
                    
                    $funciones->generarContrato($contrato, $nombre_cliente, $numero_sucesivo, $numCedula, $montoContrato, $aniosContrato, $formasPagoString, $email, $fechaActual, $ciudad, $rutaCarpetaSave);
                    $funciones->generarBeneficiosAlcance($contrato, $numero_sucesivo, $nombre_cliente, $numCedula, $bonoQory, $bonoQoryInt, $rutaCarpetaSave, true);
                    $funciones->generarCheckList($contrato, $numero_sucesivo, $ciudad, $provincia,  $numCedula, $email, $fechaActual, $nombre_cliente, $ubicacionSala, $rutaCarpetaSave, "Descuento para pagos con tarjeta");
                    $funciones->generarPagare($nombre_cliente, $numCedula, $numero_sucesivo, $fechaVencimiento, $ciudad, $email, $valorPagare, $fechaActual, $numCuotas, $montoCuotaPagare, $pagareText, $rutaCarpetaSave);
                }
                $nombres = $email = $cedula = $apellidos = $ciudad = $numCedula = $provincia = $ubicacionSala = $aniosContrato = $montoContrato = "";
                echo ("Los documentos se generaron correctamente. \n");
                if ($conexion->query($insercion2) === TRUE) {
                    echo "Contrato creado exitosamente con numero: " . $contrato .  $numero_sucesivo;
                } else {
                    echo "Error al crear el contrato: " . $conexion->error;
                }
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

    <form class="formularioBox" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h2 class="tituloH2">Formulario para Contratos</h2>
        <h2>Bienvenido <?php echo $usuarioLogin; ?></h2>
        <!-- Hidden -->
        <input type="hidden" id="formas_pago" name="formas_pago">
        <input type="hidden" id="pagare_cuotas_info" name="pagare_cuotas_info">
        <input type="hidden" id="pagare_monto_info" name="pagare_monto_info">
        <input type="hidden" id="pagare_fecha_info" name="pagare_fecha_info">
        <input type="hidden" id="contiene_pagare" name="contiene_pagare">

        <input type="hidden" id="contiene_credito_directo" name="contiene_credito_directo">
        <input type="hidden" id="cred_dir_fecha_inicio" name="cred_dir_fecha_inicio">
        <input type="hidden" id="cred_dir_num_cuotas" name="cred_dir_num_cuotas">
        <input type="hidden" id="cred_dir_valor" name="cred_dir_valor">
        <input type="hidden" id="cred_dir_abono" name="cred_dir_abono">

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
        Provincia: <select class="select-provincia" name="provincia">
            <?php
            $provincias = array(
                "Azuay", "Bolívar", "Cañar", "Carchi", "Chimborazo", "Cotopaxi", "El Oro", "Esmeraldas",
                "Galápagos", "Guayas", "Imbabura", "Loja", "Los Ríos", "Manabí", "Morona Santiago",
                "Napo", "Orellana", "Pastaza", "Pichincha", "Santa Elena", "Santo Domingo",
                "Sucumbíos", "Tungurahua", "Zamora Chinchipe"
            );

            foreach ($provincias as $p) {
                $selected = ($p === $provincia) ? 'selected' : '';
                echo "<option value='$p' $selected>$p</option>";
            }
            ?>
        </select>

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
            <input type="number" id="valor_pagare" name="valor_pagare" placeholder="Ingrese el valor" style="margin-right:10px">
            <label for="n_cuotas" style="margin-right:10px">N° Cuotas:</label>
            <input type="number" id="n_cuotas_pagare" name="n_cuotas_pagare" placeholder="Num de Cuotas" style="margin-right:10px">
            <label for="fechaPago" style="margin-right:10px">Fecha de Pago:</label>
            <input type="date" id="fecha_pago_pagare" name="fechaPago" style="margin-right:10px">
            <button onclick="functionAgregarPagare()">+</button>
        </div>
        <input type="checkbox" value="<?php echo $pagareBoolean; ?>" id="creditoDirectoCheckbox"> Crédito Directo <br>
        <div id="divCreditoDirectoCheckBox" style="display:none; margin-top:10px; margin-bottom: 5px">
            <label for="montoCredDir" style="margin-right:10px">Valor:</label>
            <input type="number" id="monto_credito_directo" name="montoCredDir" placeholder="Valor: " style="margin-right:10px; width : 80px">
            <label for="abonoCredDir" style="margin-right:10px">Abono:</label>
            <input type="number" id="abono_credito_directo" name="abonoCredDir" placeholder="Abono: " style="margin-right:10px; width : 80px">
            <label for="mesesCredDir" style="margin-right:10px"># Meses: </label>
            <select id="meses_credito_directo" name="mesesCredDir" style="margin-right:10px">
                <option value="12">12</option>
                <option value="24">24</option>
                <option value="36">36</option>
            </select>
            <label for="fechaInicioCredDir" style="margin-right:10px">Fecha de Inicio:</label>
            <input type="date" id="fecha_inicio_cred_dir" name="fechaInicioCredDir" style="margin-right:10px">
            <button onclick="functionAgregarCreditoDirecto()">+</button>
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