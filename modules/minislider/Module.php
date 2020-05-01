<?php

namespace app\modules\minislider;

use Yii;

/**
 * page module definition class
 */
class Module extends \yii\base\Module
{
    public $imagesDirectory = 'minislider';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\minislider\controllers';
}
