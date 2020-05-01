<?php
namespace app\modules\product;

use Yii;
/**
 * article module definition class
 */
class Module extends \yii\base\Module
{
	/**
     * Директория картинок модуля (по умолчанию название модуля)
     */
	public $imagesDirectory = 'product';
	
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\product\controllers';
}