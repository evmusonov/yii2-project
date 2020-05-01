<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\helpers\Img;
use app\modules\article\Module;

/* @var $this yii\web\View */
/* @var $model app\models\Partners */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="partners-view">
    <h3><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'short_title',
			'title',
			'alias',
            
            [
				'label' => 'Картинка',
				'value' => ($model->thumb)? '<img src="'.Img::_(Module::getInstance()->id, $model->id, 'thumbnail', $model->thumb->filename).'">':'',
				'format' => 'html',
			],
            'teaser:html',
            'body:html',
            'weight',
            [
				'label' => 'Активно',
				'value' => ($model->status)? '<p class="text-success">Активный</p>':'<p class="text-danger">Неактивный</p>',
				'format' => 'html',
			],
        ],
    ]) ?>
</div>