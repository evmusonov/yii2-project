<?php
namespace app\modules\category\controllers;

use app\controllers\FrontendController;
use app\modules\category\models\Category;
use yii\web\NotFoundHttpException;

class DefaultController extends FrontendController
{
	public $layout = '//page';

    public function actionView($alias = '')
    {
		$category = Category::find()->where(['status' => 1, 'alias' => $alias])->one();
		
		if ($category) {
		
            $this->view->title = $category->title;
			
			/******************** SEO ************************/
			if($seo = $category->seo)
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
			
			return $this->render('/category', ['category' => $category]);
			
        } else {
            throw new NotFoundHttpException('404 Страница не найдена.');
        }
    }
}
