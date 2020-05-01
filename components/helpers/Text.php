<?php
namespace app\components\helpers;

use Yii;
use yii\helpers\Html;

class Text
{
	public static $transliteration = [
        'а' => 'a',   'б' => 'b',   'в' => 'v',
		'г' => 'g',   'д' => 'd',   'е' => 'e',
		'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
		'и' => 'i',   'й' => 'y',   'к' => 'k',
		'л' => 'l',   'м' => 'm',   'н' => 'n',
		'о' => 'o',   'п' => 'p',   'р' => 'r',
		'с' => 's',   'т' => 't',   'у' => 'u',
		'ф' => 'f',   'х' => 'h',   'ц' => 'c',
		'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
		'ь' => '',    'ы' => 'y',   'ъ' => '',
		'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
		
		'А' => 'a',   'Б' => 'b',   'В' => 'v',
		'Г' => 'g',   'Д' => 'd',   'Е' => 'e',
		'Ё' => 'e',   'Ж' => 'zh',  'З' => 'z',
		'И' => 'i',   'Й' => 'y',   'К' => 'k',
		'Л' => 'l',   'М' => 'm',   'Н' => 'n',
		'О' => 'o',   'П' => 'p',   'Р' => 'r',
		'С' => 's',   'Т' => 't',   'У' => 'u',
		'Ф' => 'f',   'Х' => 'h',   'Ц' => 'c',
		'Ч' => 'ch',  'Ш' => 'sh',  'Щ' => 'sch',
		'Ь' => '',    'Ы' => 'y',   'Ъ' => '',
		'»' => '', '«' => '', '"' => '',
		'(' => '',    ')' => '',    '/' => '-',
		'Э' => 'e',   'Ю' => 'yu',  'Я' => 'ya', 
		' ' => '-', 
    ];
	
	public static $month = [
        1 => 'января',
		2 => 'февраля',
		3 => 'марта',
		4 => 'апреля',
		5 => 'мая',
		6 => 'июня',
		7 => 'июля',
		8 => 'августа',
		9 => 'сентября',
		10=> 'октября',
		11=> 'ноября',
		12=> 'декабря'
    ];
	
	public static function transliterate($value)
	{
		$value = preg_replace('/[^(\w)|(\x7F-\xFF)|(\s)]/', '', $value);
		if(strlen($value) >= 250) $value = substr($value, 0, 250);
		return strtr($value, static::$transliteration);
	}
	
	public static function prettyDate($date, $showYear = true)
	{
		$month = self::$month[date("n", $date)];
		if ($showYear) {
			$date = date("j $month Y", $date);
		} else {
			$date = date("j $month", $date);
		}

		return $date;
	}
	
	public static function _edit($id = 0, $module = 'main')
	{
		$link = '';
		if(!Yii::$app->user->isGuest)
		{
			$link = Html::a(Html::img('/img/edit.png', ['class' => 'edit-link']), '/admin/'.$module.'/update?id='.$id, ['target' => '_blank', 'title' => 'Редактировать']);
		}
		return $link;
	}
}