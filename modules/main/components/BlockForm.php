<?php
namespace app\modules\main\components;

use app\modules\main\models\forms\FormVacancy;
use Yii;
use app\modules\main\models\forms\FormContact;

class BlockForm
{
	public static function _contact()
	{
		$form = new FormContact();
		return Yii::$app->view->renderFile('@app/modules/main/views/block-form-contact.php', ['contact_form' => $form]);
	}

	public static function _vacancy()
	{
		$form = new FormVacancy();
		return Yii::$app->view->renderFile('@app/modules/main/views/block-form-vacancy.php', ['vacancy_form' => $form]);
	}
}