<?php

namespace app\modules\shoplist\controllers;

use app\controllers\FrontendController;
use app\modules\shopcity\models\ShopCity;
use app\modules\shoplist\models\ShopList;
use mirocow\yandexmaps\Map;

class DefaultController extends FrontendController
{
	public $layout = '//page';

    public function actionIndex()
    {
		$cities = ShopCity::find()->all();

	    $citiesList = [];
	    if ($cities) {
		    foreach ($cities as $item) {
		    	$shops = '';
		    	if ($item->shops) {
		    		foreach ($item->shops as $shop) {
					    $shops .= $shop->title . '<br>';
				    }
			    }

			    $citiesList[] = [
				    'coords' => $item->coords,
				    'hint' => $item->title,
				    'ballon' => $shops
			    ];
		    }
	    }

    	return $this->render('/shops', ['citiesList' => $citiesList, 'cities' => $cities]);
    }
}