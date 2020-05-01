<?php

namespace app\modules\product\models;

use Yii;
use app\components\helpers\Text;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;

use app\modules\product\Module;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%article}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_title
 * @property string $date
 * @property string $teaser
 * @property string $body
 * @property string $alias
 * @property string $weight
 * @property integer $status
 */
class Product extends \yii\db\ActiveRecord
{
	public $imageFile;
	public $imageGallery;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
	
	/**
     * SEO
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['content_id' => 'id'])
            ->where(['module' => 'product']);
    }
	
	public function getFiles($type = 2)
    {
        return $this->hasMany(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'product'])
            ->orderBy('delta');
    }
	
	public function getThumb($type = 1)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'product']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['body'], 'string'],
            [['weight', 'status', 'created_at', 'cat_id'], 'integer'],
	        ['cat_id', 'default', 'value' => 0],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2],
            [['title'], 'string', 'max' => 255],
			[['weight'], 'default', 'value' => 0],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
			'title' => Yii::t('app', 'title'),
			'imageFile' => Yii::t('app', 'imageFile'),
            'body' => Yii::t('app', 'body'),
            'weight' => Yii::t('app', 'weight'),
            'status' => Yii::t('app', 'status'),
            'created_at' => Yii::t('app', 'created_at'),
	        'cat_id' => Yii::t('app', 'cat_id'),
        ];
    }
}