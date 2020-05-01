<?php

namespace app\modules\category\controllers\backend;

use app\modules\category\models\Category;
use app\modules\category\models\CategorySearch;
use Yii;
use app\modules\seo\models\Seo;
use app\modules\file\models\File;
use app\controllers\BackendController;
use yii\web\NotFoundHttpException;

use app\modules\category\Module;

class DefaultController extends BackendController
{
    public function actionIndex()
    {
        $newModel = new Category();
        $searchModel = new CategorySearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/backend/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'newModel' => $newModel,
        ]);
    }

    public function actionCreate()
    {
        $model = new Category();
		$model->status = 1; // Значение поля по умолчанию
		$model->weight = 0; // Значение поля по умолчанию

        if ($model->load(Yii::$app->request->post()) && $model->save())
		{
            $this->post = Yii::$app->request->post();

            /*** Редактирование (добавление) картинки миниатюры ***/
            $fileModel = new File();
            $fileModel->updateThumb($this->post, $model, $model->id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);

			/*** Редактирование SEO ***/
			$seoModel = new Seo();
			$seoModel->updateSeo($this->post, $model->id, Module::getInstance()->id);

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

			/*** Редактирование SEO ***/
			$seoModel = new Seo();
			$seoModel->updateSeo($this->post, $model->id, Module::getInstance()->id);

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
        $model = $this->findModel($id);
        /*** Удаляем сам материал ***/
        $model->delete();

        /*** Удаляем файлы и записи из таблицы file ***/
        $fileModel = new File();
        $fileModel->deleteFiles($id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);

        return $this->redirect(['index']);
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

						$new_model = new Category();
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
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            return false;
        }
    }

    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionClone($id)
    {
        $model = $this->findModel($id);

        $new_model = new Category();
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
}
