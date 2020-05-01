<?php
namespace app\modules\shoplist;

use Yii;
/**
 * article module definition class
 */
class Module extends \yii\base\Module
{
	/**
     * Директория картинок модуля (по умолчанию название модуля)
     */
	public $imagesDirectory = 'shoplist';
	
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\shoplist\controllers';
}