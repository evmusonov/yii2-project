<?php
namespace app\modules\company\controllers;

use app\controllers\FrontendController;
use app\modules\category\models\Category;
use app\modules\client\models\Client;
use yii\web\NotFoundHttpException;


/**
 * Default controller for the `page` module
 */
class DefaultController extends FrontendController
{
	public $layout = '//page';

    public function actionIndex()
    {
    	$partners = Client::find()->all();

    	return $this->render('/company', ['partners' => $partners]);
    }
}
