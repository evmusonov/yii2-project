<?php
namespace app\modules\category\components;

use app\modules\category\models\Category;
use Yii;

class BlockCategory
{
	public static function front()
	{
		$category = Category::find()->orderBy('weight')->all();
		return Yii::$app->view->renderFile('@app/modules/category/views/category-block-front.php', ['category' => $category]);
	}
}