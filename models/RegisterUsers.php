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
 */
class RegisterUsers extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'register_users';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['register_name_user', 'register_dni', 'register_code_qr', 'id_status_request', 'date_create'], 'required'],
                [['register_dni', 'id_status_request'], 'integer'],
                [['date_create'], 'safe'],
                [['register_name_user', 'register_code_qr'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_register_user' => 'Id Register User',
            'register_name_user' => 'Register Name User',
            'register_dni' => 'Register Dni',
            'register_code_qr' => 'Register Code Qr',
            'id_status_request' => 'Id Status Request',
            'date_create' => 'Date Create',
        ];
    }
     /**
     * @inheritdoc
     *realiza una consulta en la tabla de los registros y muestra solo los registros del dia actual con estatus 1
     */

    public function queryAllRegister() {
        return $data = Yii::$app->db->createCommand("SELECT * FROM register_users AS r INNER JOIN status_request AS b ON r.id_status_request=b.id_status_requests WHERE r.date_create='" . date('Y-m-d') . "' AND r.id_status_request='1' ")->queryAll();
    }
     /**
     * @inheritdoc
     *realiza consulta para saber cual fue el ultimo codigo asignado
     */

    public function codeQr() {
        return $data = Yii::$app->db->createCommand("SELECT register_code_qr FROM register_users WHERE id_register_user= (SELECT MAX(id_register_user) AS id FROM register_users )")->queryOne();
    }
     /**
     * @inheritdoc
     *Borra el registro, recibe un ID del registro a borrar
     */

    public function deleteRegister($id_register) {
        return $data = Yii::$app->db->createCommand("DELETE FROM register_users WHERE id_register_user='" . $id_register . "'")->queryAll();
    }
     /**
     * @inheritdoc
     *muestra todos los registro para captura de fotos, con estatus 1 y 2 del dia actual
     */

    public function queryAllRegisterVeri() {
        return $data = Yii::$app->db->createCommand("SELECT * FROM register_users AS r INNER JOIN status_request AS b ON r.id_status_request=b.id_status_requests WHERE r.date_create='" . date('Y-m-d') . "' AND r.id_status_request in (1,2) ")->queryAll();
    }
     /**
     * @inheritdoc
     *muestra todos los registro para documentos, con estatus 2 y 3 del dia actual
     */

    public function queryAllRegisterDocument() {
        return $data = Yii::$app->db->createCommand("SELECT * FROM register_users AS r INNER JOIN status_request AS b ON r.id_status_request=b.id_status_requests WHERE r.date_create='" . date('Y-m-d') . "' AND r.id_status_request in (2,3) ")->queryAll();
    }

}
