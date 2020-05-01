<?php

namespace app\modules\shopcity\models;

use app\modules\shoplist\models\ShopList;
use Yii;

class ShopCity extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%shop_city}}';
    }

	public function getShops()
	{
		return $this->hasMany(ShopList::className(), ['city_id' => 'id']);
	}

    public function rules()
    {
        return [
            [['title', 'coords'], 'required'],
            [['weight', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
			[['weight'], 'default', 'value' => 0],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
			'title' => Yii::t('app', 'title'),
            'weight' => Yii::t('app', 'weight'),
            'status' => Yii::t('app', 'status'),
	        'coords' => Yii::t('app', 'coords'),
        ];
    }
}