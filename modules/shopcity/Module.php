<?php
namespace app\modules\shopcity;

use Yii;
/**
 * article module definition class
 */
class Module extends \yii\base\Module
{
	/**
     * Директория картинок модуля (по умолчанию название модуля)
     */
	public $imagesDirectory = 'shopcity';
	
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\shopcity\controllers';
}