<?php

namespace app\modules\page\models;

use Yii;
use app\components\helpers\Text;

/********** USE MODELS *********/
use app\modules\seo\models\Seo;
use app\modules\file\models\File;
use app\modules\subcontent\models\Subcontent;

use app\modules\page\Module;
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
class Page extends \yii\db\ActiveRecord
{
	public $imageFile;
	public $imageGallery;
	public $imageGallery2;
	
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
        return '{{%page}}';
    }
	
	/**
     * SUBCONTENT
     */
	public function getSubcontent()
    {
        return $this->hasMany(Subcontent::className(), ['content_id' => 'id'])
			->where(['module' => 'page'])
			->orderBy('weight');
    }

    /**
     * SEO
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['content_id' => 'id'])
            ->where(['module' => 'page']);
    }

    /**
     * THUMBNAIL IMAGE
     */
	public function getThumb($type = 1)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'page']);
    }
	
	/**
     * SLIDESHOW
     */
	public function getSlides($type = 5)
    {
        return $this->hasMany(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'page'])
            ->orderBy('delta');
    }
	
	/**
     * PHOTO GALLERY
     */
	public function getFiles($type = 2)
    {
        return $this->hasMany(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'page'])
            ->orderBy('delta');
    }

    public static function getContent()
    {
	    $url = $_SERVER['REQUEST_URI'];
	    $getUrl = explode("/", $url); //divide pages
	    $withoutGetUrl = explode("?", $getUrl[1]); //divide get params

	    return Page::find()->where(['alias' => $withoutGetUrl[0]])->one();
    }

    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['teaser', 'body', 'alias', 'page_color', 'spot_color'], 'string'],
            [['weight', 'status', 'show_spot'], 'integer'],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2],
			[['imageGallery'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2, 'maxFiles' => 100],
			[['imageGallery2'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2, 'maxFiles' => 100],
            [['title'], 'string', 'max' => 255],
			[['weight'], 'default', 'value' => 0],
	        [['body'], 'default', 'value' => ''],
			[['alias'], 'unique', 'message' => 'Значение должно быть уникальным! Материал с таким адресом уже существует на сайте.'],
			[['alias'], 'default', 'value' => function ($model, $attribute) {
				$default_alias = Text::transliterate($model->title);
				if(Page::find()->where(['alias' => $default_alias])->one()){
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
            'teaser' => Yii::t('app', 'teaser'),
            'body' => Yii::t('app', 'body'),
            'alias' => Yii::t('app', 'alias'),
            'weight' => Yii::t('app', 'weight'),
            'status' => Yii::t('app', 'status'),
			'show_spot' => Yii::t('app', 'show_spot'),
	        'spot_color' => Yii::t('app', 'spot_color'),
	        'page_color' => Yii::t('app', 'page_color'),
        ];
    }
}
