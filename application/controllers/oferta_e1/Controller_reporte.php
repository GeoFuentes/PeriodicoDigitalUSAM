<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Controller_reporte extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('oferta_e1/Model_r_e1');
        $this->load->library('Reporte_e1');
        $this->load->library('Excel');

    }

    public function cargar_plantilla($vista, $data = '')
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_oferta()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }

        $roles         = $this->Usuarios->obtener_roles();
        $data['roles'] = $roles;
        $vista         = "oferta_e1/View_r_e1";
        $this->cargar_plantilla($vista, $data);
    }

    public function vista_oferta_reporte()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }

        $roles         = $this->Usuarios->obtener_roles();
        $data['roles'] = $roles;
        $vista         = "oferta_e1/View_reporte";
        $this->cargar_plantilla($vista, $data);
    }

    public function DF($valor, $sign = '$')
    {
        if (!is_numeric($valor) || $valor == null || $valor == '') {
            return $sign . ' 0.00';
        }
        $array_valor_decimales = explode('.', $valor);
        if (count($array_valor_decimales) == 1) {
            $valor = $valor . '.00';
        }
        $cantidad_digitos = strlen($array_valor_decimales[0]);
        $contador         = 0;
        $vez              = 0;
        if ($cantidad_digitos > 3) {
            for ($i = $cantidad_digitos; $i >= 1; $i--) {
                if (($i % 3) == 0) {
                    if ($i < $cantidad_digitos) {
                        $valor = substr($valor, 0, $contador + $vez) . ',' . substr($valor, $contador + $vez);
                        $vez   = $vez + 1;
                    }
                }
                $contador = $contador + 1;
            }
        }
        return $sign . ' ' . $valor;
    }

    public function get_table_ofertas()
    {
        $string_table = '';
        if (isset($_POST["oferta"])) {
            if (count($_POST["oferta"]) > 0) {
                $output[] = '';
                $string_table .= '
          <table class="table table-responsive table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>OFERTA</th>
                <th>PROYECTO</th>
                <th>CODIGO</th>
                <th>TOTAL</th>
              </tr>
            </thead>
            <tbody id="tbslim">';
                $l = count($_POST["oferta"]);
                $p = $_POST["oferta"];
                $a = 0;
                $q = 0;
                for ($i = 0; $i < $l; $i++) {
                    $result = $this->Model_r_e1->get_table_ofertas($p[$i]);
                    $a++;
                    foreach ($result as $key => $value) {
                        $q += $value->costo;
                        $string_table .= '
                        <tr>
                            <td><input type="hidden" name="ofertae[]" value="' . $p[$i] . '"">' . $a . '</td>
                            <td>Inte. ' . $value->correlativo . '</td>
                            <td>' . $value->proyecto . '</td>
                            <td>' . $value->codigo . '</td>
                            <td>' . $this->DF((round($value->costo * 100) / 100)) . '</td>
                        </tr>
                   ';
                    }
                }
                $string_table .= '
            </tbody>
            <tfoot>
              <tr>
                <th style="text-align:center;font-size:12px;vertical-align:middle;border:solid 2px #EAEDF2;" colspan="4">Total:</th>
                <th style="font-size:12px;vertical-align:middle;border:solid 2px #EAEDF2;">' . $this->DF((round($q * 100) / 100)) . '</th>
              </tr>
            </tfoot>
          </table>';

            }
        } else {
            $string_table .= '<div class="alert alert-warning"><h3 align="center">SELECCIONA ALMENOS UNA OFERTA <i class="fa fa-exclamation-triangle"> . . .</h3></i></div>';
        }

        echo $string_table;
    }

    public function pdf_oferta($id, $y = '')
    {

        $x = $this->Model_r_e1->get_formulario($id);
        $z = $this->Model_r_e1->get_datos($id);

        foreach ($z as $key => $value) {
            $descripcion[] = utf8_decode($value->item);
            $medida[]      = utf8_decode($value->unidad_medida);
            $cantidad[]    = $value->cantidad;
            $precio[]      = $value->precio;
            $total[]       = $value->tt;
        }

        foreach ($x as $key => $value) {
            $p  = $value->proyecto;
            $u  = $value->ubicacion;
            $o  = $value->empresa;
            $j  = $value->servicios;
            $s  = $value->supervisor;
            $su = $value->cargo;
            $f  = $value->fecha;
            $cc = $value->correlativo;
            $ct = $value->codigo;
        }

        $this->config->set_item('headers_e1', [$p, $u, $j, $ct, $o, $f, $cc, $s, $su]);

        $fpdf = new Reporte_e1('P', 'mm', 'letter', true);
        $fpdf->AddPage('portrait', 'letter');

        $fpdf->SetFont('Arial', '', 7);
        $fpdf->SetY(88);
        $fpdf->SetTextColor(0, 0, 0);
        $fpdf->SetFillColor(255, 255, 255);
        $fpdf->SetWidths(array(10, 90, 23, 23, 23, 23));

        $l = 0;
        $t = 0;
        for ($i = 0; $i < count($z); $i++) {
            $l++;
            $fpdf->Row(array($l, $descripcion[$i], $medida[$i], $cantidad[$i], $this->DF($precio[$i]), $this->DF($total[$i])));
            $t += $total[$i];
        }

        $p = round($t * 100) / 100;
        $v = $t * 0.13;
        $o = round($v * 100) / 100;
        $u = $p + $o;

        $fpdf->SetFont('Times', 'B', 8);
        $fpdf->SetX(157);
        $fpdf->Cell(23, 9, utf8_decode('SUBTOTAL:'), 'B', 0, 'R', 1);
        $fpdf->Cell(23, 9, utf8_decode($this->DF($p)), 'B', 0, 'R', 1);
        $fpdf->Ln();
        $fpdf->SetX(15);
        $fpdf->Cell(50, 6, utf8_decode('CONDICIONES COMERCIALES:'), 0, 0, 'L', 1);
        $fpdf->SetX(157);
        $fpdf->Cell(23, 9, utf8_decode('IVA:'), 'B', 0, 'R', 1);
        $fpdf->Cell(23, 9, utf8_decode($this->DF($o)), 'B', 0, 'R', 1);
        $fpdf->Ln();
        $fpdf->SetX(15);
        $fpdf->Cell(50, 6, utf8_decode('Forma de Pago: Según condiciones del acuerdo del Contrato Marco, periodo 2019 al 2021'), 0, 0, 'L', 1);
        $fpdf->SetX(157);
        $fpdf->Cell(23, 9, utf8_decode('TOTAL:'), 'B', 0, 'R', 1);
        $fpdf->Cell(23, 9, utf8_decode($this->DF($u)), 'B', 0, 'R', 1);
        $fpdf->Ln();
        $fpdf->SetTextColor(0, 0, 0);
        $fpdf->SetFillColor(255, 255, 255);
        $fpdf->Ln();

        if ($y == "y") {
            $fpdf->Output("Inte MTTO. $cc.pdf", 'D');
        }

        $fpdf->Output();
    }

    public function genera_check()
    {
        $z        = range($_POST["r1"], $_POST["r2"], 1);
        $d        = count($z);
        $output[] = '';
        $sw       = '';
        $sw .= '';
        for ($i = 0; $i < $d; $i++) {
            $d[$i];
            $sw .= '
                    <div class="col-sm-4">
                        <div class="switch">
                            <label for="' . $z[$i] . '">OFERTA ' . $z[$i] . '</label>
                            <label>
                            <input checked="" class="oferta" id="' . $z[$i] . '" type="checkbox" name="oferta[]" value="' . $z[$i] . '">
                                <span class="lever"></span>
                            </label>
                        </div>
                    </div>';
        }
        $sw .= ' </div>';

        $output['sw'] = $sw;
        echo json_encode($output);

    }
#########################################################################################################################################################################
    #########################################################################################################################################################################
    public function excel_detallado()
    {

        $d = count($_POST["ofertae"]);
        $c = $_POST["ofertae"];

        $reporte = new Spreadsheet();
        $estilo1 = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => array(
                        'rgb' => '000000'),
                ),
            ),
        );
        $xi = array(
            'borders' => array(
                'bottom' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM, 'color' => array(
                        'rgb' => '000000'),
                ),
            ),
        );
        $estilo3 = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM, 'color' => array(
                        'rgb' => 'FFFFFF'),
                ),
            ),
        );
        $estilo4 = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM, 'color' => array(
                        'rgb' => '000000'),
                ),
            ),
        );

        $inter = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM, 'color' => array(
                        'rgb' => '000000'),
                ),
            ),
        );

        $sb = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE, 'color' => array(
                        'rgb' => '000000'),
                ),
            ),
        );

        $psd = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => array(
                        'rgb' => '000000'),
                ),
            ),
        );

        $reporte
            ->getProperties()
            ->setCreator("Intesal SA de CV")
            ->setLastModifiedBy('Departamento TI')
            ->setTitle('OFERTAS')
            ->setSubject('RESUMEN DE OFERTAS')
            ->setDescription('Reporte de cotizacion')
            ->setKeywords('')
            ->setCategory('OFERTAS DE MANTENIMIENTO');
        for ($i = 0; $i < $d; $i++) {
            $x = $this->Model_r_e1->get_formulariox($c[$i]);
            foreach ($x as $key => $value) {
                $pr    = $value->proyecto;
                $ub    = $value->ubicacion;
                $om    = $value->servicio_ex;
                $ci    = $value->codigo;
                $js    = $value->empresa;
                $sv    = $value->supervisor;
                $te    = '';
                $fc    = $value->fecha;
                $cc    = $value->correlativo;
                $su    = $value->cargo;
                $id    = $value->id_oferta;
                $excel = $reporte->createSheet($i);
                $excel->setTitle("Inte " . $c[$i]);
                $reporte->setActiveSheetIndex($i);



                $reporte->getActiveSheet($i)->getColumnDimension('B')->setWidth(15);
                $reporte->getActiveSheet($i)->getColumnDimension('C')->setWidth(50);
                $reporte->getActiveSheet($i)->getColumnDimension('D')->setWidth(15);
                $reporte->getActiveSheet($i)->getColumnDimension('E')->setWidth(15);
                $reporte->getActiveSheet($i)->getColumnDimension('F')->setWidth(15);
                $reporte->getActiveSheet($i)->getColumnDimension('G')->setWidth(15);
                $reporte->getActiveSheet($i)->getColumnDimension('H')->setWidth(15);






                $reporte->getActiveSheet($i)->getColumnDimension('A')->setWidth(10);
                $reporte->getActiveSheet($i)->getRowDimension('9')->setRowHeight(28);
                $reporte->getActiveSheet($i)->getRowDimension('10')->setRowHeight(28);
                $reporte->getActiveSheet($i)->getRowDimension('11')->setRowHeight(28);
                $reporte->getActiveSheet($i)->getRowDimension('12')->setRowHeight(28);
                $reporte->getActiveSheet($i)->getRowDimension('13')->setRowHeight(28);
                $reporte->setActiveSheetIndex($i)->mergeCells('C9:D9');
                $reporte->setActiveSheetIndex($i)->mergeCells('C10:D10');
                $reporte->setActiveSheetIndex($i)->mergeCells('C11:D11');
                $reporte->setActiveSheetIndex($i)->mergeCells('C12:D12');
                $reporte->setActiveSheetIndex($i)->mergeCells('C13:G13');
                $reporte->setActiveSheetIndex($i)->mergeCells('G9:H9');
                $reporte->setActiveSheetIndex($i)->mergeCells('G10:H10');
                $reporte->setActiveSheetIndex($i)->mergeCells('G11:H11');
                $reporte->setActiveSheetIndex($i)->mergeCells('F6:H7');
                
                $reporte->getActiveSheet($i)->getStyle("C11:D11")->getAlignment()->setWrapText(true);

                $reporte->getActiveSheet(0)->getStyle("B9:G13")->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
                );


                $t = 0;
                while ($t <= 14) {
                    $t++;
                    $reporte->getActiveSheet($i)->getStyle("B$t:H$t")->applyFromArray($estilo3);
                }
                $logo_i = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $logo_i->setName('TELEFONICA');
                $logo_i->setDescription('LOGO TELEFONICA');
                $logo_i->setPath('assets/sistema/telefonicax.jpg');
                $logo_i->setCoordinates('B1');
                $logo_i->setOffsetX(40);
                $logo_i->setOffsetY(15);
                $logo_i->setHeight(70);
                $logo_i->setWorksheet($reporte->getActiveSheet($i));
                $logo_t = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $logo_t->setName('INTESAL');
                $logo_t->setDescription('LOGO INTESAL');
                $logo_t->setPath('assets/img/logo.png');
                $logo_t->setCoordinates('F1');
                $logo_t->setOffsetX(20);
                $logo_t->setOffsetY(15);
                $logo_t->setHeight(70);
                $logo_t->setWorksheet($reporte->getActiveSheet($i));
                $reporte->getActiveSheet($i)->getStyle("C9:C13")->getAlignment()->setWrapText(true);
                $reporte->getActiveSheet($i)->getStyle("F6")->getFont()->setBold(true)->setName('Papyrus')->setSize(20)->getColor()->setRGB('2B3454');
                $reporte->getActiveSheet(0)->getStyle("B16:H16")->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
                );
                $reporte->getActiveSheet($i)->getStyle("B16:H16")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('6AB4DE');
                $excel->setCellValue("B9", 'Proyecto:');
                $excel->setCellValue("C9", $pr);
                $excel->setCellValue("B10", 'Ubicación:');
                $excel->setCellValue("C10", $ub);
                $excel->setCellValue("B11", 'Servicios:');
                $excel->setCellValue("C11", $om);
                $excel->setCellValue("B12", 'Codigo:');
                $excel->setCellValue("C12", $ci);
                $excel->setCellValue("B13", 'Propietario:');
                $excel->setCellValue("C13", $js);
                $excel->setCellValue("G6", 'Inte . ' . $cc);

                $excel->setCellValue("B16", 'ITEM');
                $excel->setCellValue("C16", 'DESCRIPCION');
                $excel->setCellValue("E16", 'MEDIDA');
                $excel->setCellValue("F16", 'CANTIDAD');
                $excel->setCellValue("G16", 'P. UNITARIO');
                $excel->setCellValue("H16", 'TOTAL');

                


            }
            $tx = 16;
            $cn = 0;
            $z  = $this->Model_r_e1->get_datos($id);
            foreach ($z as $key => $value) {
                $reporte->getActiveSheet($i)->getSheetView()->setView('pageBreakPreview');
                $tx++;
                $cn++;
                $excel->setCellValue("B$tx", $cn);
                $excel->setCellValue("C$tx", $value->item);
                $excel->setCellValue("D$tx", $value->detalle_item);
                $excel->setCellValue("E$tx", $value->unidad_medida);
                $excel->setCellValue("F$tx", $value->cantidad);
                $excel->setCellValue("G$tx", $value->precio);
                $excel->setCellValue("H$tx", "=(F$tx * G$tx)");
                $reporte->getActiveSheet($i)->getStyle("D$tx")->getFont()->setBold(true)->setName('Arial')->setSize(10)->getColor()->setRGB('FF0000');            }

            $vc = $tx + 1;
            $excel->setCellValue("G$vc", "SUBTOTAL:");
            $excel->setCellValue("H$vc", "=SUM(H17:H$tx)");
            $vx = $tx + 2;
            $excel->setCellValue("B$vx", "CONDICIONES COMERCIALES:");
            $excel->setCellValue("G$vx", "IVA:");
            $excel->setCellValue("H$vx", "=(H$vc * 0.13)");
            $vb = $tx + 3;
            $excel->setCellValue("B$vb", "Forma de Pago: Según condiciones del acuerdo del Contrato Marco, periodo 2019 al 2021");
            $excel->setCellValue("G$vb", "TOTAL:");
            $excel->setCellValue("H$vb", "=(H$vc + H$vx)");
            $reporte->getActiveSheet($i)->getStyle("H$vc:H$vb")->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
            );
            $tm = $vc - 1;
            while ($tm <= 14) {
                $tm++;
                $reporte->getActiveSheet($i)->getStyle("B$tm:H$tm")->applyFromArray($estilo3);
            }
            $reporte->getActiveSheet($i)->getRowDimension("$vc")->setRowHeight(35);
            $reporte->getActiveSheet($i)->getRowDimension("$vx")->setRowHeight(35);
            $reporte->getActiveSheet($i)->getRowDimension("$vb")->setRowHeight(35);
            $reporte->getActiveSheet($i)->getStyle("B17:H$tx")->getAlignment()->setWrapText(true);
            $reporte->getActiveSheet($i)->getStyle("F17:H$vb")->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD);
            $reporte->getActiveSheet($i)->getStyle("B17:H$tx")->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
            );
            $reporte->getActiveSheet($i)->getStyle("C17:C$tx")->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
            );




            $reporte->getActiveSheet($i)->getStyle("B16:H$tx")->applyFromArray($estilo1);
            $reporte->getActiveSheet($i)->getStyle("C16:D$tx")->applyFromArray($sb);

            $rt = 16;
            for ($io=0; $io < count($z); $io++) { 
                $rt++;
                $reporte->getActiveSheet($i)->getStyle("C16:D$rt")->applyFromArray($psd);
                $reporte->getActiveSheet($i)->getStyle("C17:D$rt")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ffff');
            }

            
            

           






            $yu = $vb + 8;
            $excel->setCellValue("B$yu", "$sv");
            $excel->setCellValue("G$yu", "Rony Melvin Laryn");
            $yu++;
            $excel->setCellValue("B$yu", "$su");
            $excel->setCellValue("G$yu", "Por Intesal S.A de C.V");
            $reporte->getActiveSheet($i)->getStyle("B$vc:H$yu")->getFont()->setBold(true)->setName('Times New Roman')->setSize(11)->getColor()->setRGB('100000');
            while ($tm <= $yu) {
                $tm++;
                $reporte->getActiveSheet($i)->getStyle("B$tm:H$tm")->applyFromArray($estilo3);
            }
            $reporte->getActiveSheet($i)->getStyle("G$vc:H$vc")->applyFromArray($xi);
            $reporte->getActiveSheet($i)->getStyle("G$vx:H$vx")->applyFromArray($xi);
            $reporte->getActiveSheet($i)->getStyle("G$vb:H$vb")->applyFromArray($xi);
            $reporte->getActiveSheet($i)->getStyle("G$vc:H$vb")->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
            );


            $reporte->getActiveSheet($i)->getStyle("B16:h16")->applyFromArray($estilo4);
            $reporte->getActiveSheet($i)->getStyle("C16:D16")->applyFromArray($sb);
            $reporte->getActiveSheet($i)->getStyle("C16:D16")->applyFromArray($inter);



            $reporte->getActiveSheet($i)->getStyle("B$tx:H$tx")->applyFromArray($xi);
            $reporte->getActiveSheet($i)->getPageSetup()->setPrintArea("B1:H$tm");
            $reporte->getActiveSheet($i)->getStyle("B9:H13")->getAlignment()->setWrapText(true);
            $reporte->getActiveSheet($i)->getPageSetup()->setScale(60);
        }

##################################################################################################################################################################      
        $i ++;
        $excel = $reporte->createSheet($i);
        $excel->setTitle("RESUMEN");
        $reporte->setActiveSheetIndex($i);
        $logo_i = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $logo_i->setName('TELEFONICA');
        $logo_i->setDescription('LOGO TELEFONICA');
        $logo_i->setPath('assets/sistema/telefonicax.jpg');
        $logo_i->setCoordinates('B1');
        $logo_i->setOffsetX(0);
        $logo_i->setOffsetY(15);
        $logo_i->setHeight(70);
        $logo_i->setWorksheet($reporte->getActiveSheet($i));
        $reporte->getActiveSheet($i)->getColumnDimension('B')->setWidth(8);
        $reporte->getActiveSheet($i)->getColumnDimension('C')->setWidth(15);
        $reporte->getActiveSheet($i)->getColumnDimension('D')->setWidth(15);
        $reporte->getActiveSheet($i)->getColumnDimension('E')->setWidth(30);
        $reporte->getActiveSheet($i)->getColumnDimension('F')->setWidth(35);
        $reporte->getActiveSheet($i)->getColumnDimension('G')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('H')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('I')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('J')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('K')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('L')->setWidth(20);
        $excel->setCellValue("B7","DIRECCION DE TECNOLOGIA OPERACIONES Y SISTEMAS");
        $excel->setCellValue("B8","GERENCIA: ASISTENCIA TECNICA");
        $excel->setCellValue("B9","RESUMEN DE COMPRA:");
        $excel->setCellValue("B10","SOLP No.:");
        $excel->setCellValue("B11","ORDEN DE COMPRA:");
        $excel->setCellValue("B12","CONTRATO MARCO:");
        $excel->setCellValue("J7","CODIGO:");
        $excel->setCellValue("J11","CENTRO DE COSTO");
        $excel->setCellValue("K11","CUENTA DE GASTOS No.");
        $excel->setCellValue("L11","ELEMENTO PEP 2o NIVEL/ORDEN DE INVERSION");  
        $reporte->getActiveSheet($i)->getStyle("J7:K7")->applyFromArray($estilo1);
        $reporte->getActiveSheet($i)->getStyle("J11:L12")->applyFromArray($estilo1);
        $reporte->getActiveSheet($i)->getStyle("J11:L12")->getAlignment()->setWrapText(true);
        $reporte->getActiveSheet($i)->getStyle("J11:L12")->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->getActiveSheet($i)->setShowGridlines(False);
        $excel->setCellValue("B14","POS. ORDEN");
        $excel->setCellValue("C14","OFERTA");
        $excel->setCellValue("D14","FECHA");
        $excel->setCellValue("E14","DESCRIPCIÓN  /ESPECIFICACIONES");
        $excel->setCellValue("F14","SERVICIOS");
        $excel->setCellValue("G14","SERIE");
        $excel->setCellValue("H14","TOTAL INSTALACION");
        $excel->setCellValue("I14","TOTAL OFERTA");
        $excel->setCellValue("J14","MONTO POS.OC");
        $excel->setCellValue("K14","PORCENTAJE DE POSICION OC A PAGAR. %");
        $excel->setCellValue("L14","TOTAL PORCENTAJE  OC A PAGAR %");
        $f = 0;
        $q = 14;
        $cs = 0;
        for ($Y=0; $Y < $d; $Y++) {
        $result = $this->Model_r_e1->get_table_ofertas($c[$Y]);
            foreach ($result as $key => $value) {
                $cs += $value->costo;
            }
        }
        for ($Y=0; $Y < $d; $Y++) {
        $result = $this->Model_r_e1->get_table_ofertas($c[$Y]);
        foreach ($result as $key => $value) {
        $f++;
        $q++;
        $excel->setCellValue("B$q",$f);
        $excel->setCellValue("C$q",'INTE. '.$value->correlativo);
        $excel->setCellValue("D$q",$value->fecha);
        $excel->setCellValue("E$q",$value->proyecto);
        $excel->setCellValue("F$q",$value->servicio_ex);
        $excel->setCellValue("H$q",$value->costo);
        $excel->setCellValue("I$q",$value->costo);
        $excel->setCellValue("K$q","=(($value->costo * 100)/$cs)");
        }
        $reporte->getActiveSheet($i)->getStyle("B14:L14")->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->getActiveSheet($i)->getStyle("B14:L$q")->applyFromArray($estilo1);
        $reporte->getActiveSheet($i)->getStyle("B14:L14")->applyFromArray($estilo4);
        $reporte->getActiveSheet($i)->getStyle("B14:L14")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('6AB4DE');
        }
        $q1 = $q;
        $q1++;
        $excel->setCellValue("I$q1","=SUM(I15:I$q)");
        $excel->setCellValue("J15","=(I$q1)");
        $excel->setCellValue("J$q1","=SUM(J15:J$q)");
        $excel->setCellValue("k$q1","=SUM(K15:K$q)");
        $excel->setCellValue("L15","=SUM(K15:K$q)");
        $excel->setCellValue("L$q1","=(L15)");
        $reporte->getActiveSheet($i)->getStyle("H15:J$q1")->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD);
        $reporte->getActiveSheet($i)->getStyle("K15:L$q1")->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_00);
        $reporte->getActiveSheet($i)->getStyle("B14:L$q1")->getAlignment()->setWrapText(true);
        $reporte->getActiveSheet($i)->getStyle("B15:L$q1")->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->getActiveSheet($i)->getStyle("E15:F$q1")->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->setActiveSheetIndex($i)->mergeCells("J15:J$q");
        $reporte->setActiveSheetIndex($i)->mergeCells("L15:L$q");
        $fm = $q;
        $q++;
        $reporte->setActiveSheetIndex($i)->mergeCells("B$q:H$q");
        $excel->setCellValue("B$q",'TOTAL');
        $excel->setCellValue("F$q","=SUM(F15:F$fm)");

        $reporte->getActiveSheet($i)->getStyle("B$q")->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->getActiveSheet($i)->getStyle("B$q:L$q")->applyFromArray($estilo1);
        $q = $q + 5;
        $excel->setCellValue("B$q",'Nombre de la persona que representa a la Contratista o Proveedor');
        $q++;
        $excel->setCellValue("B$q",'INSTALACIONES TELEFONICAS SALVADOREÑAS S.A. DE C.V.');
        $q++;
        $excel->setCellValue("B$q",'Proveedor');
        $q = $q + 3;
        $excel->setCellValue("B$q",'Elaboradao por');
        $q++;
        $excel->setCellValue("B$q",'Por TELEFONICA');
        $q = $q + 3;
        $excel->setCellValue("B$q",'Nombre del Jefe de Area');
        $q++;
        $excel->setCellValue("B$q",'Jefatura');
##################################################################################################################################################################
        $i++;
        $excel = $reporte->createSheet($i);
        $excel->setTitle("CONSOLIDADO");
        $reporte->setActiveSheetIndex($i);
        $reporte->getActiveSheet($i)->setShowGridlines(false);
        $qw = $this->Model_r_e1->obtener_item($c);

        $reporte->getActiveSheet($i)->getColumnDimension('B')->setWidth(15);
        $reporte->getActiveSheet($i)->getColumnDimension('C')->setWidth(50);
        $reporte->getActiveSheet($i)->getColumnDimension('D')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('E')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('F')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('G')->setWidth(20);

        $logo_i = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $logo_i->setName('TELEFONICA');
        $logo_i->setDescription('LOGO TELEFONICA');
        $logo_i->setPath('assets/sistema/telefonicax.jpg');
        $logo_i->setCoordinates('B1');
        $logo_i->setOffsetX(0);
        $logo_i->setOffsetY(15);
        $logo_i->setHeight(70);
        $logo_i->setWorksheet($reporte->getActiveSheet($i));
        $logo_t = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $logo_t->setName('INTESAL');
        $logo_t->setDescription('LOGO INTESAL');
        $logo_t->setPath('assets/img/logo.png');
        $logo_t->setCoordinates('F1');
        $logo_t->setOffsetX(20);
        $logo_t->setOffsetY(15);
        $logo_t->setHeight(70);
        $logo_t->setWorksheet($reporte->getActiveSheet($i));
        $reporte->setActiveSheetIndex($i)->mergeCells("B7:C7");
        $excel->setCellValue("B7", "PRECIARIOS DE E1 Y CABLEADOS DE RED MOVIL Y FIJA ");
        $excel->setCellValue("B10", "CODIGO");
        $excel->setCellValue("C10", "DESCRIPCION");
        $excel->setCellValue("D10", "MEDIDA");
        $excel->setCellValue("E10", "CANTIDAD");
        $excel->setCellValue("F10", "P. UNITARIO");
        $excel->setCellValue("G10", "TOTAL");

        $rt = 10;
        $yr = 0;
        foreach ($qw as $key => $value) {
            $rt++;
            $yr++;
            $excel->setCellValue("B$rt", $yr);
            $excel->setCellValue("C$rt", $value->item);
            $excel->setCellValue("D$rt", $value->unidad_medida);
            $excel->setCellValue("E$rt", $value->cuenta);
            $excel->setCellValue("F$rt", $value->precio);
            $excel->setCellValue("G$rt", "=(E$rt * F$rt)");
        }

        $reporte->getActiveSheet($i)->getStyle("B11:G$rt")->applyFromArray($estilo1);
        $reporte->getActiveSheet($i)->getStyle("B11:G$rt")->getAlignment()->setWrapText(true);
        $reporte->getActiveSheet($i)->getStyle("B10:G10")->applyFromArray($estilo4);
        $reporte->getActiveSheet($i)->getStyle("B10:G10")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('6AB4DE');
        $reporte->getActiveSheet($i)->getStyle("B10:G$rt")->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->getActiveSheet($i)->getStyle("C11:C$rt")->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->getActiveSheet($i)->getStyle("G11:G$rt")->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD);
        $ch = $rt;
        $rt++;
        $r1 = $rt;
        $excel->setCellValue("F$rt", "SUBTOTAL:");
        $excel->setCellValue("G$rt", "=SUM(G11:G$ch)");
        $rt++;
        $r2 = $rt;
        $excel->setCellValue("F$rt", "IVA:");
        $excel->setCellValue("G$rt", "=(G$r1 * 0.13)");

        $excel->setCellValue("B$r2", "CONDICIONES COMERCIALES:");
        $rt++;
        $r3 = $rt;
        $excel->setCellValue("F$rt", "TOTAL:");
        $excel->setCellValue("G$rt", "=sum(G$r1:G$r2)");

        $excel->setCellValue("B$r3", "Forma de Pago: Según condiciones del acuerdo del Contrato Marco, periodo 2019 al 2021");

        $reporte->getActiveSheet($i)->getStyle("F$r1:G$r1")->applyFromArray($xi);
        $reporte->getActiveSheet($i)->getStyle("F$r2:G$r2")->applyFromArray($xi);
        $reporte->getActiveSheet($i)->getStyle("F$r3:G$r3")->applyFromArray($xi);
        $reporte->getActiveSheet($i)->getRowDimension("$r1")->setRowHeight(35);
        $reporte->getActiveSheet($i)->getRowDimension("$r2")->setRowHeight(35);
        $reporte->getActiveSheet($i)->getRowDimension("$r3")->setRowHeight(35);
        $reporte->getActiveSheet($i)->getStyle("F$r1:G$r3")->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
            );
        $reporte->getActiveSheet($i)->getStyle("B$r1:G$r3")->getFont()->setBold(true)->setName('Times New Roman')->setSize(11)->getColor()->setRGB('100000');
        $reporte->setActiveSheetIndex($i)->mergeCells("B$r2:D$r2");
        $reporte->setActiveSheetIndex($i)->mergeCells("B$r3:D$r3");
        $reporte->getActiveSheet($i)->getStyle("G$r1:G$r3")->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD);
        $reporte->getActiveSheet($i)->getStyle("B$rt")->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );

        $r4 = $r3 + 4;
        $reporte->setActiveSheetIndex($i)->mergeCells("B$r4:C$r4");
        $reporte->setActiveSheetIndex($i)->mergeCells("F$r4:G$r4");
        $excel->setCellValue("B$r4", "Ing. Juan Vicente");
        $excel->setCellValue("F$r4", "Roni Melvin Larín");
        $r4++;
        $reporte->setActiveSheetIndex($i)->mergeCells("F$r4:G$r4");
        $reporte->setActiveSheetIndex($i)->mergeCells("B$r4:C$r4");
        $excel->setCellValue("B$r4", "Supervisor de Planta Externa");
        $excel->setCellValue("F$r4", "Por Intesal S.A. de C.V.");

        $archivo = "Resumen de ofertas.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $archivo . '"');
        header('Cache-Control: max-age=0');

        $imprimir = IOFactory::createWriter($reporte, 'Xlsx');
        $imprimir->save('php://output');
        exit;

    }

public function excel_normal()
    {

        $d = count($_POST["ofertae"]);
        $c = $_POST["ofertae"];

        $reporte = new Spreadsheet();
        $estilo1 = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => array(
                        'rgb' => '000000'),
                ),
            ),
        );
        $xi = array(
            'borders' => array(
                'bottom' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM, 'color' => array(
                        'rgb' => '000000'),
                ),
            ),
        );
        $estilo3 = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM, 'color' => array(
                        'rgb' => 'FFFFFF'),
                ),
            ),
        );
        $estilo4 = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM, 'color' => array(
                        'rgb' => '000000'),
                ),
            ),
        );

        $inter = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM, 'color' => array(
                        'rgb' => '000000'),
                ),
            ),
        );

        $sb = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE, 'color' => array(
                        'rgb' => '000000'),
                ),
            ),
        );

        $psd = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => array(
                        'rgb' => '000000'),
                ),
            ),
        );

        $reporte
            ->getProperties()
            ->setCreator("Intesal SA de CV")
            ->setLastModifiedBy('Departamento TI')
            ->setTitle('OFERTAS')
            ->setSubject('RESUMEN DE OFERTAS')
            ->setDescription('Reporte de cotizacion')
            ->setKeywords('')
            ->setCategory('OFERTAS DE MANTENIMIENTO');
        for ($i = 0; $i < $d; $i++) {
            $x = $this->Model_r_e1->get_formulariox($c[$i]);
            foreach ($x as $key => $value) {
                $pr    = $value->proyecto;
                $ub    = $value->ubicacion;
                $om    = $value->servicios;
                $ci    = $value->codigo;
                $js    = $value->empresa;
                $sv    = $value->supervisor;
                $te    = '';
                $fc    = $value->fecha;
                $cc    = $value->correlativo;
                $su    = $value->cargo;
                $id    = $value->id_oferta;
                $excel = $reporte->createSheet($i);
                $excel->setTitle("Inte " . $c[$i]);
                $reporte->setActiveSheetIndex($i);



                $reporte->getActiveSheet($i)->getColumnDimension('B')->setWidth(15);
                $reporte->getActiveSheet($i)->getColumnDimension('C')->setWidth(50);
                $reporte->getActiveSheet($i)->getColumnDimension('D')->setWidth(15);
                $reporte->getActiveSheet($i)->getColumnDimension('E')->setWidth(15);
                $reporte->getActiveSheet($i)->getColumnDimension('F')->setWidth(15);
                $reporte->getActiveSheet($i)->getColumnDimension('G')->setWidth(15);
                $reporte->getActiveSheet($i)->getColumnDimension('H')->setWidth(15);






                $reporte->getActiveSheet($i)->getColumnDimension('A')->setWidth(10);
                $reporte->getActiveSheet($i)->getRowDimension('9')->setRowHeight(28);
                $reporte->getActiveSheet($i)->getRowDimension('10')->setRowHeight(28);
                $reporte->getActiveSheet($i)->getRowDimension('11')->setRowHeight(28);
                $reporte->getActiveSheet($i)->getRowDimension('12')->setRowHeight(28);
                $reporte->getActiveSheet($i)->getRowDimension('13')->setRowHeight(28);
                $reporte->setActiveSheetIndex($i)->mergeCells('C9:D9');
                $reporte->setActiveSheetIndex($i)->mergeCells('C10:D10');
                $reporte->setActiveSheetIndex($i)->mergeCells('C11:D11');
                $reporte->setActiveSheetIndex($i)->mergeCells('C12:D12');
                $reporte->setActiveSheetIndex($i)->mergeCells('C13:G13');
                $reporte->setActiveSheetIndex($i)->mergeCells('G9:H9');
                $reporte->setActiveSheetIndex($i)->mergeCells('G10:H10');
                $reporte->setActiveSheetIndex($i)->mergeCells('G11:H11');
                $reporte->setActiveSheetIndex($i)->mergeCells('F6:H7');
                
                $reporte->getActiveSheet($i)->getStyle("C11:D11")->getAlignment()->setWrapText(true);

                $reporte->getActiveSheet(0)->getStyle("B9:G13")->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
                );


                $t = 0;
                while ($t <= 14) {
                    $t++;
                    $reporte->getActiveSheet($i)->getStyle("B$t:H$t")->applyFromArray($estilo3);
                }
                $logo_i = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $logo_i->setName('TELEFONICA');
                $logo_i->setDescription('LOGO TELEFONICA');
                $logo_i->setPath('assets/sistema/telefonicax.jpg');
                $logo_i->setCoordinates('B1');
                $logo_i->setOffsetX(40);
                $logo_i->setOffsetY(15);
                $logo_i->setHeight(70);
                $logo_i->setWorksheet($reporte->getActiveSheet($i));
                $logo_t = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $logo_t->setName('INTESAL');
                $logo_t->setDescription('LOGO INTESAL');
                $logo_t->setPath('assets/img/logo.png');
                $logo_t->setCoordinates('F1');
                $logo_t->setOffsetX(20);
                $logo_t->setOffsetY(15);
                $logo_t->setHeight(70);
                $logo_t->setWorksheet($reporte->getActiveSheet($i));
                $reporte->getActiveSheet($i)->getStyle("C9:C13")->getAlignment()->setWrapText(true);
                $reporte->getActiveSheet($i)->getStyle("F6")->getFont()->setBold(true)->setName('Papyrus')->setSize(20)->getColor()->setRGB('2B3454');
                $reporte->getActiveSheet(0)->getStyle("B16:H16")->getAlignment()->applyFromArray(
                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
                );
                $reporte->getActiveSheet($i)->getStyle("B16:H16")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('6AB4DE');
                $excel->setCellValue("B9", 'Proyecto:');
                $excel->setCellValue("C9", $pr);
                $excel->setCellValue("B10", 'Ubicación:');
                $excel->setCellValue("C10", $ub);
                $excel->setCellValue("B11", 'Servicios:');
                $excel->setCellValue("C11", $om);
                $excel->setCellValue("B12", 'Codigo:');
                $excel->setCellValue("C12", $ci);
                $excel->setCellValue("B13", 'Propietario:');
                $excel->setCellValue("C13", $js);
                $excel->setCellValue("G6", 'Inte . ' . $cc);

                $excel->setCellValue("B16", 'ITEM');
                $excel->setCellValue("C16", 'DESCRIPCION');
                $excel->setCellValue("E16", 'MEDIDA');
                $excel->setCellValue("F16", 'CANTIDAD');
                $excel->setCellValue("G16", 'P. UNITARIO');
                $excel->setCellValue("H16", 'TOTAL');

                


            }
            $tx = 16;
            $cn = 0;
            $z  = $this->Model_r_e1->get_datos($id);
            foreach ($z as $key => $value) {
                $reporte->getActiveSheet($i)->getSheetView()->setView('pageBreakPreview');
                $tx++;
                $cn++;
                $excel->setCellValue("B$tx", $cn);
                $excel->setCellValue("C$tx", $value->item);
                $excel->setCellValue("D$tx", $value->detalle_item);
                $excel->setCellValue("E$tx", $value->unidad_medida);
                $excel->setCellValue("F$tx", $value->cantidad);
                $excel->setCellValue("G$tx", $value->precio);
                $excel->setCellValue("H$tx", "=(F$tx * G$tx)");
                $reporte->getActiveSheet($i)->getStyle("D$tx")->getFont()->setBold(true)->setName('Arial')->setSize(10)->getColor()->setRGB('FF0000');            }

            $vc = $tx + 1;
            $excel->setCellValue("G$vc", "SUBTOTAL:");
            $excel->setCellValue("H$vc", "=SUM(H17:H$tx)");
            $vx = $tx + 2;
            $excel->setCellValue("B$vx", "CONDICIONES COMERCIALES:");
            $excel->setCellValue("G$vx", "IVA:");
            $excel->setCellValue("H$vx", "=(H$vc * 0.13)");
            $vb = $tx + 3;
            $excel->setCellValue("B$vb", "Forma de Pago: Según condiciones del acuerdo del Contrato Marco, periodo 2019 al 2021");
            $excel->setCellValue("G$vb", "TOTAL:");
            $excel->setCellValue("H$vb", "=(H$vc + H$vx)");
            $reporte->getActiveSheet($i)->getStyle("H$vc:H$vb")->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
            );
            $tm = $vc - 1;
            while ($tm <= 14) {
                $tm++;
                $reporte->getActiveSheet($i)->getStyle("B$tm:H$tm")->applyFromArray($estilo3);
            }
            $reporte->getActiveSheet($i)->getRowDimension("$vc")->setRowHeight(35);
            $reporte->getActiveSheet($i)->getRowDimension("$vx")->setRowHeight(35);
            $reporte->getActiveSheet($i)->getRowDimension("$vb")->setRowHeight(35);
            $reporte->getActiveSheet($i)->getStyle("B17:H$tx")->getAlignment()->setWrapText(true);
            $reporte->getActiveSheet($i)->getStyle("F17:H$vb")->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD);
            $reporte->getActiveSheet($i)->getStyle("B17:H$tx")->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
            );
            $reporte->getActiveSheet($i)->getStyle("C17:C$tx")->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
            );




            $reporte->getActiveSheet($i)->getStyle("B16:H$tx")->applyFromArray($estilo1);
            $reporte->getActiveSheet($i)->getStyle("C16:D$tx")->applyFromArray($sb);

            $rt = 16;
            for ($io=0; $io < count($z); $io++) { 
                $rt++;
                $reporte->getActiveSheet($i)->getStyle("C16:D$rt")->applyFromArray($psd);
                $reporte->getActiveSheet($i)->getStyle("C17:D$rt")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ffff');
            }

            
            

           






            $yu = $vb + 8;
            $excel->setCellValue("B$yu", "$sv");
            $excel->setCellValue("G$yu", "Rony Melvin Laryn");
            $yu++;
            $excel->setCellValue("B$yu", "$su");
            $excel->setCellValue("G$yu", "Por Intesal S.A de C.V");
            $reporte->getActiveSheet($i)->getStyle("B$vc:H$yu")->getFont()->setBold(true)->setName('Times New Roman')->setSize(11)->getColor()->setRGB('100000');
            while ($tm <= $yu) {
                $tm++;
                $reporte->getActiveSheet($i)->getStyle("B$tm:H$tm")->applyFromArray($estilo3);
            }
            $reporte->getActiveSheet($i)->getStyle("G$vc:H$vc")->applyFromArray($xi);
            $reporte->getActiveSheet($i)->getStyle("G$vx:H$vx")->applyFromArray($xi);
            $reporte->getActiveSheet($i)->getStyle("G$vb:H$vb")->applyFromArray($xi);
            $reporte->getActiveSheet($i)->getStyle("G$vc:H$vb")->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
            );


            $reporte->getActiveSheet($i)->getStyle("B16:h16")->applyFromArray($estilo4);
            $reporte->getActiveSheet($i)->getStyle("C16:D16")->applyFromArray($sb);
            $reporte->getActiveSheet($i)->getStyle("C16:D16")->applyFromArray($inter);



            $reporte->getActiveSheet($i)->getStyle("B$tx:H$tx")->applyFromArray($xi);
            $reporte->getActiveSheet($i)->getPageSetup()->setPrintArea("B1:H$tm");
            $reporte->getActiveSheet($i)->getStyle("B9:H13")->getAlignment()->setWrapText(true);
            $reporte->getActiveSheet($i)->getPageSetup()->setScale(60);
        }

##################################################################################################################################################################      
        $i ++;
        $excel = $reporte->createSheet($i);
        $excel->setTitle("RESUMEN");
        $reporte->setActiveSheetIndex($i);
        $logo_i = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $logo_i->setName('TELEFONICA');
        $logo_i->setDescription('LOGO TELEFONICA');
        $logo_i->setPath('assets/sistema/telefonicax.jpg');
        $logo_i->setCoordinates('B1');
        $logo_i->setOffsetX(0);
        $logo_i->setOffsetY(15);
        $logo_i->setHeight(70);
        $logo_i->setWorksheet($reporte->getActiveSheet($i));
        $reporte->getActiveSheet($i)->getColumnDimension('B')->setWidth(8);
        $reporte->getActiveSheet($i)->getColumnDimension('C')->setWidth(15);
        $reporte->getActiveSheet($i)->getColumnDimension('D')->setWidth(15);
        $reporte->getActiveSheet($i)->getColumnDimension('E')->setWidth(30);
        $reporte->getActiveSheet($i)->getColumnDimension('F')->setWidth(35);
        $reporte->getActiveSheet($i)->getColumnDimension('G')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('H')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('I')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('J')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('K')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('L')->setWidth(20);
        $excel->setCellValue("B7","DIRECCION DE TECNOLOGIA OPERACIONES Y SISTEMAS");
        $excel->setCellValue("B8","GERENCIA: ASISTENCIA TECNICA");
        $excel->setCellValue("B9","RESUMEN DE COMPRA:");
        $excel->setCellValue("B10","SOLP No.:");
        $excel->setCellValue("B11","ORDEN DE COMPRA:");
        $excel->setCellValue("B12","CONTRATO MARCO:");
        $excel->setCellValue("J7","CODIGO:");
        $excel->setCellValue("J11","CENTRO DE COSTO");
        $excel->setCellValue("K11","CUENTA DE GASTOS No.");
        $excel->setCellValue("L11","ELEMENTO PEP 2o NIVEL/ORDEN DE INVERSION");  
        $reporte->getActiveSheet($i)->getStyle("J7:K7")->applyFromArray($estilo1);
        $reporte->getActiveSheet($i)->getStyle("J11:L12")->applyFromArray($estilo1);
        $reporte->getActiveSheet($i)->getStyle("J11:L12")->getAlignment()->setWrapText(true);
        $reporte->getActiveSheet($i)->getStyle("J11:L12")->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->getActiveSheet($i)->setShowGridlines(False);
        $excel->setCellValue("B14","POS. ORDEN");
        $excel->setCellValue("C14","OFERTA");
        $excel->setCellValue("D14","FECHA");
        $excel->setCellValue("E14","DESCRIPCIÓN  /ESPECIFICACIONES");
        $excel->setCellValue("F14","ID");
        $excel->setCellValue("G14","SERIE");
        $excel->setCellValue("H14","TOTAL INSTALACION");
        $excel->setCellValue("I14","TOTAL OFERTA");
        $excel->setCellValue("J14","MONTO POS.OC");
        $excel->setCellValue("K14","PORCENTAJE DE POSICION OC A PAGAR. %");
        $excel->setCellValue("L14","TOTAL PORCENTAJE  OC A PAGAR %");
        $f = 0;
        $q = 14;
        $cs = 0;
        for ($Y=0; $Y < $d; $Y++) {
        $result = $this->Model_r_e1->get_table_ofertas($c[$Y]);
            foreach ($result as $key => $value) {
                $cs += $value->costo;
            }
        }
        for ($Y=0; $Y < $d; $Y++) {
        $result = $this->Model_r_e1->get_table_ofertas($c[$Y]);
        foreach ($result as $key => $value) {
        $f++;
        $q++;
        $excel->setCellValue("B$q",$f);
        $excel->setCellValue("C$q",'INTE. '.$value->correlativo);
        $excel->setCellValue("D$q",$value->fecha);
        $excel->setCellValue("E$q",$value->proyecto);
        $excel->setCellValue("F$q","");
        $excel->setCellValue("H$q",$value->costo);
        $excel->setCellValue("I$q",$value->costo);
        $excel->setCellValue("K$q","=(($value->costo * 100)/$cs)");
        }
        $reporte->getActiveSheet($i)->getStyle("B14:L14")->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->getActiveSheet($i)->getStyle("B14:L$q")->applyFromArray($estilo1);
        $reporte->getActiveSheet($i)->getStyle("B14:L14")->applyFromArray($estilo4);
        $reporte->getActiveSheet($i)->getStyle("B14:L14")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('6AB4DE');
        }
        $q1 = $q;
        $q1++;
        $excel->setCellValue("I$q1","=SUM(I15:I$q)");
        $excel->setCellValue("J15","=(I$q1)");
        $excel->setCellValue("J$q1","=SUM(J15:J$q)");
        $excel->setCellValue("k$q1","=SUM(K15:K$q)");
        $excel->setCellValue("L15","=SUM(K15:K$q)");
        $excel->setCellValue("L$q1","=(L15)");
        $reporte->getActiveSheet($i)->getStyle("H15:J$q1")->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD);
        $reporte->getActiveSheet($i)->getStyle("K15:L$q1")->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_00);
        $reporte->getActiveSheet($i)->getStyle("B14:L$q1")->getAlignment()->setWrapText(true);
        $reporte->getActiveSheet($i)->getStyle("B15:L$q1")->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->getActiveSheet($i)->getStyle("E15:F$q1")->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->setActiveSheetIndex($i)->mergeCells("J15:J$q");
        $reporte->setActiveSheetIndex($i)->mergeCells("L15:L$q");
        $fm = $q;
        $q++;
        $reporte->setActiveSheetIndex($i)->mergeCells("B$q:H$q");
        $excel->setCellValue("B$q",'TOTAL');
        $excel->setCellValue("F$q","=SUM(F15:F$fm)");

        $reporte->getActiveSheet($i)->getStyle("B$q")->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->getActiveSheet($i)->getStyle("B$q:L$q")->applyFromArray($estilo1);
        $q = $q + 5;
        $excel->setCellValue("B$q",'Nombre de la persona que representa a la Contratista o Proveedor');
        $q++;
        $excel->setCellValue("B$q",'INSTALACIONES TELEFONICAS SALVADOREÑAS S.A. DE C.V.');
        $q++;
        $excel->setCellValue("B$q",'Proveedor');
        $q = $q + 3;
        $excel->setCellValue("B$q",'Elaboradao por');
        $q++;
        $excel->setCellValue("B$q",'Por TELEFONICA');
        $q = $q + 3;
        $excel->setCellValue("B$q",'Nombre del Jefe de Area');
        $q++;
        $excel->setCellValue("B$q",'Jefatura');
##################################################################################################################################################################
        $i++;
        $excel = $reporte->createSheet($i);
        $excel->setTitle("CONSOLIDADO");
        $reporte->setActiveSheetIndex($i);
        $reporte->getActiveSheet($i)->setShowGridlines(false);
        $qw = $this->Model_r_e1->obtener_item($c);

        $reporte->getActiveSheet($i)->getColumnDimension('B')->setWidth(15);
        $reporte->getActiveSheet($i)->getColumnDimension('C')->setWidth(50);
        $reporte->getActiveSheet($i)->getColumnDimension('D')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('E')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('F')->setWidth(20);
        $reporte->getActiveSheet($i)->getColumnDimension('G')->setWidth(20);

        $logo_i = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $logo_i->setName('TELEFONICA');
        $logo_i->setDescription('LOGO TELEFONICA');
        $logo_i->setPath('assets/sistema/telefonicax.jpg');
        $logo_i->setCoordinates('B1');
        $logo_i->setOffsetX(0);
        $logo_i->setOffsetY(15);
        $logo_i->setHeight(70);
        $logo_i->setWorksheet($reporte->getActiveSheet($i));
        $logo_t = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $logo_t->setName('INTESAL');
        $logo_t->setDescription('LOGO INTESAL');
        $logo_t->setPath('assets/img/logo.png');
        $logo_t->setCoordinates('F1');
        $logo_t->setOffsetX(20);
        $logo_t->setOffsetY(15);
        $logo_t->setHeight(70);
        $logo_t->setWorksheet($reporte->getActiveSheet($i));
        $reporte->setActiveSheetIndex($i)->mergeCells("B7:C7");
        $excel->setCellValue("B7", "PRECIARIOS DE E1 Y CABLEADOS DE RED MOVIL Y FIJA ");
        $excel->setCellValue("B10", "CODIGO");
        $excel->setCellValue("C10", "DESCRIPCION");
        $excel->setCellValue("D10", "MEDIDA");
        $excel->setCellValue("E10", "CANTIDAD");
        $excel->setCellValue("F10", "P. UNITARIO");
        $excel->setCellValue("G10", "TOTAL");

        $rt = 10;
        $yr = 0;
        foreach ($qw as $key => $value) {
            $rt++;
            $yr++;
            $excel->setCellValue("B$rt", $yr);
            $excel->setCellValue("C$rt", $value->item);
            $excel->setCellValue("D$rt", $value->unidad_medida);
            $excel->setCellValue("E$rt", $value->cuenta);
            $excel->setCellValue("F$rt", $value->precio);
            $excel->setCellValue("G$rt", "=(E$rt * F$rt)");
        }

        $reporte->getActiveSheet($i)->getStyle("B11:G$rt")->applyFromArray($estilo1);
        $reporte->getActiveSheet($i)->getStyle("B11:G$rt")->getAlignment()->setWrapText(true);
        $reporte->getActiveSheet($i)->getStyle("B10:G10")->applyFromArray($estilo4);
        $reporte->getActiveSheet($i)->getStyle("B10:G10")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('6AB4DE');
        $reporte->getActiveSheet($i)->getStyle("B10:G$rt")->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->getActiveSheet($i)->getStyle("C11:C$rt")->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );
        $reporte->getActiveSheet($i)->getStyle("G11:G$rt")->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD);
        $ch = $rt;
        $rt++;
        $r1 = $rt;
        $excel->setCellValue("F$rt", "SUBTOTAL:");
        $excel->setCellValue("G$rt", "=SUM(G11:G$ch)");
        $rt++;
        $r2 = $rt;
        $excel->setCellValue("F$rt", "IVA:");
        $excel->setCellValue("G$rt", "=(G$r1 * 0.13)");

        $excel->setCellValue("B$r2", "CONDICIONES COMERCIALES:");
        $rt++;
        $r3 = $rt;
        $excel->setCellValue("F$rt", "TOTAL:");
        $excel->setCellValue("G$rt", "=sum(G$r1:G$r2)");

        $excel->setCellValue("B$r3", "Forma de Pago: Según condiciones del acuerdo del Contrato Marco, periodo 2019 al 2021");

        $reporte->getActiveSheet($i)->getStyle("F$r1:G$r1")->applyFromArray($xi);
        $reporte->getActiveSheet($i)->getStyle("F$r2:G$r2")->applyFromArray($xi);
        $reporte->getActiveSheet($i)->getStyle("F$r3:G$r3")->applyFromArray($xi);
        $reporte->getActiveSheet($i)->getRowDimension("$r1")->setRowHeight(35);
        $reporte->getActiveSheet($i)->getRowDimension("$r2")->setRowHeight(35);
        $reporte->getActiveSheet($i)->getRowDimension("$r3")->setRowHeight(35);
        $reporte->getActiveSheet($i)->getStyle("F$r1:G$r3")->getAlignment()->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
            );
        $reporte->getActiveSheet($i)->getStyle("B$r1:G$r3")->getFont()->setBold(true)->setName('Times New Roman')->setSize(11)->getColor()->setRGB('100000');
        $reporte->setActiveSheetIndex($i)->mergeCells("B$r2:D$r2");
        $reporte->setActiveSheetIndex($i)->mergeCells("B$r3:D$r3");
        $reporte->getActiveSheet($i)->getStyle("G$r1:G$r3")->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD);
        $reporte->getActiveSheet($i)->getStyle("B$rt")->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER)
        );

        $r4 = $r3 + 4;
        $reporte->setActiveSheetIndex($i)->mergeCells("B$r4:C$r4");
        $reporte->setActiveSheetIndex($i)->mergeCells("F$r4:G$r4");
        $excel->setCellValue("B$r4", "Ing. Juan Vicente");
        $excel->setCellValue("F$r4", "Roni Melvin Larín");
        $r4++;
        $reporte->setActiveSheetIndex($i)->mergeCells("F$r4:G$r4");
        $reporte->setActiveSheetIndex($i)->mergeCells("B$r4:C$r4");
        $excel->setCellValue("B$r4", "Supervisor de Planta Externa");
        $excel->setCellValue("F$r4", "Por Intesal S.A. de C.V.");

        $archivo = "Resumen de ofertas.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $archivo . '"');
        header('Cache-Control: max-age=0');

        $imprimir = IOFactory::createWriter($reporte, 'Xlsx');
        $imprimir->save('php://output');
        exit;

    }
}



