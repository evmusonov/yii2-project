<?php
namespace app\modules\client\models;

use Yii;
use app\components\helpers\Text;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;
use yii\behaviors\TimestampBehavior;

class Client extends \yii\db\ActiveRecord
{
	public $imageFile;
	public $post;    

	public static function tableName()    
	{        
		return '{{%client}}';    
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
            ->where(['module' => 'client']);
    }

	public function getThumb($type = 1)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'client']);
    }
	
	/**     
	* @inheritdoc 
	*/    
	
	public function rules()
    {
		$this->post = Yii::$app->request->post('Client');
        return [
            [['title', 'status'], 'required'],
            [['alias'], 'string'],
            [['weight', 'status', 'created_at'], 'integer'],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2],
            [['title'], 'string', 'max' => 255],
			[['weight'], 'default', 'value' => 0],
            [['alias'], 'unique', 'message' => 'Значение должно быть уникальным! Материал с таким адресом уже существует на сайте.'],
            [['alias'], 'default', 'value' => function ($model, $attribute) {
                $default_alias = Text::transliterate($model->title);
                if(Client::find()->where(['alias' => $default_alias])->one()){
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
			'title' => Yii::t('app', 'title'),
			'imageFile' => Yii::t('app', 'imageFile'),
            'alias' => Yii::t('app', 'alias'),
            'weight' => Yii::t('app', 'weight'),
            'status' => Yii::t('app', 'status'),
            'created_at'=>Yii::t('app', 'created_at'),
        ];    
	}
}