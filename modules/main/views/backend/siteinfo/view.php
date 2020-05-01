<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Siteinfo */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Инфо', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siteinfo-view">

    <h3><?= Html::encode($this->title) ?></h3>
    <hr>
    <div class="row">
        <div class="col-xs-5">
            <div class="form-group">
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary custom-save-panel-button']) ?>
                <?= Html::a('Настройка дополнительных параметров', ['setting', 'id' => $model->id], ['class' => 'btn btn-primary custom-save-panel-button']) ?>
            </div>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            /* 'meta_title',
            'meta_key:ntext',
            'meta_desc:ntext', */
            'email:email',
            'phone:html',
	        'phone_sell:html',
	        'phone_nsk:html',
            'address:html',
            'slogan',
            'body:html',
            /* 'map:html',
            'counter:ntext', */
            'copyright',
        ],
    ]) ?>

</div>
