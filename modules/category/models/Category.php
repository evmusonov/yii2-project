<?php

namespace app\modules\category\models;

use app\modules\product\models\Product;
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
class Category extends \yii\db\ActiveRecord
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
        return '{{%category}}';
    }

    /**
     * THUMBNAIL IMAGE
     */
	public function getThumb($type = 1)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'category']);
    }

	/**
	 * SEO
	 */
	public function getSeo()
	{
		return $this->hasOne(Seo::className(), ['content_id' => 'id'])
			->where(['module' => 'category']);
	}

	public function getProducts()
	{
		return $this->hasMany(Product::className(), ['cat_id' => 'id'])->orderBy('weight');
	}

	public function getNextCategory()
	{
		return Category::find()->where('weight > :weight',[':weight' => $this->weight])->one();
	}

    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['title', 'alias', 'body'], 'string'],
            [['weight', 'status'], 'integer'],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2],
            [['title'], 'string', 'max' => 255],
			[['weight'], 'default', 'value' => 0],
	        [['alias'], 'unique', 'message' => 'Значение должно быть уникальным! Материал с таким адресом уже существует на сайте.'],
	        [['alias'], 'default', 'value' => function ($model, $attribute) {
		        $default_alias = Text::transliterate($model->title);
		        if(Category::find()->where(['alias' => $default_alias])->one()){
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
	        'body' => Yii::t('app', 'body'),
	        'alias' => Yii::t('app', 'alias'),
	        'sub_title' => Yii::t('app', 'subTitle'),
			'imageFile' => Yii::t('app', 'imageFile'),
            'weight' => Yii::t('app', 'weight'),
            'status' => Yii::t('app', 'status'),
        ];
    }
}
