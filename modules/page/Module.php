<?php

namespace app\modules\page;

use Yii;

/**
 * page module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * ���������� �������� ������ (�� ��������� �������� ������)
     */
    public $imagesDirectory = 'page';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\page\controllers';
}
