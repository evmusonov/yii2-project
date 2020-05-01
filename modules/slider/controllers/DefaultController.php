<?php
namespace app\modules\page\controllers;

use app\controllers\FrontendController;
use app\modules\page\models\Page;

use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;

use Yii;
use app\modules\main\models\forms\FormContact;

/**
 * Default controller for the `page` module
 */
class DefaultController extends FrontendController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($alias = '')
    {
		$page = Page::find()->where(['status' => 1, 'alias' => $alias])->one();
		
		if ($page) {
		
            $this->view->title = $page->title;
			
			/******************** SEO ************************/
			if($seo = $page->seo)
			{
				if(!empty($seo->meta_title)){
					$this->view->title = $seo->meta_title;
				}
				
				if(!empty($seo->meta_desc)){
					$this->view->params['meta_description'] = $seo->meta_desc;
				}
				
				if(!empty($seo->meta_key)){
					$this->view->params['meta_keywords'] = $seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
			
			return $this->render('/page', ['page' => $page]);
			
        } else {
            throw new NotFoundHttpException('404 Страница не найдена.');
        }
    }
}
