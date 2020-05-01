<?php

namespace app\modules\vacancy\models;

use Yii;
use app\components\helpers\Text;
use app\modules\seo\models\Seo;
use app\modules\file\models\File;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property string $id
 * @property string $title
 * @property string $teaser
 * @property string $body
 * @property string $alias
 * @property string $weight
 * @property integer $status
 */
class Vacancy extends \yii\db\ActiveRecord
{
	public $imageFile;
	
	public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%vacancy}}';
    }

    /**
     * THUMBNAIL IMAGE
     */
	public function getThumb($type = 1)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'vacancy']);
    }

	/**
	 * SEO
	 */
	public function getSeo()
	{
		return $this->hasOne(Seo::className(), ['content_id' => 'id'])
			->where(['module' => 'vacancy']);
	}

    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['title', 'alias', 'education', 'experience', 'duties', 'cond', 'contact'], 'string'],
            [['weight', 'status'], 'integer'],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2],
            [['title'], 'string', 'max' => 255],
			[['weight'], 'default', 'value' => 0],
	        [['alias'], 'unique', 'message' => 'Значение должно быть уникальным! Материал с таким адресом уже существует на сайте.'],
	        [['alias'], 'default', 'value' => function ($model, $attribute) {
		        $default_alias = Text::transliterate($model->title);
		        if(Vacancy::find()->where(['alias' => $default_alias])->one()){
			        return $default_alias.'-'.time();
		        }
		        else
		        {
			        return $default_alias;
		        }
	        }],
        ];
    }

    /**
     * LABELS
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'title' => Yii::t('app', 'title'),
	        'education' => Yii::t('app', 'education'),
	        'experience' => Yii::t('app', 'experience'),
	        'duties' => Yii::t('app', 'duties'),
	        'cond' => Yii::t('app', 'cond'),
	        'contact' => Yii::t('app', 'contact'),
	        'alias' => Yii::t('app', 'alias'),
	        'sub_title' => Yii::t('app', 'subTitle'),
			'imageFile' => Yii::t('app', 'imageFile'),
            'weight' => Yii::t('app', 'weight'),
            'status' => Yii::t('app', 'status'),
        ];
    }
}
