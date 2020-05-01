<?php
namespace app\components;

use yii\helpers\Url;

class redactorSetting
{
	public static function _($Id, $module)
	{
		return [
			'lang' => 'ru',
			'minHeight' => 200,
			'replaceDivs' => false,
			'cleanSpaces' => false,
			'paragraphize' => false,
			'toolbarFixed' => true,
			'toolbarFixedTopOffset' => 50,
			/* 'formattingAdd' => [
				0 => [
					'title' => 'Темный блок',
					'type' => 'block',
					'tag' => 'p',
					'class' => 'text-mark1',
					'clear' => 'remove',
				],
				1 => [
					'title' => 'Серый блок',
					'type' => 'block',
					'tag' => 'p',
					'class' => 'text-mark2',
					'clear' => 'remove',
				],
				
				2 => [
					'title' => 'Зеленая полоса слева',
					'type' => 'block',
					'tag' => 'p',
					'class' => 'text-mark3',
					'clear' => 'remove',
				],
				3 => [
					'title' => 'Волнистая линия',
					'type' => 'block',
					'tag' => 'p',
					'class' => 'text-mark4',
					'clear' => 'remove',
				],
				
				4 => [
					'title' => 'Правый текстовый блок',
					'type' => 'block',
					'tag' => 'p',
					'class' => 'text-right',
					'clear' => 'remove',
				],
				5 => [
					'title' => 'Левый текстовый блок',
					'type' => 'block',
					'tag' => 'p',
					'class' => 'text-left',
					'clear' => 'remove',
				],
				
				6 => [
					'title' => 'Ненумерованный список 2',
					'type' => 'block',
					'tag' => 'ul',
					'class' => 'list-1',
					'clear' => 'remove',
				],
				7 => [
					'title' => 'Нумерованный список 2',
					'type' => 'block',
					'tag' => 'ol',
					'class' => 'list-2',
					'clear' => 'remove',
				],
				
				8 => [
					'title' => 'Круглая картинка',
					'type' => 'inline',
					'tag' => 'img',
					'class' => 'img-round',
					'clear' => 'remove',
				],
				9 => [
					'title' => 'Число в круге',
					'type' => 'inline',
					'tag' => 'span',
					'class' => 'num-round',
					'clear' => 'remove',
				],
			], */
			'imageManagerJson' => Url::to(['/backend/images-get', 'id' => $Id, 'module' => $module]),
			'imageUpload' => Url::to(['/backend/image-upload', 'id' => $Id, 'module' => $module]),
			'plugins' => [
				'imagemanager',
				'table',
				'definedlinks',
				'typograff',
				'fullscreen'
			]
		];
	}
}