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
class DocumentGenerator {


    public function generarDiferimiento($contrato, $numero_sucesivo, $ciudad, $numCedula, $fechaActual, $nombre_cliente) {
        global $meses;
        list($ano, $mes, $dia) = explode('-', $fechaActual);
        $fechaFormateada = $dia. " de " . $meses[intval($mes)] . " del ". $ano; 
        $templateWord = new TemplateProcessor("docs/DIFERIMIENTO QORIT.docx");
        $nombre_cliente = strtoupper($nombre_cliente);
        $ciudad = strtoupper($ciudad); 
        $templateWord->setValue('edit_contrato_id', $contrato);
        $templateWord->setValue('edit_num_cliente', $numero_sucesivo);
        $templateWord->setValue('edit_ciudad', $ciudad);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_fecha_contrato', $fechaFormateada);
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $pathToSave = 'nuevosDocumentos/DiferimientoEditado'. $numero_sucesivo .'.docx';
        $templateWord->saveAs($pathToSave);
    }
    public function generarVerificacion($nombre_cliente,$numero_sucesivo, $numCedula){
        $nombre_cliente = strtoupper($nombre_cliente);
        $templateWord = new TemplateProcessor("docs/VERIFICACION.docx");    
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $pathToSave = 'nuevosDocumentos/VerificacionEditado'. $numero_sucesivo .'.docx';
        $templateWord->saveAs($pathToSave);
    }

    public function generarBeneficiosAlcance($contrato, $numero_sucesivo, $nombre_cliente, $numCedula, $bonoQory, $bonoQoryInt ){
        $nombre_cliente = strtoupper($nombre_cliente);
        echo ("Valor Qori Cond 1: " . $bonoQory);
        echo ("Valor Qori COnd 2: " . $bonoQoryInt);
        $titulo_bono = "16. BONO DE HOSPEDAJE QORY LOYALTY: ";
        $texto_bono= "Acepto y recibo UN Bono de Hospedaje 3 Noches 2 Días para 06 personas. Previo pago de Impuestos. Uso exclusivo en departamentos de la compañía. No incluye ningún tipo de alimentación"; 
        $titulo_bonoInt = "17. BONO DE HOSPEDAJE INTERNACIONAL QORY LOYALTY: ";
        $texto_bonoInt = "Acepto y recibo Un Bono de Hospedaje 4 Noches 5 Días para 05 personas. Previo pago de Impuestos, si incluye alimentación. PREVIA RESERVA. Destino: Cancún - México";   
        $templateWord = new TemplateProcessor("docs/ANEXO 3 BENEFICIOS ALCANCE DE LA OFERTA.docx"); 
        $templateWord->setValue('edit_nombres_apellidos', $nombre_cliente);
        $templateWord->setValue('edit_contrato_id', $contrato);
        $templateWord->setValue('edit_numero_cedula', $numCedula);
        $templateWord->setValue('edit_num_cliente', $numero_sucesivo);
        if($bonoQory){
            $templateWord->setValue('edit_bono_hospedaje', $titulo_bono);
            $templateWord->setValue('edit_texto_bono_hospedaje', $texto_bono);
            
        }else{
            $templateWord->setValue('edit_bono_hospedaje', "");
            $templateWord->setValue('edit_texto_bono_hospedaje', "");
        }
        if($bonoQoryInt){
            $templateWord->setValue('edit_bono_hospedaje_intern', $titulo_bonoInt);
            $templateWord->setValue('edit_texto_bono_hospedaje_intern', $texto_bonoInt);
            $templateWord->setValue('edit_bono_hospedaje', $titulo_bono);
            $templateWord->setValue('edit_texto_bono_hospedaje', $texto_bono);
        }else{
            $templateWord->setValue('edit_bono_hospedaje_intern', "");
            $templateWord->setValue('edit_texto_bono_hospedaje_intern', "");
            $templateWord->setValue('edit_bono_hospedaje', "");
            $templateWord->setValue('edit_texto_bono_hospedaje', "");

        }
        $pathToSave = 'nuevosDocumentos/Anexo3Editado'. $numero_sucesivo .'.docx';
        $templateWord->saveAs($pathToSave);


    }

    public function generarContrato() {

        $templateWord = new TemplateProcessor("docs/Contrato de agencia de viajes_QORIT.docx");
    }

    public function generarPagare(){
        $templateWord = new TemplateProcessor("docs/PAGARE QORIT.docx");
    }

    public function generarCheckList(){
        $templateWord = new TemplateProcessor("docs/CHECK LIST QORIT.docx");
    }


    

}

    
?>
