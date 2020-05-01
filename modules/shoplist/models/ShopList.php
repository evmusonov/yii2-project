<?php

namespace app\modules\shoplist\models;

use app\modules\shopcity\models\ShopCity;
use Yii;

class ShopList extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%shop_list}}';
    }

    public function getCity()
    {
	    return $this->hasOne(ShopCity::className(), ['id' => 'city_id']);
    }

    public function rules()
    {
        return [
            [['title', 'city_id'], 'required'],
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
	        'city_id' => Yii::t('app', 'city_id'),
            'weight' => Yii::t('app', 'weight'),
            'status' => Yii::t('app', 'status'),
        ];
    }
}