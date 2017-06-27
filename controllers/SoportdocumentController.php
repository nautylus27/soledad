<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\RegisterUsers;

class SoportdocumentController extends \yii\web\Controller
{
	
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
	
	
	
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	
	public function actionDocument(){
		$response = RegisterUsers::queryAllRegisterDocument();
		echo json_encode($resquest = ["response" => $response, "message" => "Actualizando", "title" => "Registro Exitoso", "type" => "success"]);
	}
	
	
	
	public function actionVerification(){
		$postData = file_get_contents("php://input");
        $id_register = json_decode($postData, true);
		
	    $model= RegisterUsers::findOne($id_register);
		
		$model->id_status_request=3;
		
		if($model->save()){
			$response = RegisterUsers::queryAllRegisterDocument();
		    echo json_encode($resquest = ["response" => $response, "message" => "Actualizando", "title" => "Registro Exitoso", "type" => "success"]);
		}
		else {
			 echo json_encode($resquest = ["response" => $response, "message" => "Error", "title" => "Error", "type" => "error"]);
		}
		
	}
	
	public function actionModalnew() {
        $this->layout = 'modalnew';
        return $this->render('soport');
    }

}
