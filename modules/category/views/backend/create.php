<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Partners */

$this->title = 'Создание новой категории';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partners-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
