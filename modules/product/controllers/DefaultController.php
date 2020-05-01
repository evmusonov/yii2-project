<?php

namespace app\modules\product\controllers;

use app\controllers\FrontendController;
use app\modules\article\models\Article;
use app\modules\category\models\Category;
use app\modules\product\models\Product;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;
use Yii;

/**
 * Default controller for the `article` module
 */
class DefaultController extends FrontendController
{
	public $layout = '//page';
	/**
     * Renders the view for the module
     * @return string
     */
    public function actionView($alias = '')
    {
		if(!Yii::$app->user->isGuest)
		{
			$article = Product::find()->where(['alias' => $alias])->one();
		}
		else
		{
			$article = Product::find()->where(['status' => 1, 'alias' => $alias])->one();
		}
		
		if ($article) 
		{
            $this->view->title = $article->title;
			
			/******************** SEO ************************/
			if($seo = $article->seo)
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
			
			return $this->render('/product', ['article' => $article]);
			
        } 
		else 
		{
            throw new NotFoundHttpException('404 Страница не найдена.');
        }
    }
	
    /**
     * Renders the index for the module
     * @return string
     */
    public function actionIndex()
    {
	    $category = Category::find()->orderBy('weight')->all();
    	return $this->render('/products', ['category' => $category]);
    }
}