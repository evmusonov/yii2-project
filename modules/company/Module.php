<?php

namespace app\modules\company;

use Yii;

/**
 * page module definition class
 */
class Module extends \yii\base\Module
{
    public $imagesDirectory = 'company';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\company\controllers';
}
