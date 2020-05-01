<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use app\components\helpers\Image;
use vova07\imperavi\actions\GetAction;

class BackendController extends Controller
{
	protected $imagesPath;
	protected $imagesDownloadPath;
	protected $imagesVersion;
	
	protected $post;
	
    public function behaviors()
    {
		$this->layout = '//admin';
		
		$this->imagesPath = Yii::$app->params['images']['paths']['uploadDir'];
		$this->imagesDownloadPath = Yii::$app->params['images']['paths']['downloadDir'];
		$this->imagesVersion = Yii::$app->params['images']['versions'];
		
        return [
			'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
					'delete-image' => ['post'],
					'multi-delete' => ['post'],
                ],
            ],
        ];
    }
	
	/***************************** Загрузка, вывод картинок в редакторе **********************************/
	public function actions()
    {
        $id = 'all';
		$module = 'all';
		$imagesDirectory = '/files';
		
		$this->imagesPath = Yii::$app->params['images']['paths']['uploadDir'];
		$this->imagesDownloadPath = Yii::$app->params['images']['paths']['downloadDir'];
		
		/* if(Yii::$app->request->get('id')) $id = Yii::$app->request->get('id');
		if(Yii::$app->request->get('module')) $module = Yii::$app->request->get('module'); */
		
		if(Yii::$app->request->get('id')) $id = Yii::$app->request->get('id');
		if(Yii::$app->request->get('imagesDirectory')) $imagesDirectory = Yii::$app->request->get('imagesDirectory');
		
		return [
			'browse-images' => [
				'class' => 'bajadev\ckeditor\actions\BrowseAction',
				'quality' => 80,
				'maxWidth' => 800,
				'maxHeight' => 800,
				'useHash' => false,
				'url' => $this->imagesDownloadPath.$imagesDirectory.'/'.$id.'/static/', // URL адрес папки где хранятся изображения.
				'path' => $this->imagesPath.$imagesDirectory.'/'.$id.'/static/', // Или абсолютный путь к папке с изображениями.
			],
			'upload-images' => [
				'class' => 'bajadev\ckeditor\actions\UploadAction',
				'quality' => 80,
				'maxWidth' => 800,
				'maxHeight' => 800,
				'useHash' => false,
				'url' => $this->imagesDownloadPath.$imagesDirectory.'/'.$id.'/static/', // URL адрес папки где хранятся изображения.
				'path' => $this->imagesPath.$imagesDirectory.'/'.$id.'/static/', // Или абсолютный путь к папке с изображениями.
			],
		];
    }
	/***************************** /Загрузка, вывод картинок в редакторе **********************************/
	
	/***************************** Удаление картинок по AJAX **********************************/
	public function actionDeleteImage()
    {
        if (Image::deleteAsPost(Yii::$app->request->post()))
		{
			return 'success';
        } 
		else 
		{
			return 'error';
		}
    }
	/***************************** /Удаление картинок по AJAX **********************************/
	
	/***************************** Массовое удаление материалов **********************************/
	public function actionMultiDelete()
	{
		$module = Yii::$app->request->post('module');
		
        if($arrKey = Yii::$app->request->post('selection'))
        {
			if($arrKey AND is_array($arrKey) AND count($arrKey)>0)
			{
				foreach($arrKey as $id)
				{
					Yii::$app->db->createCommand('DELETE FROM `'.$module.'` WHERE id = :id')
					   ->bindValue(':id', $id)
					   ->queryOne();
				
					// Удаляем все файлы материала
					FileHelper::removeDirectory(Yii::getAlias($this->imagesPath.$module.'/'.$id.'/'));
				}
			}
        }
        return $this->redirect(['/admin/'.$module.'/index']);
	}
	/***************************** /Массовое удаление материалов **********************************/
}