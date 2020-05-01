<?php

use yii\helpers\Html;

$this->title = 'Редактировать (Партнеры): ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Партнеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="client-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
