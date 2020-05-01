<?php
namespace app\modules\vacancy\controllers;

use app\controllers\FrontendController;
use app\modules\vacancy\models\Vacancy;
use yii\web\NotFoundHttpException;


/**
 * Default controller for the `page` module
 */
class DefaultController extends FrontendController
{
	public $layout = '//page';

	public function actionIndex()
	{
		$vacancy = Vacancy::find()->where(['status' => 1])->all();

		return $this->render('/vacancies', ['vacancy' => $vacancy]);
	}

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionView($alias = '')
    {
		$vacancy = Vacancy::find()->where(['status' => 1, 'alias' => $alias])->one();
		
		if ($vacancy) {
		
            $this->view->title = $vacancy->title;
			
			/******************** SEO ************************/
			if($seo = $vacancy->seo)
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
			
			return $this->render('/vacancy', ['vacancy' => $vacancy]);
			
        } else {
            throw new NotFoundHttpException('404 Страница не найдена.');
        }
    }
}
