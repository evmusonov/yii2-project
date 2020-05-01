<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Partners */

$this->title = 'Редактировать (Мини-слайдер): ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Мини-слайдер', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="partners-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
