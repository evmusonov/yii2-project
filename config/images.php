<?php
//use app\components\Thumbnailer;

// откуда будем резать тамб у картинки
/**
 * 0 - Если картинка вертикальная - то миниатюра будет браться сверху, если горизонтальная - слева.
 * (Имеет смысл только при типе "2", в других случаях миниатюра
 * всегда будет полностью видима)
 */

/**
 * 1 - Миниатюра будет взята с центра картинки
 */

/**
 * 2 - Если картинка вертикальная - то миниатюра будет браться снизу, если горизонтальная - справа.
 * (Имеет смысл только при типе "0", в других случаях миниатюра
 * всегда будет полностью видима)
 */

// как будем резать тамб
/**
 * 0 - Миниатюра будет строго указанного размера, если соотношения сторон исходного изображения и
 * миниатюры не совпадают - то останутся полосы указанного цвета.
 */

/**
 * 1 - Одна из сторон миниатюры будет строго заданного размера, а другая - меньше настолько,
 * чтобы совпало соотношение сторон.
 */

/**
 * 2 - Миниатюра будет строго указанного размера и на ней не будет полос, но если соотношения
 * сторон миниатюры и исходного изображения не совпадут, то миниатюра будет содержать не всю
 * картинку, а только её часть.
 * (Какая часть будет содержаться в миниатюре указывается параметром Thumbnailer::THUMBNAIL_LOCATION_*)
 */

return [
	'versions' => [
		'1920x865' => [
			'uploadDir' => '1920x865/',
			'width' => 1920,
			'height' => 865,
			'locationMode' => 1,// Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
			'quality' => 80,
			'isDefault' => FALSE,
		],
		'902x494' => [
			'uploadDir' => '902x494/',
			'width' => 902,
			'height' => 494,
			'locationMode' => 1,// Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
			'quality' => 90,
			'isDefault' => FALSE,
		],
		'900x493' => [
			'uploadDir' => '900x493/',
			'width' => 900,
			'height' => 493,
			'locationMode' => 1,// Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
			'quality' => 90,
			'isDefault' => FALSE,
		],
		'600x570' => [
			'uploadDir' => '600x570/',
			'width' => 600,
			'height' => 570,
			'locationMode' => 1,// Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
			'quality' => 90,
			'isDefault' => FALSE,
		],
		'600x381' => [
			'uploadDir' => '600x381/',
			'width' => 600,
			'height' => 381,
			'locationMode' => 1,// Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
			'quality' => 90,
			'isDefault' => FALSE,
		],
		'250x380' => [
			'uploadDir' => '250x380/',
			'width' => 250,
			'height' => 380,
			'locationMode' => 1,// Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
			'quality' => 90,
			'isDefault' => FALSE,
		],
		'314x250' => [
			'uploadDir' => '314x250/',
			'width' => 314,
			'height' => 250,
			'locationMode' => 1,// Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
			'quality' => 90,
			'isDefault' => FALSE,
		],
		'200x299' => [
			'uploadDir' => '200x299/',
			'width' => 200,
			'height' => 299,
			'locationMode' => 1,// Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
			'quality' => 90,
			'isDefault' => FALSE,
		],
		'200x150' => [
			'uploadDir' => '200x150/',
			'width' => 200,
			'height' => FALSE,
			'locationMode' => 1,// Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
			'quality' => 90,
			'isDefault' => FALSE,
		],
		'thumbgall' => [
			'uploadDir' => 'thumbgall/',
			'width' => FALSE,
			'height' => 100,
			'locationMode' => 1, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 1, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
			'quality' => 80,
			'isDefault' => FALSE,
		],
		'thumbnail' => [
			'uploadDir' => 'thumbnail/',
			'width' => 100,
			'height' => FALSE,
			'locationMode' => 1, //Thumbnailer::THUMBNAIL_LOCATION_CENTER,
			'typeMode' => 2, //Thumbnailer::THUMBNAIL_TYPE_AUTO_SIZE,
			'quality' => 100,
			'isDefault' => TRUE,
		],
	],
	'paths' => [
		'downloadDir' => '/files/',
		'uploadDir' => '@webroot/files/',
		'nophotoDir' => 'nophoto/',
		'nophotoFilename' => 'no_photo.jpg',
	],
];