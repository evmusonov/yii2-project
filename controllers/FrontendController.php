<?php

namespace app\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;

/***** MODELS ******/
use app\modules\main\models\Siteinfo;
use app\modules\language\models\Language;

class FrontendController extends Controller
{
	protected $siteinfo;
	protected $setting;
	protected $session;
    protected $langInfo;
    protected $langId = 1;
	protected $page_class = 'page-index';
	
	public function behaviors()
    {
	
		$this->siteinfo = Siteinfo::find()->one();
		$this->view->params['siteinfo'] = $this->siteinfo;
		$this->view->params['setting'] = [];
		
		if(isset($this->siteinfo->setting))
		{
			foreach($this->siteinfo->setting as $item)
			{
				$this->view->params['setting'][$item->name] = $item->value;
			}
		}

        /* if($this->langInfo = Language::find()->where(['code' => Yii::$app->language])->one())
        {
            $this->langId = $this->langInfo->id;
        } */

        $this->view->params['page_class'] = $this->page_class;
       // $this->view->params['lang_info'] = $this->langInfo;
        //$this->view->params['lang_id'] = $this->langId;
		
		$this->view->params['page_class'] = $this->page_class;
		
		$this->session = Yii::$app->session;
		
		/***************************** SEO ******************************/
		$this->view->title = $this->siteinfo->title;
		if($this->siteinfo->seo && !empty($this->siteinfo->seo->meta_title)){
			$this->view->title = $this->siteinfo->seo->meta_title;
		}
		$this->view->params['meta_description'] = $this->siteinfo->seo->meta_desc;
		$this->view->params['meta_keywords'] = $this->siteinfo->seo->meta_key;
		/***************************** /SEO *****************************/
		
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
 
    public function actions()
    {
        return [
			'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
}