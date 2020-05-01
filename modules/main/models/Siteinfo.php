<?php

namespace app\modules\main\models;
use app\modules\main\models\Setting;
use Yii;
use app\modules\seo\models\Seo;


/**
 * This is the model class for table "{{%siteinfo}}".
 *
 * @property string $id
 * @property string $title
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $slogan
 * @property string $body
 * @property string $map
 * @property string $counter
 * @property string $copyright
 */
class Siteinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%siteinfo}}';
    }


    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['content_id' => 'id'])
            ->where(['module' => 'main']);
    }
	/**
     * SETTING
     */
    public function getSetting()
    {
        return Setting::find()
			->where(['module' => 'setting'])
			->all();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'email'], 'required'],
            [['address', 'body', 'map', 'counter', 'slogan', 'head'], 'string', 'max' => 100000],
            [['title', 'email', 'phone', 'copyright', 'phone_sell', 'phone_nsk'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'SI_BACK_FORM_ID'),
            'title' => Yii::t('app', 'SI_BACK_FORM_TITLE'),
            'email' => Yii::t('app', 'SI_BACK_FORM_EMAIL'),
            'phone' => Yii::t('app', 'SI_BACK_FORM_PHONE'),
	        'phone_sell' => Yii::t('app', 'phone_sell'),
	        'phone_nsk' => Yii::t('app', 'phone_nsk'),
            'address' => Yii::t('app', 'SI_BACK_FORM_ADDRESS'),
            'slogan' => Yii::t('app', 'SI_BACK_FORM_SLOGAN'),
            'body' => Yii::t('app', 'SI_BACK_FORM_BODY'),
            'map' => Yii::t('app', 'SI_BACK_FORM_MAP'),
            'counter' => Yii::t('app', 'SI_BACK_FORM_COUNTER'),
            'copyright' => Yii::t('app', 'SI_BACK_FORM_COPYRIGHT'),
	        'head' => 'Код для вставки в <head>'
        ];
    }
}
