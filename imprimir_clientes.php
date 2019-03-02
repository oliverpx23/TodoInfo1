<?php

include_once 'clases/tcpdf/tcpdf.php';
include_once 'clases/conexion.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 0, 'Pag. ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

}

// create new PDF document // CODIFICACION POR DEFECTO ES UTF-8
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Marcos Paiva');
$pdf->SetTitle('REPORTE DE CIUDAD');
$pdf->SetSubject('TCPDF BLACK BULLS GAMESHOP');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins POR DEFECTO
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8,10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks SALTO AUTOMATICO Y MARGEN INFERIOR
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


// ---------------------------------------------------------
// TIPO DE LETRA
$pdf->SetFont('times', 'B', 14);

// AGREGAR PAGINA
$pdf->AddPage('L', 'LEGAL');
//celda para titulo
$pdf->Cell(0, 0, "REPORTE DE CLIENTES", 0, 1, 'C');
//SALTO DE LINEA
$pdf->Ln();

//COLOR DE TABLA
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);

$pdf->SetFont('', 'B', 10);
//columnas
$pdf->SetFillColor(180, 180, 180);
$pdf->Cell(20, 5, 'CODIGO', 1, 0, 'C', 1);
$pdf->Cell(70, 5, 'CLIENTE', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'CI O RUC', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'TELEFONO', 1, 0, 'C', 1);
$pdf->Cell(80, 5, 'DIRECCION', 1, 0, 'C', 1);
$pdf->Cell(40, 5, 'DEPARTAMENTO', 1, 0, 'C', 1);
$pdf->Cell(45, 5, 'CIUDAD', 1, 0, 'C', 1);

$pdf->Ln(); //salto
$pdf->SetFont('', '');
$pdf->SetFillColor(255, 255, 255);




if ($_REQUEST['vop'] == '1') {
//consulta a la base de datos
    $clientes = consultas::get_datos("select * from v_clientes "
         . "where id_ciudad=" . $_REQUEST['vciu'] . " order by id_cliente");
    if (!empty($clientes)) {
        foreach ($clientes as $cliente) {
            $pdf->Cell(20, 5, $cliente['id_cliente'], 1, 0, 'C', 1);
            $pdf->Cell(70, 5, $cliente['cliente'], 1, 0, 'L', 1);
            $pdf->Cell(30, 5, $cliente['cli_ci'], 1, 0, 'L', 1);
            $pdf->Cell(30, 5, $cliente['cli_telefono'], 1, 0, 'L', 1);
            $pdf->Cell(80, 5, $cliente['cli_direccion'], 1, 0, 'L', 1);
            $pdf->Cell(40, 5, $cliente['dep_descri'], 1, 0, 'L', 1);
            $pdf->Cell(45, 5, $cliente['ciu_descri'], 1, 0, 'L', 1);
            $pdf->Ln(); //salto
        }
    } else {
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
    }
}

if ($_REQUEST['vop'] == '2') {
 //consulta a la base de datos
    $clientes = consultas::get_datos("select * from v_clientes "
         . "where id_departamento=" . $_REQUEST['vdepar'] . " order by id_cliente");
    if (!empty($clientes)) {
        foreach ($clientes as $cliente) {
            $pdf->Cell(20, 5, $cliente['id_cliente'], 1, 0, 'C', 1);
            $pdf->Cell(70, 5, $cliente['cliente'], 1, 0, 'L', 1);
            $pdf->Cell(30, 5, $cliente['cli_ci'], 1, 0, 'L', 1);
            $pdf->Cell(30, 5, $cliente['cli_telefono'], 1, 0, 'L', 1);
            $pdf->Cell(80, 5, $cliente['cli_direccion'], 1, 0, 'L', 1);
            $pdf->Cell(40, 5, $cliente['dep_descri'], 1, 0, 'L', 1);
            $pdf->Cell(45, 5, $cliente['ciu_descri'], 1, 0, 'L', 1);
            $pdf->Ln(); //salto
        }
    } else {
        $pdf->SetFont('times', 'B', '14');
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Cell(320, 6, 'NO SE ENCUENTRAN DATOS', 0, 0, 'C', 0);
    }   
}

//SALIDA AL NAVEGADOR
$pdf->Output('reporte_ciudad.pdf', 'I');
?>
