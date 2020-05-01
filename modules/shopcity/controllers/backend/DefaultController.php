<?php

namespace app\modules\shopcity\controllers\backend;

use app\modules\shopcity\models\ShopCity;
use app\modules\shopcity\models\ShopCitySearch;
use Yii;
use app\controllers\BackendController;
use yii\web\NotFoundHttpException;

class DefaultController extends BackendController
{
    public function actionIndex()
    {
        $searchModel = new ShopCitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('/backend/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('/backend/view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new ShopCity();
		$model->status = 1; // Значение поля по умолчанию
		$model->weight = 0; // Значение поля по умолчанию
		
        if ($model->load(Yii::$app->request->post()) && $model->save())
		{
            $this->post = Yii::$app->request->post();

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

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = ShopCity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested article does not exist.');
        }
    }

	public function actionMultiAction()
	{
		$action = Yii::$app->request->post('form-multi-action');
		if($selection = Yii::$app->request->post('selection')) {
			if (count($selection)) {
				if ($action == 'delete') {
					foreach ($selection as $id) {
						/*** Удаляем сам материал ***/
						$this->findModel($id)->delete();
					}
				} elseif ($action == 'copy') {
					foreach ($selection as $id) {
						$model = $this->findModel($id);

						$new_model = new ShopCity();
						$new_model->attributes = $model->attributes;
						$new_model->title = 'Clone ' . $new_model->title;
						$new_model->save();
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
        if (($model = ShopCity::findOne($id)) !== null) {
            return $model;
        } else {
            return false;
        }
    }

    public function actionClone($id)
    {
        $model = $this->findModel($id);

        $new_model = new ShopCity();
        $new_model->attributes = $model->attributes;
        $new_model->title = 'Clone ' . $new_model->title;
        $new_model->save();

        return $this->redirect(['update', 'id' => $new_model->id]);
    }
}