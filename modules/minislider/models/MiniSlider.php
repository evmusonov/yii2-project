<?php

namespace app\modules\minislider\models;

use Yii;
use app\modules\file\models\File;
use app\modules\minislider\Module;
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
class MiniSlider extends \yii\db\ActiveRecord
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
        return '{{%mini_slider}}';
    }

    /**
     * THUMBNAIL IMAGE
     */
	public function getThumb($type = 1)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'minislider']);
    }

    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['title', 'sub_title'], 'string'],
            [['weight', 'status'], 'integer'],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2],
            [['title'], 'string', 'max' => 255],
			[['weight'], 'default', 'value' => 0],
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
	        'sub_title' => Yii::t('app', 'subTitle'),
			'imageFile' => Yii::t('app', 'imageFile'),
            'weight' => Yii::t('app', 'weight'),
            'status' => Yii::t('app', 'status'),
        ];
    }
}
