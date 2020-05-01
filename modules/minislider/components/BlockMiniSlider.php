<?php
namespace app\modules\minislider\components;

use app\modules\minislider\models\MiniSlider;
use Yii;

class BlockMiniSlider
{
	public static function front()
	{
		$minislider = MiniSlider::find()->orderBy('weight')->all();
		return Yii::$app->view->renderFile('@app/modules/minislider/views/minislider-block-front.php', ['minislider' => $minislider]);
	}
}