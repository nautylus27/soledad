<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_request".
 *
 * @property integer $id_status_requests
 * @property string $name_status
 * @property string $description_status
 */
class StatusRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_status', 'description_status'], 'required'],
            [['name_status', 'description_status'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_status_requests' => 'Id Status Requests',
            'name_status' => 'Name Status',
            'description_status' => 'Description Status',
        ];
    }
}
