<?php

namespace app\modules\main\models;

use Yii;
use app\modules\main\Module;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property string $id
 * @property string $name
 * @property string $value
 * @property string $module
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'value', 'module'], 'string', 'max' => 255],
            [['module'], 'default', 'value' => 'main'],
        ];
    }

    /**
     * LABELS
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'name'),
            'value' => Yii::t('app', 'value'),
            'module' => Yii::t('app', 'module'),
        ];
    }
}
