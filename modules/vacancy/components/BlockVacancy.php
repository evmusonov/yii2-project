<?php
namespace app\modules\vacancy\components;

use app\modules\vacancy\models\Vacancy;
use Yii;

class BlockVacancy
{
	public static function front()
	{
		$vacancy = Vacancy::find()->orderBy('weight')->limit(3)->all();
		return Yii::$app->view->renderFile('@app/modules/vacancy/views/vacancy-block-front.php', ['vacancy' => $vacancy]);
	}
}