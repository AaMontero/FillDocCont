<?php

use PhpOffice\PhpWord\TemplateProcessor;

include("conexion.php");
require 'vendor/autoload.php';
$meses = array(
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
);
class DocumentGenerator
{
    public function generarDiferimiento($contrato, $numero_sucesivo, $ciudad, $numCedula, $fechaActual, $nombre_cliente)
    {
        global $meses;
        list($ano, $mes, $dia) = explode('-', $fechaActual);
        $fechaFormateada = $dia . " de " . $meses[intval($mes)] . " del " . $ano;
        $templateWord = new TemplateProcessor("docs/DIFERIMIENTO QORIT.docx");
        $nombre_cliente = strtoupper($nombre_cliente);
        $ciudad = strtoupper($ciudad);
        $templateWord->setValue('edit_contrato_id', $contrato);
        $templateWord->setValue('edit_num_cliente', $numero_sucesivo);
        $templateWord->setValue('edit_ciudad', $ciudad);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_fecha_contrato', $fechaFormateada);
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $pathToSave = 'contratos/QT'.$nombre_cliente.'/Diferimiento' . $numero_sucesivo . '.docx';
        $templateWord->saveAs($pathToSave);
    }
    public function generarVerificacion($nombre_cliente, $numero_sucesivo, $numCedula)
    {
        $nombre_cliente = strtoupper($nombre_cliente);
        $templateWord = new TemplateProcessor("docs/VERIFICACION.docx");
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $pathToSave = 'contratos/QT'.$nombre_cliente.'/VerificacionEditado' . $numero_sucesivo . '.docx';
        $templateWord->saveAs($pathToSave);
    }

    public function generarBeneficiosAlcance($contrato, $numero_sucesivo, $nombre_cliente, $numCedula, $bonoQory, $bonoQoryInt)
    {
        $nombre_cliente = strtoupper($nombre_cliente);
        $titulo_bono = "16. BONO DE HOSPEDAJE QORY LOYALTY: ";
        $texto_bono = "Acepto y recibo UN Bono de Hospedaje 3 Noches 2 Días para 06 personas. Previo pago de Impuestos. Uso exclusivo en departamentos de la compañía. No incluye ningún tipo de alimentación";
        $titulo_bonoInt = "17. BONO DE HOSPEDAJE INTERNACIONAL QORY LOYALTY: ";
        $texto_bonoInt = "Acepto y recibo Un Bono de Hospedaje 4 Noches 5 Días para 05 personas. Previo pago de Impuestos, si incluye alimentación. PREVIA RESERVA. Destino: Cancún - México";
        $templateWord = new TemplateProcessor("docs/ANEXO 3 BENEFICIOS ALCANCE DE LA OFERTA.docx");
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_contrato_id', $contrato);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_num_cliente', $numero_sucesivo);
        if ($bonoQory && !$bonoQoryInt) {
            $templateWord->setValue('edit_bono_hospedaje', $titulo_bono);
            $templateWord->setValue('edit_texto_bono_hospedaje', $texto_bono);
            $templateWord->setValue('edit_bono_hospedaje_intern', "");
            $templateWord->setValue('edit_texto_bono_hospedaje_intern', "");
        } else if (($bonoQoryInt && $bonoQory) || ($bonoQoryInt && !$bonoQory)) {
            $templateWord->setValue('edit_bono_hospedaje_intern', $titulo_bonoInt);
            $templateWord->setValue('edit_texto_bono_hospedaje_intern', $texto_bonoInt);
            $templateWord->setValue('edit_bono_hospedaje', $titulo_bono);
            $templateWord->setValue('edit_texto_bono_hospedaje', $texto_bono);
        } else {
            $templateWord->setValue('edit_bono_hospedaje_intern', "");
            $templateWord->setValue('edit_texto_bono_hospedaje_intern', "");
            $templateWord->setValue('edit_bono_hospedaje', "");
            $templateWord->setValue('edit_texto_bono_hospedaje', "");
        }
        $pathToSave = 'contratos/QT'.$nombre_cliente.'/Anexo3Editado' . $numero_sucesivo . '.docx';
        $templateWord->saveAs($pathToSave);
    }

    public function generarContrato($contrato, $nombre_cliente, $numero_sucesivo, $numCedula, $montoContrato, $aniosContrato, $formasPago, $email, $fechaActual, $ciudad)
    {
        $formasPagoS = ""; 
        $formasPagoArray = array();       
        foreach ($formasPago as $forma) {
            $formasPagoS .= $forma . "\n";
            $formasPagoArray[] = $forma; 
        }

        global $meses;
        list($ano, $mes, $dia) = explode('-', $fechaActual);
        $nombre_cliente = strtoupper($nombre_cliente);
        $fmt = new NumberFormatter('es', NumberFormatter::SPELLOUT);
        $montoContratoText = $fmt->format($montoContrato);
        $aniosContratoText = $fmt->format($aniosContrato);
        $aniosContratoText = strtoupper($aniosContratoText);
        $montoContratoText = strtoupper($montoContratoText);
        $fechaFormateada = $dia . " días del mes de " . $meses[intval($mes)] . ", año " . $ano;
        $templateWord = new TemplateProcessor("docs/Contrato de agencia de viajes_QORIT.docx");
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_contrato_id', $contrato);
        $templateWord->setValue('edit_num_cliente', $numero_sucesivo);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_monto_contrato', $montoContrato);
        $templateWord->setValue('edit_anios_contrato', $aniosContrato);
        for ($i = 1; $i <= count($formasPagoArray); $i++) {
            $templateWord->setValue("edit_forma_pago_$i", $formasPagoArray[$i - 1]);
        }
        for ($i = count($formasPagoArray); $i <= 5; $i++) {
            $templateWord->setValue("edit_forma_pago_$i", "");
        }
        $templateWord->setValue('edit_email', $email);
        $templateWord->setValue('edit_ciudad', $ciudad);
        $templateWord->setValue('edit_texto_anios_contrato', $aniosContratoText);
        $templateWord->setValue('edit_monto_contrato_texto', $montoContratoText);
        $templateWord->setValue('edit_fecha_texto', $fechaFormateada);
        $pathToSave = 'contratos/QT'.$nombre_cliente.'/ContratoEditado' . $numero_sucesivo . '.docx';
        $templateWord->saveAs($pathToSave);
    }
    public function generarPagare($nombre_cliente, $numCedula, $numero_sucesivo, $fechaVencimiento, $ciudad, $email, $valor_pagare, $fechaActual, $numCuotas, $montoCuotaPagare, $pagareText)
    {
        global $meses;
        list($ano, $mes, $dia) = explode('-', $fechaActual);
        list($ano2, $mes2, $dia2) = explode('-', $fechaVencimiento);
        $fechaFormateada = " a los " . $dia . " dias, del mes de " . $meses[intval($mes)] . " del " . $ano;
        $fechaFormatVencimiento = $dia2 . ' DE ' . strtoupper($meses[intval($mes2)]) . ' DEL ' . $ano2;
        $nombre_cliente = strtoupper($nombre_cliente);
        $fmt = new NumberFormatter('es', NumberFormatter::SPELLOUT);
        $pagareText = $fmt->format($valor_pagare);
        $pagareText = strtoupper($pagareText);
        $montoCuotaPagare = ($valor_pagare / $numCuotas);
        $templateWord = new TemplateProcessor("docs/PAGARE QORIT.docx");
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_fecha_vencimiento', $fechaFormatVencimiento);
        $templateWord->setValue('edit_ciudad', $ciudad);
        $templateWord->setValue('edit_email', $email);
        $templateWord->setValue('edit_num_cuotas', $numCuotas);
        $templateWord->setValue('edit_monto_pagare_text', $pagareText);
        $templateWord->setValue('edit_fecha_texto', $fechaFormateada);
        $templateWord->setValue('edit_monto_cuota_pagare', $montoCuotaPagare);
        $templateWord->setValue('edit_monto_pagare', $valor_pagare);
        $pathToSave = 'contratos/QT'.$nombre_cliente.'/pagareEditado' . $numero_sucesivo . '.docx';
        $templateWord->saveAs($pathToSave);
    }

    public function generarCheckList($contrato, $numero_sucesivo, $ciudad, $provincia,  $numCedula, $email, $fechaActual, $nombre_cliente, $ubicacionSala)
    {
        $nombre_cliente = strtoupper($nombre_cliente);
        $ubicacionSala = strtoupper($ubicacionSala);
        $ciudadMayu = strtoupper($ciudad);
        $ciudad = ucwords($ciudad);
        global $meses;
        list($ano, $mes, $dia) = explode('-', $fechaActual);
        $fechaFormateada = $dia . " de " . $meses[intval($mes)] . " del " . $ano;
        $templateWord = new TemplateProcessor("docs/CHECK LIST QORIT.docx");
        $templateWord->setValue('edit_contrato_id', $contrato);
        $templateWord->setValue('edit_num_cliente', $numero_sucesivo);
        $templateWord->setValue('edit_ciudad', $ciudad);
        $templateWord->setValue('edit_ciudad_mayu', $ciudadMayu);
        $templateWord->setValue('edit_provincia', $provincia);
        $templateWord->setValue('edit_fecha_contrato', $fechaActual);
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_sala_lugar', $ubicacionSala);
        $templateWord->setValue('edit_email', $email);
        $templateWord->setValue('edit_fecha_texto', $fechaFormateada);
        $pathToSave = 'contratos/QT'.$nombre_cliente.'/checkListEditado' . $numero_sucesivo . '.docx';
        $templateWord->saveAs($pathToSave);
    }
}
