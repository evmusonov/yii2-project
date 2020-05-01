<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\modules\file\components\Img;
use app\modules\seo\components\Seo;
use app\modules\vacancy\Module;

?>
<div class="<?= Module::getInstance()->id ?>-form">

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
		<div class="col-xs-12 col-md-12">
			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'education')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'experience')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'alias')->textInput(['maxlength' => true])->label('Алиас (!если поле не заполнено, генерируется автоматически из наименования методом транслитерации)') ?>
			<?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
    <div class="row">
        <div class="col-md-12">
			<?= $form->field($model, 'duties')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
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
    <div class="row">
        <div class="col-md-12">
			<?= $form->field($model, 'cond')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
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
    <div class="row">
        <div class="col-md-12">
			<?= $form->field($model, 'contact')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
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
    <div class="paragraph">SEO</div>
    <div class="row">
        <div class="col-xs-12">
			<?= Seo::_fieldsView($model) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>