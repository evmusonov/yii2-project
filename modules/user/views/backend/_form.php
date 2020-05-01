<?php

use app\modules\user\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="save-panel">
        <div class="row">
            <div class="col-xs-4">
                <div class="form-group">
					<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => 'btn btn-primary custom-save-panel-button']) ?>
					<?= Html::a('Изменить пароль', ['password-change', 'id' => $model->id], ['class' => 'btn btn-warning btn-xs custom-grey-button ml-10']) ?>
                </div>
            </div>
        </div>
    </div>
	
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>

</div>
