<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\modules\main\Module;
?>

<div class="setting-form">
    <hr>
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="save-panel">
        <div class="row">
            <div class="col-xs-4">
                <div class="form-group">
					<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => 'btn btn-primary custom-save-panel-button']) ?>
                </div>
            </div>
        </div>
    </div>

	<div class="row">
		<div class="col-xs-12 col-md-4">
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-xs-12 col-md-4">
			<?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-xs-12 col-md-4">
			<?= $form->field($model, 'module')->textInput(['maxlength' => true]) ?>
		</div>
	</div>


    <?php ActiveForm::end(); ?>
</div>