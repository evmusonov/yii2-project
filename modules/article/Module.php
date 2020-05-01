<?php
namespace app\modules\article;

/**
 * article module definition class
 */
class Module extends \yii\base\Module
{
	/**
     * Директория картинок модуля (по умолчанию название модуля)
     */
	public $imagesDirectory = 'article';
	
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\article\controllers';
}