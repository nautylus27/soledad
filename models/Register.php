<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "register_users".
 *
 * @property integer $id_register_user
 * @property string $register_name_user
 * @property integer $register_dni
 * @property string $register_code_qr
 * @property integer $id_status_request
 * @property string $date_create
 * @property string $concepto
 */
class Register extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'register_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['register_name_user', 'register_dni', 'register_code_qr', 'id_status_request', 'date_create'], 'required'],
            [['register_dni', 'id_status_request'], 'integer'],
            [['date_create'], 'safe'],
            [['register_name_user', 'register_code_qr', 'concepto'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_register_user' => 'Id Register User',
            'register_name_user' => 'Register Name User',
            'register_dni' => 'Register Dni',
            'register_code_qr' => 'Register Code Qr',
            'id_status_request' => 'Id Status Request',
            'date_create' => 'Date Create',
            'concepto' => 'Concepto',
        ];
    }
    
    public function queryAllRegister(){
		return $data = Yii::$app->db->createCommand("SELECT * FROM register AS r INNER JOIN status_request AS b ON r.id_status_request=b.id_status_requests WHERE r.date_create='".date('Y-m-d')."' AND r.id_status_request='1' ")->queryAll();
	}
	
	public function deleteRegister($id_register){
		return $data = Yii::$app->db->createCommand("DELETE FROM register WHERE id_register_user='".$id_register."'")->queryAll();
	}
	
	public function queryAllRegisterVeri(){
		return $data = Yii::$app->db->createCommand("SELECT * FROM register AS r INNER JOIN status_request AS b ON r.id_status_request=b.id_status_requests WHERE r.date_create='".date('Y-m-d')."' AND r.id_status_request in (1,2) ")->queryAll();
	}
	
	public function queryAllRegisterDocument(){
		return $data = Yii::$app->db->createCommand("SELECT * FROM register AS r INNER JOIN status_request AS b ON r.id_status_request=b.id_status_requests WHERE r.date_create='".date('Y-m-d')."' AND r.id_status_request in (2,3) ")->queryAll();
	}
}
