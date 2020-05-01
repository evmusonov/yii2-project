<?php

namespace app\modules\slider\controllers\backend;

use app\modules\slider\models\Slider;
use app\modules\slider\models\SliderSearch;
use Yii;
use app\modules\seo\models\Seo;
use app\modules\file\models\File;
use app\modules\subcontent\models\Subcontent;
use app\controllers\BackendController;
use yii\web\NotFoundHttpException;

use app\modules\slider\Module;

/**
 * PageController implements the CRUD actions for Page model.
 */
class DefaultController extends BackendController
{
    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $newModel = new Slider();
        $searchModel = new SliderSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/backend/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'newModel' => $newModel,
        ]);
    }

    /**
     * Displays a single Page model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('/backend/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Slider();
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

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
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

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
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

    /**
     * MULTIDELETE Массовое удаление материалов
     * MULTIUPDATE Массовое редактирование материалов
     */
    public function actionMultiAction()
    {
	    $action = Yii::$app->request->post('form-multi-action');
        if($arrKey = Yii::$app->request->post('selection'))
        {
            if($arrKey AND is_array($arrKey) AND count($arrKey))
            {
            	if ($action == 'delete') {
		            $fileModel = new File();
		            $seoModel = new Seo();

		            foreach ($arrKey as $id) {
			            /*** Удаляем сам материал ***/
			            $this->findModel($id)->delete();

			            /*** Удаляем файлы и записи из таблицы file ***/
			            $fileModel->deleteFiles($id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);

			            /*** Удаляем записи из таблицы seo ***/
			            $seoModel->deleteSeo($id, Module::getInstance()->id);

			            /*** Удаляем связанные дополнительные материалы ***/
			            Subcontent::deleteAll(['module' => Module::getInstance()->id, 'content_id' => $id]);
		            }
	            } elseif ($action == 'copy') {
		            foreach ($arrKey as $id) {
			            $model = $this->findModel($id);

			            $new_model = new Slider();
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

        if($multiedit = Yii::$app->request->post('multiedit'))
        {
            if($multiedit AND is_array($multiedit) AND count($multiedit)>0)
            {
                foreach($multiedit as $id => $field)
                {
                    if($model = $this->findModelForMultiAction($id))
                    {
                        foreach($field as $key => $value)
                        {
                            if(isset($field[$key]))
                            {
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
        if (($model = Slider::findOne($id)) !== null) {
            return $model;
        } else {
            return false;
        }
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slider::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionClone($id)
    {
        $model = $this->findModel($id);

        $new_model = new Slider();
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
