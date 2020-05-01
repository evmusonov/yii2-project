<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product */

$this->title = 'Создание нового магазина';
$this->params['breadcrumbs'][] = ['label' => 'Розничные магазины', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
