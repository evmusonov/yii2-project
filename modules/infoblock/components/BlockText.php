<?php
namespace app\modules\infoblock\components;

use app\modules\infoblock\models\Infoblock;

class BlockText
{
	public static function _($show, $blockId = '')
	{
		if($infoblock = Infoblock::find()->where(['status' => 1, 'alias' => $blockId])->orderBy('weight')->one()) {
			if ($show == 'text') {
				return $infoblock->body;
			} elseif ($show == 'img') {
				return $infoblock->files;
			}
		}
	}

	public static function _getId($blockId)
	{
		if($infoblock = Infoblock::find()->where(['status' => 1, 'alias' => $blockId])->orderBy('weight')->one()) {
			return $infoblock->id;
		}
	}
}