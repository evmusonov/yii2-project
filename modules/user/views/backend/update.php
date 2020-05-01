<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Редактирование (Аккаунт): ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Аккаунт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->username;
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="user-update">

    <h3><?= Html::encode($this->title) ?></h3>
	<hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
