<?php

use app\modules\file\components\Img;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Collapse;

use app\modules\infoblock\Module;
?>

<div class="partners-form">

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

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
	<?= Img::_galleryView(Module::getInstance()->imagesDirectory, $model, $form, 'thumbgall', 'files', 'imageGallery[]', 'Фотогалерея', 'imageAttr') ?>
    <?= $form->field($model, 'body')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
		'editorOptions' => [
			'preset' => 'full', /* basic, standard, full */
			'inline' => false,
			'filebrowserBrowseUrl' => Url::to(['/backend/browse-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
			'filebrowserUploadUrl' => Url::to(['/backend/upload-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
			'extraPlugins' => 'imageuploader',
		],
	]); ?>

    <?php ActiveForm::end(); ?>
</div>