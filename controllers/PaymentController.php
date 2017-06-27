<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\RegisterUsers;
use app\models\Facturacion;

class PaymentController extends \yii\web\Controller {

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

    public static function actionSaveregister() {
        $postData = file_get_contents("php://input");
        $post = json_decode($postData, true);


        if (isset($post['cb1'])) {
            $combo = $post['cb1'];
        } else {
            $combo = 0;
        }
        if (isset($post['cb2'])) {
            $ap = $post['cb2'];
        } else {
            $ap = 0;
        }
        if (isset($post['cb3'])) {
            $rifa = $post['cb3'];
        } else {
            $rifa = 0;
        }
        $registro = '24.500';
        $suma = $combo + $ap + $rifa + $registro;
        $monto_iva=$suma*0.19;
        $total_iva=$monto_iva+$suma;
        $formatoMontoIva=number_format((float) $monto_iva, 3, '.', '');
        $formatoTotalIva=number_format((float) $total_iva, 3, '.', '');
        $formatoTotal=number_format((float) $suma, 3, '.', '');

        $parametersAcreedores = [];
        $parametersAcreedores ['registro'] = number_format((float) $registro, 3, '.', '');
        $parametersAcreedores ['combo'] = number_format((float) $combo, 3, '.', '');
        $parametersAcreedores ['accidente_personal'] = number_format((float) $ap, 3, '.', '');
        $parametersAcreedores ['rifa'] = number_format((float) $rifa, 3, '.', '');
        $parametersAcreedores ['total'] = number_format((float) $suma, 3, '.', '');


        $model = new RegisterUsers;
        $model->register_name_user = strtoupper($post['name']);
        $model->register_dni = strtoupper($post['dni']);
        $model->register_code_qr = strtoupper($post['code']);
        $model->id_status_request = 1;
//        $model->concepto= json_encode($parametersAcreedores);
        $model->date_create = date('Y-m-d');


        if ($model->save()) {

            $modelFactura = new Facturacion;
            $modelFactura->id_register_user= $model->id_register_user;
            $modelFactura->concepto=json_encode($parametersAcreedores);
            $modelFactura->monto_iva=$formatoMontoIva;
            $modelFactura->total_iva=$formatoTotalIva;
            $modelFactura->total=$formatoTotal;
            $modelFactura->save();
            
           $response = RegisterUsers::queryAllRegister();
            $lastCodeQr= RegisterUsers::codeQr();
            echo json_encode($resquest = ["response" => $response, "message" => "Actualizando", "title" => "Registro Exitoso", "type" => "success", "lastCodeQr" => $lastCodeQr]);
        } else {
            echo json_encode($resquest = ["response" => $response, "message" => "Actualizando", "title" => "erro", "type" => "error", "lastCodeQr" => "Ningún código asignado"]);
        }
    }

    public static function actionQueryallregister() {
        $response = RegisterUsers::queryAllRegister();
        $lastCodeQr= RegisterUsers::codeQr();
       
        echo json_encode($resquest = ["response" => $response, "message" => "Actualizando", "title" => "Registro Exitoso", "type" => "success", "lastCodeQr" => $lastCodeQr]);
    }

    public function actionModalnew() {
        $this->layout = 'modalnew';
        return $this->render('deleteregister');
    }

    public function actionDeleteregister() {
        $postData = file_get_contents("php://input");
        $id_register = json_decode($postData, true);
        $model = RegisterUsers::findOne($id_register);


        if ($model->delete()) {
            $response = RegisterUsers::queryAllRegister();
            echo json_encode($resquest = ["response" => $response, "message" => "Actualizando", "title" => "Registro Exitoso", "type" => "success"]);
        } else {
            echo json_encode($resquest = ["response" => null, "message" => "Error", "title" => "Error al eleminar el registro", "type" => "error"]);
        }
    }

}
