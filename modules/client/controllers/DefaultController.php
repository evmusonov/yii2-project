<?php
namespace app\modules\client\controllers;

use app\controllers\FrontendController;
use app\modules\client\models\Client;
use yii\web\NotFoundHttpException;

class DefaultController extends FrontendController
{
    public function actionIndex()
    {
		return $this->render('/client');
    }
}