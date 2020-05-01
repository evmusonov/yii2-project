<?php

namespace app\modules\product\controllers\backend;

use app\modules\category\models\Category;
use app\modules\product\models\Product;
use app\modules\product\models\ProductSearch;
use Yii;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;
use app\controllers\BackendController;
use yii\web\NotFoundHttpException;
use app\modules\product\Module;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class DefaultController extends BackendController
{
    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('/backend/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' article.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
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
	            'categories' => $this->getAllCategories(),
            ]);
        }
    }
    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' article.
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
	            'categories' => $this->getAllCategories(),
            ]);
        }
    }
    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' article.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		
		/*** Удаляем файлы и записи из таблицы file ***/
        $fileModel = new File();
        $fileModel->deleteFiles($id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);
		
        return $this->redirect(['index']);
    }
    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested article does not exist.');
        }
    }

    public function actionMultiAction()
    {
        if($arrKey = Yii::$app->request->post('selection'))
        {
            if($arrKey AND is_array($arrKey) AND count($arrKey)>0)
            {
                $fileModel = new File();
				$seoModel = new Seo();
				
                foreach($arrKey as $id)
                {
                    $this->findModel($id)->delete();

                    /*** Удаляем файлы и записи из таблицы file ***/
					$fileModel->deleteFiles($id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);
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
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            return false;
        }
    }

    public function actionClone($id)
    {
        $model = $this->findModel($id);

        $new_model = new Product();
        $new_model->attributes = $model->attributes;
        $new_model->short_title = 'Clone ' . $new_model->short_title;
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

	protected function getAllCategories()
	{
		return Category::find()->all();
	}
}