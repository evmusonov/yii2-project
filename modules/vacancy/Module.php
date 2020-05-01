<?php

namespace app\modules\vacancy;

use Yii;

/**
 * page module definition class
 */
class Module extends \yii\base\Module
{
    public $imagesDirectory = 'vacancy';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\vacancy\controllers';
}
