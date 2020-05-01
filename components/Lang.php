<?php

namespace app\components;

use yii\base\Component;
use app\modules\language\models\Language;

class Lang extends Component
{
    public $info = [];

    public function __construct()
    {
        $this->info = Language::find()->where(['status' => 1])->indexBy('id')->all();
		//parent::__construct($config);
    }
}