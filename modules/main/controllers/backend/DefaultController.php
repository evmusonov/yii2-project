<?php
namespace app\modules\main\controllers\backend;

use app\controllers\BackendController;
use Yii;
use app\modules\main\models\Siteinfo;
use app\modules\seo\models\Seo;
use yii\web\NotFoundHttpException;
use app\modules\main\Module;

class DefaultController extends BackendController
{
    public function actionIndex()
    {
		$id = 1;
        return $this->render('/backend/siteinfo/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single siteinfo model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id = 1)
    {
        return $this->render('/backend/siteinfo/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new siteinfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Siteinfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('/backend/siteinfo/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing siteinfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	    //Replace <span> to [..] or {..}
	    preg_match_all('/\<span([^\]])+?\>[^\]]+?\<\/span\>/m', $model->slogan, $matches);

	    foreach ($matches[0] as $index => $match) {
		    if (strpos($match, 'id=') === false) {
			    $model->slogan = str_ireplace($match, '{' . strip_tags($match) . '}', $model->slogan);
		    } else {
			    $model->slogan = str_ireplace($match, '[' . strip_tags($match) . ']', $model->slogan);
		    }
	    }

        if ($model->load(Yii::$app->request->post())) {
        	//Replace [] to links
        	preg_match_all('/\[([^\]]+?)\]/m', $model->slogan, $matches);
        	foreach ($matches[1] as $index => $match) {
		        $model->slogan = str_ireplace($matches[0][$index], '<span id="' . $index . '" class="green title">' . $match . '</span>', $model->slogan);
	        }

        	//replace {} to text
	        preg_match_all('/\{([^\}]+?)\}/m', $model->slogan, $matches);
	        foreach ($matches[1] as $index => $match) {
		        $model->slogan = str_ireplace($matches[0][$index], '<span class="title-hidden title-text-' . $index . '">' . $match . '</span>', $model->slogan);
	        }
	        $model->save();
			$this->post = Yii::$app->request->post();

            /*** Редактирование SEO ***/
            $seoModel = new Seo();
            $seoModel->updateSeo($this->post, $model->id, Module::getInstance()->id);

	        if(isset($this->post['continue'])) {
		        return $this->redirect(['update', 'id' => $model->id]);
	        }

            return $this->redirect(['index']);
        } else {
            return $this->render('/backend/siteinfo/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the siteinfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return siteinfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Siteinfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
