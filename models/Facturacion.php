<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facturacion".
 *
 * @property string $id_facturacion
 * @property integer $id_register_user
 * @property string $concepto
 * @property string $monto_iva
 * @property string $total_iva
 * @property string $total
 */
class Facturacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'facturacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_register_user', 'concepto', 'monto_iva', 'total_iva', 'total'], 'required'],
            [['id_register_user'], 'integer'],
            [['concepto'], 'string', 'max' => 255],
            [['monto_iva', 'total_iva', 'total'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_facturacion' => 'Id Facturacion',
            'id_register_user' => 'Id Register User',
            'concepto' => 'Concepto',
            'monto_iva' => 'Monto Iva',
            'total_iva' => 'Total Iva',
            'total' => 'Total',
        ];
    }

     /**
     * @inheritdoc
     *muestra la informacion del registro relacionada con la factura generada 
     */
    public function queryAllFactura($id_register_user){
        return $data = Yii::$app->db->createCommand("SELECT * FROM facturacion AS f WHERE f.id_register_user='".$id_register_user."'")->queryOne();
    }
    public function queryFacturacion(){
        return $data = Yii::$app->db->createCommand("SELECT * FROM facturacion AS fa INNER JOIN register_users AS re ON fa.id_register_user=re.id_register_user")->queryAll();
    }
}
