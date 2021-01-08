<?php

namespace controllers;

use models\RecetaModel as RecetaModel;

require_once("../models/RecetaModel.php");
require_once("tcpdf_include.php");

class ExportarPDF
{
    public $id;


    public function __construct()
    {
        $this->id = $_GET['id'];
    }

    public function generarPDF()
    {
        $model = new RecetaModel();
        $arr = $model->recetasXId($this->id);
        $receta = $arr[0];

        //-------LLAMAR A LA LIBRERIA -----------

        // create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Optica-2020');
        $pdf->SetTitle('Reporte Receta ' . $receta['id']);
        $pdf->SetSubject('Optica Talca');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Optica Talca', 'Reporte de Receta ' . $receta['nombre_cliente'], array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        // Set some content to print


        $html = '
        <h2>Receta medica</h2>
        <br>
        <h4>datos personales</h4>
        <p>Nombre del cliente : ' . $receta['nombre_cliente'] . '</p>
        <p>Numero del cliente : ' . $receta['telefono_cliente'] . '</p>
        <p>Fecha de entrega : ' . $receta['fecha_entrega'] . '</p>
        <p>Nombre del vendedor: ' . $receta['nombre_vendedor'] . '</p>
                
        </div>
        <hr>
            <div class="col l6 m6 s12">
            <h4>Datos del lente</h4>
                <p>Tipo de lente: ' . $receta['tipo_lente'] . '</p>
                <p>Tipo de cristal: ' . $receta['tipo_cristal'] . '</p>
                <p>Material de cristal: ' . $receta['material_cristal'] . '</p>
                <p>Armazon: ' . $receta['armazon'] . '</p>
                
                <p>Prisma: '.$receta['prisma'].'</p>
                <p>Base: '.$receta['base'].'</p>
                <p>Distancia pupilar: '.$receta['distancia_pupilar'].'</p>
                <br>
                <br>
                <br>
                <br>

            </div>
           
        <table border="1" cellpadding="4">
        
            <tr>
                <td><h4>OJO IZQUIERDO</h4></td>
                <td><h4>OJO DERECHO</h4></td>
            </tr>
            <tr>
                <td>
                    <p>Esfera: ' . $receta['esfera_oi'] . '</p>
                    <p>Cilindro: ' . $receta['cilindro_oi'] . '</p>
                    <p>Eje: ' . $receta['eje_oi'] . '</p>
                </td>
                <td>
                    <p>Esfera: ' . $receta['esfera_od'] . '</p>
                    <p>Cilindro: ' . $receta['cilindro_od'] . '</p>
                    <p>Eje: ' . $receta['eje_od'] . '</p>
                </td>
            </tr>
 
        </table>
        <hr>
        <h4>Observacion</h4>
        <p>'.$receta['observacion'].'</p>
        <br><br>
        
        <h4>Precio: $'.$receta['precio'].'</h4>
            
        
        



';

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('reporte.pdf', 'I');



        //-------FIN LLAMADA LIBRERIA

    }
}

$obj = new ExportarPDF();
$obj->generarPDF();