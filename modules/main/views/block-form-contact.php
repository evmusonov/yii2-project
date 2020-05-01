<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$successText = 'Форма отправлена. В ближайшее время с Вами свяжутся';
$script = <<< JS
$('#contact_form').on('beforeSubmit', function () {
	var form = $(this);
	$.post(
		'/main/default/send-contact-form',
		form.serialize()
	)
	.done(function(data) {
	    console.log(data);
		if(data == 'success'){
			$(form).trigger('reset');
			$('.link-tab').css('display', 'none');
			$('.form_success').css('display', 'block');
			$('.form_success').html('$successText');
		}
	});
	return false;
});
JS;
Yii::$app->view->registerJs($script, yii\web\View::POS_READY);
?>
<div class="aside__close js-aside-close"></div>

<div class="contacts-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
	            <?php $form = ActiveForm::begin([
		            'id' => 'contact_form',
		            'method' => 'post',
		            'options' => ['class' => 'form'],
		            'fieldConfig' => [
			            'errorOptions' => ['class' => 'error'],
		            ],
		            'errorCssClass' => 'error',
	            ]); ?>
                    <div class="container-form">
                        <?= $form->field($contact_form, 'name')
		                    ->textInput()->error(['tag' => 'label'])
		                    ->label('Имя') ?>
	                    <?= $form->field($contact_form, 'contact')
		                    ->textInput(['id' => 'phone'])
		                    ->label('Телефон')->error(['tag' => 'label']) ?>
	                    <?= $form->field($contact_form, 'text')
		                    ->textarea()
		                    ->label('Сообщение')->error(['tag' => 'label']) ?>

	                    <?= $form->field($contact_form, 'agree')
		                    ->checkbox(['class' => 'custom-checkbox', 'checked' => ' checked'])
		                    ->label('Согласен с <a href="/page/polzovatelskoe-soglashenie">политикой конфеденциальности</a>')
		                    ->error(['tag' => 'label']) ?>

                    </div>
                    <div class="form_success" style="display:none;"></div>
                    <button type="button" onclick="$('#contact_form').submit()" class="link-tab">Отправить</button>
	            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

