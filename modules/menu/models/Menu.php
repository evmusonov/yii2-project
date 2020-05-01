<?php

namespace app\modules\menu\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\menu\models\Menu;
use app\modules\menu\Module;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property string $id
 * @property integer $parent_id
 * @property integer $type_id
 * @property string $title
 * @property string $url
 * @property string $icon
 * @property string $weight
 * @property integer $status
 */
class Menu extends \yii\db\ActiveRecord
{
	public $level = 0; // Коэфицент вложенности
	
    /**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }
	
	public function getTypeMenuName($type_id = false)
    {
		if($type_id === false)
		{
			return ArrayHelper::getValue(self::getTypeMenuArray(), $this->type_id);
		}
		else
		{
			return ArrayHelper::getValue(self::getTypeMenuArray(), $type_id);
		}
    }
 
    public static function getTypeMenuArray()
    {
        return [
            0 => 'Главное меню',
            //1 => 'Соц. сети',
			//2 => 'Меню в нижней части',			
        ];
    }
	
	public static function getSocialIconArray()
    {
        return [
            'facebook' => 'Facebook',
            'vk' => 'Вконтакте',
			'instagram' => 'Инстаграм',
        ];
    }
	
	/**
     * PARENT
     */
    public function getParent()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent_id']);
    }

    /**
     * CHILDREN
     */
    public function getChildren()
    {
        return $this->hasMany(Menu::className(), ['parent_id' => 'id']);
    }

    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['title', 'url', 'status'], 'required'],
            [['weight', 'status', 'parent_id', 'type_id'], 'integer'],
			[['weight', 'parent_id'], 'default', 'value' => 0],
            [['title', 'url', 'icon'], 'string', 'max' => 255]
        ];
    }

    /**
     * LABELS
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'parent_id' => Yii::t('app', 'parent'),
			'type_id' => Yii::t('app', 'type'),
            'title' => Yii::t('app', 'title'),
            'url' => Yii::t('app', 'url'),
            'weight' => Yii::t('app', 'weight'),
            'status' => Yii::t('app', 'status'),
        ];
    }
}