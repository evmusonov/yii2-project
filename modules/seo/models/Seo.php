<?php

namespace app\modules\seo\models;

use Yii;

/**
 * This is the model class for table "{{%seo}}".
 *
 * @property string $id
 * @property integer $content_id
 * @property string $meta_title
 * @property string $meta_key
 * @property string $meta_desc
 * @property string $module
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%seo}}';
    }

    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['content_id', 'module'], 'required'],
            [['content_id'], 'integer'],
            [['meta_key', 'meta_desc',], 'string'],
            [['meta_title',  'module'], 'string', 'max' => 255],
        ];
    }

    /**
     * LABELS
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_id' => '',
            'meta_title' => Module::t('module', 'SEO_BACK_FORM_META_TITLE'),
            'meta_key' => Module::t('module', 'SEO_BACK_FORM_META_KEY'),
            'meta_desc' => Module::t('module', 'SEO_BACK_FORM_META_DESC'),
            'module' => '',
        ];
    }

    /*** Редактирование (добавление) записей для связанных таблиц БД ***/
    public function updateSeo($post, $id = 0, $module = '')
    {
        if(!$seoModel = Seo::findOne(['content_id' => $id, 'module' => $module]))
        {
            $seoModel = new Seo();
        }

        $seoModel->content_id = $id;
        $seoModel->meta_title = $post['Seo']['meta_title'];
        $seoModel->meta_key = $post['Seo']['meta_key'];
        $seoModel->meta_desc = $post['Seo']['meta_desc'];
		
        $seoModel->module = $module;

        $seoModel->save();
    }
	
	/****** Удаление записей из связанных таблиц БД ********/
	public function deleteSeo($id = 0, $module = '')
	{
		Seo::deleteAll(['module' => $module, 'content_id' => $id]);
	}
}