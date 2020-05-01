<?php
namespace app\modules\infoblock\models;

use app\modules\file\models\File;
use Yii;

/**
 * This is the model class for table "{{%infoblock}}".
 *
 * @property string $id
 * @property string $title
 * @property string $body
 * @property string $alias
 * @property string $weight
 * @property integer $status
 */
class Infoblock extends \yii\db\ActiveRecord
{
	public $imageGallery;

    public static function tableName()
    {
        return '{{%infoblock}}';
    }

	/**
	 * PHOTO GALLERY
	 */
	public function getFiles($type = 2)
	{
		return $this->hasMany(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'infoblock'])
			->orderBy('delta');
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body', 'alias'], 'required'],
            [['body'], 'string'],
            [['weight', 'status'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 255],
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
            'body' => Yii::t('app', 'body'),
            'alias' => Yii::t('app', 'alias'),
            'weight' => Yii::t('app', 'weight'),
            'status' => Yii::t('app', 'status'),
        ];
    }
}
