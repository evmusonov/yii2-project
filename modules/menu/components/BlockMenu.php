<?php

namespace app\modules\menu\components;

use Yii;
use app\modules\menu\models\Menu;

class BlockMenu
{
	public static function front($menuClass = true, $type = 0)
	{
		$menu = Menu::find()
				->where(['status' => 1, 'parent_id' => 0, 'type_id' => $type])
				->orderBy('weight')
				->all();
				
		return Yii::$app->view->renderFile('@app/modules/menu/views/menu-block-front.php', ['menu' => $menu, 'menuClass' => $menuClass]);
	}

	public static function footer($type = 0)
	{
		$menu = Menu::find()
			->where(['status' => 1, 'parent_id' => 0, 'type_id' => $type])
			->orderBy('weight')
			->all();

		return Yii::$app->view->renderFile('@app/modules/menu/views/menu-block-footer.php', ['menu' => $menu]);
	}
}