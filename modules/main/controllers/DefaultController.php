<?php

namespace app\modules\main\controllers;

use app\modules\main\models\forms\FormVacancy;
use mirocow\yandexmaps\Map;
use Yii;
use app\controllers\FrontendController;
use app\modules\main\models\forms\FormContact;

/**
 * Default controller for the `main` module
 */
class DefaultController extends FrontendController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('/index');
    }

    public function actionShops()
    {
	    $map = new Map('yandex_map', [
		    'center' => [55.7372, 37.6066],
		    'zoom' => 10,
		    // Enable zoom with mouse scroll
		    'behaviors' => array('default', 'scrollZoom'),
		    'type' => "yandex#map",
	    ],
		    [
			    // Permit zoom only fro 9 to 11
			    'minZoom' => 9,
			    'maxZoom' => 11,
			    'controls' => [
				    "new ymaps.control.SmallZoomControl()",
				    "new ymaps.control.TypeSelector(['yandex#map', 'yandex#satellite'])",
			    ],
		    ]
	    );

	    return $this->render('/shops', ['map' => $map]);
    }

	public function actionContact()
	{
		$this->layout = '//page';
		return $this->render('/contacts');
	}

	/***************************** Переадресация внешних ссылок **********************************/
	public function actionGo()
    {
		if($ref = Yii::$app->request->get('ref'))
		{
			return $this->redirect('http://'.$ref, 301)->send();
		}
    }
	
	/***************************** Отправка формы по AJAX **********************************/
	public function actionSendContactForm()
    {
		$form = new FormContact();
        if ($form->load(Yii::$app->request->post()) AND $form->contact($this->siteinfo->email))
		{
            return 'success';
        } else {
	        return 'error';
		}
    }

	public function actionSendVacancyForm()
	{
		$form = new FormVacancy();
		if ($form->load(Yii::$app->request->post()) AND $form->send($this->siteinfo->email))
		{
			return 'success';
		} else {
			return 'error';
		}
	}
}