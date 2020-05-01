<?php

namespace app\modules\category;

use Yii;

/**
 * page module definition class
 */
class Module extends \yii\base\Module
{
    public $imagesDirectory = 'category';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\category\controllers';
}
