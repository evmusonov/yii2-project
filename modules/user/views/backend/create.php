<?php

use app\modules\user\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Новая запись';
$this->params['breadcrumbs'][] = ['label' => 'Аккаунт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <hr>

    <?php $form = ActiveForm::begin(); ?>

    <div class="save-panel">
        <div class="row">
            <div class="col-xs-2">
                <div class="form-group">
					<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => 'btn btn-primary custom-save-panel-button']) ?>
                </div>
            </div>
        </div>
    </div>

	<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'status')->dropDownList(User::getStatusesArray()) ?>

	<?php ActiveForm::end(); ?>

</div>
