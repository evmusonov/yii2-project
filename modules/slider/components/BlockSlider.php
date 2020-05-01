<?php
namespace app\modules\slider\components;
use app\modules\slider\models\Slider;
use Yii;
use app\modules\service\models\Service;
class BlockSlider
{
	public static function front()
	{
		$slider = Slider::find()->orderBy('weight')->all();
		return Yii::$app->view->renderFile('@app/modules/slider/views/slider-block-front.php', ['slider' => $slider]);
	}
}