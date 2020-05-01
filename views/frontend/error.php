<?php

use yii\helpers\Html;
use app\modules\infoblock\components\BlockText;
$this->context->layout = 'error';
$this->title = $message;
$this->params['page_class'] = '404';
?>