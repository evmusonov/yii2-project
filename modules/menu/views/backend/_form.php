<?php
use app\modules\menu\models\Menu;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
?>
<hr>
<div class="menu-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="save-panel">
        <div class="row">
            <div class="col-xs-2">
                <div class="form-group">
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
    <div class="row">
        <div class="col-xs-12">
		    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12">
		    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>
		<div class="col-xs-12">
            <?= $form->field($model, 'type_id')->dropDownList(Menu::getTypeMenuArray()) ?>
        </div>
        <div class="col-xs-12">
            <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map($parentItems, 'id', 'title'), ['prompt' => '.. нет ..', 'options' => [$model->parent_id => ['class' => 'selected']]]) ?>
        </div>
        <div class="col-xs-12">
		    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>