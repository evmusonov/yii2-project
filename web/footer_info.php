<?php

/******************************* Список доменов и относящихся к ним ссылок *****************************************************************/
$hosts = array(
	'bagwill.ru' => '<a href="http://vadimdesign.ru" target="_blank">Разработка сайтов в Новосибирске</a>: студия дизайна Вадима Гончарова',
	'dev.bagwill.ru' => '<a href="http://vadimdesign.ru" target="_blank">Создание сайтов в Новосибирске</a>: студия дизайна Вадима Гончарова',
	'sacksi.ru' => '<a href="http://sacksi.ru/sozdanie-sajtov-v-novosibirske">Создание сайтов в Новосибирске</a>: студия дизайна Вадима Гончарова',
	'goti.ru' => '<a href="http://vadimdesign.ru" target="_blank">Создание сайтов в Новосибирске</a>: студия дизайна Вадима Гончарова',
	'elixepil.ru' => '<a href="http://vadimdesign.ru" target="_blank">Создание сайтов в Новосибирске</a>: студия дизайна Вадима Гончарова',
	'maxle.ru' => '<a href="http://vadimdesign.ru" target="_blank">Создание сайтов в Новосибирске</a>: студия дизайна Вадима Гончарова',
	'eat-box.ru' => '<a href="http://vadimdesign.ru" target="_blank">Создание сайтов</a>: студия дизайна Вадима Гончарова',
	'koloritlkz.ru' => '<a href="http://vadimdesign.ru" target="_blank">Разработка сайтов</a>: студия дизайна Вадима Гончарова',
	'karachinskaya.ru' => '<a href="http://vadimdesign.ru" target="_blank">Разработка сайтов в Новосибирске</a>: студия дизайна Вадима Гончарова',
	'dent-kolibri.ru' => '<a href="http://vadimdesign.ru" target="_blank">Разработка сайтов</a>: студия дизайна Вадима Гончарова',
	'medvediza.com' => '<a href="http://vadimdesign.ru" target="_blank">vadimdesign.ru</a>: разработка сайтов в Новосибирске',
	'dress-no-stress.ru' => '<a href="http://vadimdesign.ru" target="_blank">vadimdesign.ru</a>: разработка сайтов в Новосибирске',
	'dress-no-stress.ru' => '<a href="http://vadimdesign.ru" target="_blank">Разработка сайтов</a>: студия дизайна Вадима Гончарова',

	'kreditsib.ru' => 'Создание сайтов в Новосибирске: <a href="http://vadimdesign.ru" target="_blank">vadimdesign.ru</a><br>Поисковое продвижение: <a href="http://siberiasite.ru">siberiasite.ru</a>',
	'novosibirsk.kreditsib.ru' => 'Создание сайтов в Новосибирске: <a href="http://vadimdesign.ru" target="_blank">vadimdesign.ru</a><br>Поисковое продвижение: <a href="http://siberiasite.ru">siberiasite.ru</a>',
	'krasnoyarsk.kreditsib.ru' => 'Создание сайтов в Новосибирске: <a href="http://vadimdesign.ru" target="_blank">vadimdesign.ru</a><br>Поисковое продвижение: <a href="http://siberiasite.ru">siberiasite.ru</a>',
	'omsk.kreditsib.ru' => 'Создание сайтов в Новосибирске: <a href="http://vadimdesign.ru" target="_blank">vadimdesign.ru</a><br>Поисковое продвижение: <a href="http://siberiasite.ru">siberiasite.ru</a>',
	'altaickiikrai.kreditsib.ru' => 'Создание сайтов в Новосибирске: <a href="http://vadimdesign.ru" target="_blank">vadimdesign.ru</a><br>Поисковое продвижение: <a href="http://siberiasite.ru">siberiasite.ru</a>',
);
/*******************************************************************************************************************************************/

/******************************* Ссылка по умолчанию *************************************************************************/
$link = '<a href="http://vadimdesign.ru" target="_blank">Создание сайтов в Новосибирске</a>: студия дизайна Вадима Гончарова';
/*****************************************************************************************************************************/

if(isset($_GET['host'])){
	$host = $_GET['host'];
	foreach($hosts as $key => $value) {
		if('http://'.$key.'/' == $host){
			$link = $value;
		}
	}
}

echo $link;