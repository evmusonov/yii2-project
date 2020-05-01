<?php

namespace app\modules\article\models;

use Yii;
use app\components\helpers\Text;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;
use app\modules\article\Module;
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
class Article extends \yii\db\ActiveRecord
{
	public $imageFile;
	public $post;
	public $date_from;
	public $date_to;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
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
            ->where(['module' => 'article']);
    }
	
	public function getThumb($type = 1)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'article']);
    }

    public function getNextArticle()
    {
    	return Article::find()->where('created_at < :created_at',[':created_at' => $this->created_at])->one();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
		$this->post = Yii::$app->request->post('Article');
        return [
            [['title', 'status', 'readtime'], 'required'],
            [['title', 'body', 'alias', 'readtime'], 'string'],
            [['weight', 'status','created_at'], 'integer'],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif', 'jpeg'], 'maxSize' => (1024*1024)*2],
            [['title'], 'string', 'max' => 255],
			[['weight'], 'default', 'value' => 0],
            [['alias'], 'unique', 'message' => 'Значение должно быть уникальным! Материал с таким адресом уже существует на сайте.'],
            [['alias'], 'default', 'value' => function ($model, $attribute) {
                $default_alias = Text::transliterate($model->title);
                if(Article::find()->where(['alias' => $default_alias])->one()){
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'date' => Yii::t('app', 'date'),
			'title' => Yii::t('app', 'title'),
			'imageFile' => Yii::t('app', 'imageFile'),
            'body' => Yii::t('app', 'body'),
            'alias' => Yii::t('app', 'alias'),
            'weight' => Yii::t('app', 'weight'),
            'status' => Yii::t('app', 'status'),
            'created_at' => Yii::t('app', 'created_at'),
	        'readtime' => Yii::t('app', 'readtime'),
        ];
    }
}