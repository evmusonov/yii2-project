<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Collapse;
use app\modules\main\Module;
use app\modules\seo\components\Seo;

?>

<div class="siteinfo-form">
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
        </div>
    </div>

    <div class="row">
		<div class="col-md-12">
			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'slogan')->textarea(['rows' => 6]) ?>
            <div class="alert alert-info" role="alert">
                <div>Вставка ссылок и текста для слогана:</div>
                <div>[ссылка] - квадратные скобки для обозначения ссылки</div>
                <div>{текст} - скрытый текст, появляющийся при нажатии на слева стоящую ссылку</div>
            </div>
			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'phone')->textInput(['rows' => 6]); ?>
			<?= $form->field($model, 'phone_sell')->textInput(['rows' => 6]); ?>
			<?= $form->field($model, 'phone_nsk')->textInput(['rows' => 6]); ?>
			<?= $form->field($model, 'address')->textarea(['rows' => 6]); ?>
			<?= $form->field($model, 'copyright')->textInput(['maxlength' => true]) ?>
		</div>
    </div>
	
    <div class="row">
		<div class="col-md-12">
			<?= $form->field($model, 'body')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
				'editorOptions' => [
					'preset' => 'full', /* basic, standard, full */
					'inline' => false,
					'filebrowserBrowseUrl' => Url::to(['/backend/browse-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'filebrowserUploadUrl' => Url::to(['/backend/upload-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'extraPlugins' => 'imageuploader',
				],
			]); ?>
		</div>
	</div>

    <hr>
    <div class="paragraph">Коды для вставки</div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
			<?= $form->field($model, 'map')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'counter')->textarea(['rows' => 6]) ?>
		</div>
    </div>
    <hr>
    <div class="paragraph">SEO</div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
			<?= Seo::_fieldsView($model) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>