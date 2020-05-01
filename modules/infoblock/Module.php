<?php

namespace app\modules\infoblock;

/**
 * infoblock module definition class
 */
class Module extends \yii\base\Module
{
	/**
     * Директория картинок модуля (по умолчанию название модуля)
     */
    public $imagesDirectory = 'infoblock';
	
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\infoblock\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
