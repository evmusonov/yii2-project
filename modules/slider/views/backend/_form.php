<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Collapse;

use app\modules\file\components\Img;
use app\modules\seo\components\Seo;
use app\modules\slider\Module;

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
		<div class="col-xs-12 col-md-8">
			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'sub_title')->textInput() ?>
			<?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-xs-12 col-md-4">
			<label>Главная картинка(иконка)</label>
			<?php if($model->thumb): ?>
				<div class="row">
					<div class="col-xs-12 col-md-12" id="<?= Module::getInstance()->imagesDirectory ?>_<?= $model->id ?>_<?= $model->thumb->id ?>_imageblock">
						<a onclick="deleteImage('<?= Module::getInstance()->imagesDirectory ?>', '<?= $model->id ?>', '<?= $model->thumb->filename ?>', '<?= $model->thumb->id ?>');" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Удалить это изображение">
                            <span class="close-img-button"><img src="/img/close.png"></span>
							<img src="<?= Img::_(Module::getInstance()->imagesDirectory, $model->id, 'thumbnail', $model->thumb->filename) ?>">
						</a>
					</div>
				</div>
			<?php endif; ?>
			<?= $form->field($model, 'imageFile', ['options' => ['class' => 'input-file-block']])->fileInput(['accept' => 'image/*', 'class' => 'input-file']) ?>
            <div class="input-file-search">Выберите файл</div>
            <input class="input-file-fake" type="text" value="" disabled />
		</div>
	</div>
    <?php ActiveForm::end(); ?>
</div>