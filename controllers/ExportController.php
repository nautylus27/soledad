<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Facturacion;
use mPDF;

class ExportController extends \yii\web\Controller {
    
     public function beforeAction($action) {
        try {
            $this->enableCsrfValidation = FALSE;
            return parent::beforeAction($action);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                        [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

     /**
     * @inheritdoc
     *recibe un arreglo, hace consulta a todas las facturas y genera el PDF
     */

    public function actionPdf() {
        $dataUsers=json_decode($_GET['data']);
        $dataFactura= Facturacion::queryAllFactura($dataUsers->id_register_user);
        $dataMonto=json_decode($dataFactura['concepto']);
        $nameFile="factura_".date('Y-m-d')."-".$dataUsers->register_dni;
        $content = self::report($dataUsers, $dataFactura, $dataMonto);
        self::genPDF($content,$nameFile ,false);
    }

     /**
     * @inheritdoc
     *recibe tres array para armar los datos del PDF
     */

    public static function report($dataUsers, $dataFactura, $dataMonto) {
        
        
        $content = Array();
        $fecha = date('Y-m-d');
        $dia = date('d');
        $year = date('Y');
        $mes = date('F');
        $numeroFac=$dataFactura['id_facturacion'];
        $nombreCliente=$dataUsers->register_name_user;
        $direccionCliente="SOLEDAD";
        $ciudadCliente="BARRANQUILLA";
        $cedulaCliente=$dataUsers->register_dni;
        $telefonoCliente="---------";
        $tipo="CENSO SOLEDAD";
        $sumaTotal=$dataMonto->total;
        $monto_iva= $dataFactura['monto_iva'];
        $sumaTotalIva=$dataFactura['total_iva'];
        
        
        //***captuarar las variables
        
        if ($dataMonto->combo==="0.000"){
            $cantidadCombo=0;
            $valorCombo=0;
            $valorTotalCombo=0;
        }
        else {
            $cantidadCombo=1;
            $valorCombo="$498.000";
            $valorTotalCombo="$498.000";
        }
        if ($dataMonto->accidente_personal==="0.000"){
            $cantidadAp=0;
            $valorAp=0;
            $valorTotalAp=0;
        }
        else {
            $cantidadAp=1;
            $valorAp="$28.000";
            $valorTotalAp="$28.000";
        }
        if ($dataMonto->rifa==="0.000"){
            $cantidadRifa=0;
            $valorRifa=0;
            $valorTotalRifa=0;
        }
        else {
            $cantidadRifa=1;
            $valorRifa="$10.000";
            $valorTotalRifa="$10.000";
        }
        
   

        $arraFrom = Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $arraTo = Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

        $mesSp = str_replace($arraTo, $arraFrom, $mes);





        $content[0] = '<div style="padding-top:-15px;">'
                . '<table border="0">'
                . '<tr>'
                . '<td style="width:400 px"><img src="imagen/logo_dataservip.png" width="30%"></td>'
                . '<td style="width:400 px; color:#FF0000; text-align:center">ORIGINAL</td>'
                . '</tr>'
                . '<tr>'
                . '<td style="font-size:12px; font-weight: bold;">NIT.900.910.407-3</td>'
                . '</tr>'
                . '<tr>'
                . '<td></td>'
                . '<td style="font-size:9px; text-align:center">IVA RÉGIMEN COMÚN</td>'
                . '</tr>'
                . '<tr>'
                . '<td></td>'
                . '<td style="font-size:9px; text-align:center">Resolución DIAN 00055 de 14/jul/2016 Rango 0001 a 6000</td>'
                . '</tr>'
                . '</table><hr>'
                . '<div style="text-align:center"><span style="font-weight: bold">FACTURA DE VENTA Nro.  <span>'.$numeroFac.'</span> </span></div>'
                . '</div>';
        $content[1] = '<div style="padding-top:110px;">'
                        . '<div  style="float: left; width:650px;">'
                            . '<div style="float: left; width:180px;">'
                                . '<div style="border-radius:10px; border: 1px solid #000000; height: 45px;">'
                                        . '<div style="margin-left:10px; margin-top:5px;">'
                                            . '<div><span style="font-size:9px;">No somos Grandes Contribuyentes</span></div>'
                                            . '<div><span style="font-size:9px;">No somos Retenedores de IVA</span></div>'
                                            . '<div><span style="font-size:9px;">Factura Generada por Computador</span></div>'
                                        . '</div>'
                                . '</div>'
                            . '</div>'
                            . '<div style="margin-left:410px;">'
                                    . '<div>'
                                        . '<table border="1" colspan="0" style="border-collapse: collapse;">'
                                                . '<tr>'
                                                    . '<td style="text-align:center"><span style="font-weight: bold; font-size:9px;">FECHA FACTURACIÓN</span></td>'
                                                    . '<td style="text-align:center"><span style="font-weight: bold; font-size:9px;">PERIODO DE FACTURACIÓN</span></td>'
                                                . '</tr>'
                                                . '<tr>'
                                                    . '<td style="text-align:center"><span style=" font-size:9px;">' . $fecha . '</span></td>'
                                                    . '<td style="text-align:center"><span style=" font-size:9px;">'.$mesSp.' '.$year.'</span></td>'
                                                . '</tr>'
                                        . '</table>'
                                    . '</div>'
                            . '</div>'
                        . '</div>'
                        . '<div style="float: left; width:50px;"><img src="imagen/softland.png" width="20px;"></div>'
                        . '<div style="margin-top:-190px">'
                                . '<div>'
                                    . '<table border="0">'
                                        . '<tr>'
                                            . '<td style="width:520px;"><span style="font-size:9px; font-weight: bold;">CLIENTE :</span> <span style="font-size:9px;">'.$nombreCliente.'</span></td>'
                                            . '<td><span style="font-size:9px;font-weight: bold;">DIRECCIÓN  :</span> <span style="font-size:9px;">'.$direccionCliente.'</span></td>'
                                        . '</tr>'
                                        . '<tr>'
                                            . '<td><span style="font-size:9px;font-weight: bold;">NIT/CÉDULA :</span> <span style="font-size:9px;">'.$cedulaCliente.'</span></td>'
                                            . '<td><span style="font-size:9px;font-weight: bold;">CIUDAD  :</span> <span style="font-size:9px;">'.$ciudadCliente.'</span></td>'
                                        . '</tr>'
                                        . '<tr>'
                                            . '<td><span style="font-size:9px;font-weight: bold;">TIPO : </span><span style="font-size:9px;">'.$tipo.'</span></td>'
                                            . '<td><span style="font-size:9px;font-weight: bold;">TELEFONO  : </span><span style="font-size:9px;">'.$telefonoCliente.'</span></td>'
                                        . '</tr>'
                                    . '</table>'
                                . '</div>'
                            . '<div>'
                                . '<table border="1" style="border-collapse: collapse;">'
                                    . '<tr>'
                                        . '<th style="background-color: #BDBDBD;font-size:9px; text-align:center; width:355px">DESCRIPCIÓN</th>'
                                        . '<th style="background-color: #BDBDBD;font-size:9px; text-align:center">CANTIDAD</th>'
                                        . '<th style="background-color: #BDBDBD;font-size:9px; text-align:center; width:120px">VR UNIT</th>'
                                        . '<th style="background-color: #BDBDBD;font-size:9px; text-align:center; width:120px">VR TOTAL</th>'
                                    . '</tr>'
                                    . '<tr>'
                                        . '<td style="font-size:10px;"><span>Registro</span></td>'
                                        . '<td style="text-align:center; font-size:10px"><span>1</span></td>'
                                        . '<td style="text-align:center; font-size:10px"><span>$24.500</span></td>'
                                        . '<td style="text-align:center; font-size:10px"><span>$24.500</span></td>'
                                    . '</tr>'
                                    . '<tr>'
                                        . '<td style="font-size:10px;"><span>Combo (SOA + Accidente Personal)</span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span>'.$cantidadCombo.'</span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span>'.$valorCombo.'</span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span>'.$valorTotalCombo.'</span></td>'
                                    . '</tr>'
                                    . '<tr>'
                                        . '<td style="font-size:10px;"><span>Accidente Personal</span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span>'.$cantidadAp.'</span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span>'.$valorAp.'</span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span>'.$valorTotalAp.'</span></td>'
                                    . '</tr>'
                                    . '<tr>'
                                        . '<td style="font-size:10px;"><span>Rifa</span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span>'.$cantidadRifa.'</span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span>'.$valorRifa.'</span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span>'.$valorTotalRifa.'</span></td>'
                                    . '</tr>'
                                    . '<tr>'
                                        . '<td><span></span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span></span></td>'
                                        . '<td style="text-align:center; font-size:10px; font-weight: bold; "><span>SUBTOTAL</span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span>$'.$sumaTotal.'</span></td>'
                                    . '</tr>'
                                    . '<tr>'
                                        . '<td style="border-left: 1px hidden; border-right: 1px hidden; border-bottom: 1px hidden;"><span></span></td>'
                                        . '<td style="text-align:center; font-size:10px; border-left: 1px hidden; border-bottom: 1px hidden;"><span></span></td>'
                                        . '<td style="text-align:center; font-size:10px; font-weight: bold; "><span>IVA</span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span>$'.$monto_iva.'</span></td>'
                                    . '</tr>'
                                    . '<tr>'
                                        . '<td style="border-left: 1px hidden; border-bottom: 1px hidden;"><span></span></td>'
                                        . '<td style="text-align:center; font-size:10px;border-left: 1px hidden; border-bottom: 1px hidden;"><span></span></td>'
                                        . '<td style="text-align:center; font-size:10px; font-weight: bold;  "><span>TOTAL</span></td>'
                                        . '<td style="text-align:center; font-size:10px;"><span>$'.$sumaTotalIva.'</span></td>'
                                    . '</tr>'
                                . '</table>'
                            . '</div>'
                        . '</div>'
                        .'<div style="margin-top:-10px;">'
                            . '<hr>'
                                . '<table style="width:700px;">'
                                . '<tr>'
                                    . '<td style="font-size:10px;">Carrera 24 N 67-44 oficina 411<br>Centro comercial Las Rampas<br><span style="font-weight: bold;">PBX(1) 249 89 92/ 703 71 31</span><span><br>315 365 47 09 - 321 429 67 44<br>304 469 95 05<br></span><span style="font-weight: bold;">Bogotá - Cundinamarca</span></td>'
                                    . '<td style="font-size:10px; text-align:center">Carrera 43 N 72-122 Oficina 402-A<br>Edificio de Profesionales<br>301 39595 53 - 321 779 59 38<br><span style="font-weight: bold;">PBX(5)</span>3350731<br><br><span style="font-weight: bold;">Barranquilla - Atlántico</span></td>'
                                    . '<td style="font-size:10px; text-align:center">304 384 64 84<br><span style="font-weight: bold">Armenia- Quindio</span><br><br><br><span>304 469 95 05</span><br><span style="margin-top:20px; font-weight: bold">Cali -Valle del Cauca</span></td>'
                                     . '<td style="font-size:10px; text-align:center">Carrera 79 N 48 B-60<br><span style="font-weight: bold">Sector Estadio</span><br><span style="font-weight: bold;">PBX(054)</span> 448 10 73<br><span>315 365 47 09</span><br><br><span style="margin-top:20px; font-weight: bold">Medellín - Antioquia</span></td>'
                                . '</tr>'
                                . '<tr>'
                                    . '<td colspan="4" style="text-align: center; font-size:10px;"><span>www.dataservip.com.co - E-mail: contactenos@inverther.com.co</span></td>'
                                . '</tr>'
                                . '</table>'
                        . '</div>'
                        . '<div style="font-weight: bold; margin-top:5px;">- - - - - - - - - - - - - - - -  - - - - - - - - - - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </div>'
                        . '<div>'
                                . '<div style="padding-top:2px;">'
                                        . '<table border="0">'
                                            . '<tr>'
                                                . '<td style="width:400 px"><img src="imagen/logo_dataservip.png" width="30%"></td>'
                                                . '<td style="width:400 px; color:#FF0000; text-align:center">COPIA</td>'
                                            . '</tr>'
                                            . '<tr>'
                                                . '<td style="font-size:12px; font-weight: bold;">NIT.900.910.407-3</td>'
                                            . '</tr>'
                                            . '<tr>'
                                                . '<td></td>'
                                                . '<td style="font-size:9px; text-align:center">IVA RÉGIMEN COMÚN</td>'
                                            . '</tr>'
                                            . '<tr>'
                                                . '<td></td>'
                                                . '<td style="font-size:9px; text-align:center">Resolución DIAN 00055 de 14/jul/2016 Rango 0001 a 6000</td>'
                                            . '</tr>'
                                        . '</table>'
                                        . '<hr>'
                                        . '<div style="text-align:center"><span style="font-weight: bold">FACTURA DE VENTA Nro.  <span>'.$numeroFac.'</span> </span></div>'
                                . '</div>'
                        . '</div>'
                        . '<div style="padding-top:10px;">'
                            . '<div  style="float: left; width:650px;">'
                                . '<div style="float: left; width:180px;">'
                                    . '<div style="border-radius:10px; border: 1px solid #000000; height: 45px;">'
                                            . '<div style="margin-left:10px; margin-top:5px;">'
                                                . '<div><span style="font-size:9px;">No somos Grandes Contribuyentes</span></div>'
                                                . '<div><span style="font-size:9px;">No somos Retenedores de IVA</span></div>'
                                                . '<div><span style="font-size:9px;">Factura Generada por Computador</span></div>'
                                            . '</div>'
                                    . '</div>'
                                . '</div>'
                                . '<div style="margin-left:410px;">'
                                        . '<div>'
                                            . '<table border="1" colspan="0" style="border-collapse: collapse;">'
                                                    . '<tr>'
                                                        . '<td style="text-align:center"><span style="font-weight: bold; font-size:9px;">FECHA FACTURACIÓN</span></td>'
                                                        . '<td style="text-align:center"><span style="font-weight: bold; font-size:9px;">PERIODO DE FACTURACIÓN</span></td>'
                                                    . '</tr>'
                                                    . '<tr>'
                                                        . '<td style="text-align:center"><span style=" font-size:9px;">' . $fecha . '</span></td>'
                                                        . '<td style="text-align:center"><span style=" font-size:9px;">'.$mesSp.' '.$year.'</span></td>'
                                                    . '</tr>'
                                            . '</table>'
                                        . '</div>'
                                . '</div>'
                            . '</div>'
                            . '<div style="float: left; width:50px;"><img src="imagen/softland.png" width="20px;"></div>'
                            . '<div style="margin-top:-180px">'
                                    . '<div>'
                                            . '<table border="0">'
                                                . '<tr>'
                                                    . '<td style="width:520px;"><span style="font-size:9px; font-weight: bold;">CLIENTE :</span> <span style="font-size:9px;">'.$nombreCliente.'</span></td>'
                                                    . '<td><span style="font-size:9px;font-weight: bold;">DIRECCIÓN  :</span> <span style="font-size:9px;">'.$direccionCliente.'</span></td>'
                                                . '</tr>'
                                                . '<tr>'
                                                    . '<td><span style="font-size:9px;font-weight: bold;">NIT/CÉDULA :</span> <span style="font-size:9px;">'.$cedulaCliente.'</span></td>'
                                                    . '<td><span style="font-size:9px;font-weight: bold;">CIUDAD  :</span> <span style="font-size:9px;">'.$ciudadCliente.'</span></td>'
                                                . '</tr>'
                                                . '<tr>'
                                                    . '<td><span style="font-size:9px;font-weight: bold;">TIPO : </span><span style="font-size:9px;">'.$tipo.'</span></td>'
                                                    . '<td><span style="font-size:9px;font-weight: bold;">TELEFONO  : </span><span style="font-size:9px;">'.$telefonoCliente.'</span></td>'
                                                . '</tr>'
                                            . '</table>'
                                    . '</div>'
                                    . '<div>'
                                        . '<table border="1" style="border-collapse: collapse;">'
                                            . '<tr>'
                                                . '<th style="background-color: #BDBDBD;font-size:9px; text-align:center; width:355px">DESCRIPCIÓN</th>'
                                                . '<th style="background-color: #BDBDBD;font-size:9px; text-align:center">CANTIDAD</th>'
                                                . '<th style="background-color: #BDBDBD;font-size:9px; text-align:center; width:120px">VR UNIT</th>'
                                                . '<th style="background-color: #BDBDBD;font-size:9px; text-align:center; width:120px">VR TOTAL</th>'
                                            . '</tr>'
                                            . '<tr>'
                                                . '<td style="font-size:10px;"><span>Registro</span></td>'
                                                . '<td style="text-align:center; font-size:10px"><span>1</span></td>'
                                                . '<td style="text-align:center; font-size:10px"><span>$24.500</span></td>'
                                                . '<td style="text-align:center; font-size:10px"><span>$24.500</span></td>'
                                            . '</tr>'
                                            . '<tr>'
                                                . '<td style="font-size:10px;"><span>Combo (SOA + Accidente Personal)</span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span>'.$cantidadCombo.'</span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span>'.$valorCombo.'</span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span>'.$valorTotalCombo.'</span></td>'
                                            . '</tr>'
                                            . '<tr>'
                                                . '<td style="font-size:10px;"><span>Accidente Personal</span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span>'.$cantidadAp.'</span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span>'.$valorAp.'</span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span>'.$valorTotalAp.'</span></td>'
                                            . '</tr>'
                                            . '<tr>'
                                                . '<td style="font-size:10px;"><span>Rifa</span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span>'.$cantidadRifa.'</span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span>'.$valorRifa.'</span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span>'.$valorTotalRifa.'</span></td>'
                                            . '</tr>'
                                            . '<tr>'
                                                . '<td><span></span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span></span></td>'
                                                . '<td style="text-align:center; font-size:10px; font-weight: bold; "><span>SUBTOTAL</span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span>$'.$sumaTotal.'</span></td>'
                                            . '</tr>'
                                            . '<tr>'
                                                . '<td style="border-left: 1px hidden; border-right: 1px hidden; border-bottom: 1px hidden;"><span></span></td>'
                                                . '<td style="text-align:center; font-size:10px; border-left: 1px hidden; border-bottom: 1px hidden;"><span></span></td>'
                                                . '<td style="text-align:center; font-size:10px; font-weight: bold; "><span>IVA</span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span>$'.$monto_iva.'</span></td>'
                                            . '</tr>'
                                            . '<tr>'
                                                . '<td style="border-left: 1px hidden; border-bottom: 1px hidden;"><span></span></td>'
                                                . '<td style="text-align:center; font-size:10px;border-left: 1px hidden; border-bottom: 1px hidden;"><span></span></td>'
                                                . '<td style="text-align:center; font-size:10px; font-weight: bold;  "><span>TOTAL</span></td>'
                                                . '<td style="text-align:center; font-size:10px;"><span>$'.$sumaTotalIva.'</span></td>'
                                            . '</tr>'
                                        . '</table>'
                                    . '</div>'
                            . '</div>'
                        . '</div>'
                    . '</div>';
        $content[2] = '<div>'
                . '<hr>'
                 . '<table style="width:700px;">'
                                . '<tr>'
                                    . '<td style="font-size:10px;">Carrera 24 N 67-44 oficina 411<br>Centro comercial Las Rampas<br><span style="font-weight: bold;">PBX(1) 249 89 92/ 703 71 31</span><span><br>315 365 47 09 - 321 429 67 44<br>304 469 95 05<br></span><span style="font-weight: bold;">Bogotá - Cundinamarca</span></td>'
                                    . '<td style="font-size:10px; text-align:center">Carrera 43 N 72-122 Oficina 402-A<br>Edificio de Profesionales<br>301 39595 53 - 321 779 59 38<br><span style="font-weight: bold;">PBX(5)</span>3350731<br><br><span style="font-weight: bold;">Barranquilla - Atlántico</span></td>'
                                    . '<td style="font-size:10px; text-align:center">304 384 64 84<br><span style="font-weight: bold">Armenia- Quindio</span><br><br><br><span>304 469 95 05</span><br><span style="margin-top:20px; font-weight: bold">Cali -Valle del Cauca</span></td>'
                                     . '<td style="font-size:10px; text-align:center">Carrera 79 N 48 B-60<br><span style="font-weight: bold">Sector Estadio</span><br><span style="font-weight: bold;">PBX(054)</span> 448 10 73<br><span>315 365 47 09</span><br><br><span style="margin-top:20px; font-weight: bold">Medellín - Antioquia</span></td>'
                                . '</tr>'
                                . '<tr>'
                                    . '<td colspan="4" style="text-align: center; font-size:10px;"><span>www.dataservip.com.co - E-mail: contactenos@inverther.com.co</span></td>'
                                . '</tr>'
                  . '</table>'
                . '</div>';
        return $content;
    }

     /**
     * @inheritdoc
     *recibe un arreglo con todo el contenido de la estructura del PDF y genera el PDF
     */

    public static function genPDF($content,$nameFile ,$type) {


        $stylesheet = file_get_contents('css/style_pdf.css');
        $mpdf = new mPDF('P', 'LETTER', '', '', 15, 15, 10, 15);
        $mpdf->SetHTMLHeader("<div>$content[0]</div>");
        $mpdf->SetHTMLFooter("<div>$content[2]</div>");
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML("<div>$content[1]</div>");
        $mpdf->Output($nameFile.'.pdf','I');
    }

}
