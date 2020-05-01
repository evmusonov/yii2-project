<?php

use app\modules\shopcity\models\ShopCity;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\shopcity\Module;
?>
<div class="<?= Module::getInstance()->id ?>-form">
    <hr>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="save-panel">
        <div class="row">
            <div class="col-xs-5">
                <div class="form-group">
					<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE_AND_CONT'), ['class' => 'btn btn-primary custom-save-panel-button', 'name' => 'continue']) ?>
					<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => 'btn btn-primary custom-save-panel-button']) ?>
                </div>
            </div>
            <div class="save-panel-checkboxes">
                <div class="col-xs-2">
					<?= $form->field($model, 'status', [
						'options' => ['class' => 'status-field checkbox-div'],
						'labelOptions' => ['class' => 'mt-0'],
					])->checkbox(['class' => 'new-checkbox']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="paragraph">Настройки страницы</div>
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(ShopCity::find()->all(), 'id', 'title'), ['size' => 10]) ?>
			<?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>
</div>