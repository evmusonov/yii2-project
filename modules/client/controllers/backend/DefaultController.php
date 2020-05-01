<?php

namespace app\modules\client\controllers\backend;

use Yii;
use app\modules\client\models\Client;
use app\modules\client\models\ClientSearch;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;
use app\controllers\BackendController;
use yii\web\NotFoundHttpException;
use app\modules\client\Module;

class DefaultController extends BackendController
{
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/backend/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Client();
		
		$model->status = 1; // Значение поля по умолчанию
		$model->weight = 0; // Значение поля по умолчанию

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			$this->post = Yii::$app->request->post();
			
			/*** Редактирование (добавление) картинки миниатюры ***/
            $fileModel = new File();
            $fileModel->updateThumb($this->post, $model, $model->id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);

			if(isset($this->post['continue'])) {
				return $this->redirect(['update', 'id' => $model->id]);
			}

			return $this->redirect(['index']);
        } 
		else 
		{
            return $this->render('/backend/create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			$this->post = Yii::$app->request->post();
			
			/*** Редактирование (добавление) картинки миниатюры ***/
            $fileModel = new File();
            $fileModel->updateThumb($this->post, $model, $model->id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);

			if(isset($this->post['continue'])) {
				return $this->redirect(['update', 'id' => $model->id]);
			}

			return $this->redirect(['index']);
        } 
		else 
		{
            return $this->render('/backend/update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		
		/*** Удаляем файлы и записи из таблицы file ***/
        $fileModel = new File();
        $fileModel->deleteFiles($id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);

        /*** Удаляем записи из таблицы seo ***/
        $seoModel = new Seo();
        $seoModel->deleteSeo($id, Module::getInstance()->id);

        return $this->redirect(['index']);
    }

	public function actionClone($id)
	{
		$model = $this->findModel($id);

		$new_model = new Client();
		$new_model->attributes = $model->attributes;
		$new_model->title = 'Clone ' . $new_model->title;
		$new_model->alias = null;
		if ($new_model->save())
		{
			File::cloneFiles(Module::getInstance()->id, $model->id, $new_model->id);
		}
		else
		{
			throw new NotFoundHttpException('Клонирование не удалось');
		}
		return $this->redirect(['update', 'id' => $new_model->id]);
	}

	public function actionMultiAction()
	{
		$action = Yii::$app->request->post('form-multi-action');
		if($selection = Yii::$app->request->post('selection')) {
			if (count($selection)) {
				if ($action == 'delete') {
					$fileModel = new File();
					$seoModel = new Seo();

					foreach ($selection as $id) {
						/*** Удаляем сам материал ***/
						$this->findModel($id)->delete();

						/*** Удаляем файлы и записи из таблицы file ***/
						$fileModel->deleteFiles($id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);

						/*** Удаляем записи из таблицы seo ***/
						$seoModel->deleteSeo($id, Module::getInstance()->id);
					}
				} elseif ($action == 'copy') {
					foreach ($selection as $id) {
						$model = $this->findModel($id);

						$new_model = new Client();
						$new_model->attributes = $model->attributes;
						$new_model->title = 'Clone ' . $new_model->title;
						$new_model->alias = null;
						if ($new_model->save()) {
							File::cloneFiles(Module::getInstance()->id, $model->id, $new_model->id);
						} else {
							throw new NotFoundHttpException('Клонирование не удалось');
						}
					}
				}
			}
		}

		if($multiedit = Yii::$app->request->post('multiedit')) {
			if(count($multiedit)) {
				foreach($multiedit as $id => $field) {
					if($model = $this->findModelForMultiAction($id)) {
						foreach($field as $key => $value) {
							if(isset($field[$key])) {
								$model->{$key} = $value;
							}
						}
						$model->save();
					}
				}
			}
		}
		return $this->redirect(['index']);
	}

    protected function findModelForMultiAction($id)
    {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        } else {
            return false;
        }
    }

	protected function findModel($id)
	{
		if (($model = Client::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested client does not exist.');
		}
	}
}