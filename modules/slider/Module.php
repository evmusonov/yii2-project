<?php

namespace app\modules\slider;

use Yii;

/**
 * page module definition class
 */
class Module extends \yii\base\Module
{
    public $imagesDirectory = 'slider';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\slider\controllers';
}
