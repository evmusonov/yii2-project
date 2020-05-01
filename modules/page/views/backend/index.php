<?php

use app\components\widgets\backend\grid\CheckboxColumn;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ActiveForm;

use app\components\widgets\backend\grid\StatusColumn;
use app\components\widgets\backend\grid\EditColumn;
use app\modules\page\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h3><?= Html::encode($this->title) ?></h3>

	<hr>
    <p>
        <?= Html::a('Создать новую запись', ['create'], ['class' => 'btn btn-success btn-xs custom-create-button']) ?>
    </p>

    <div class="data-table">
        <p>
            <?= Html::button('Сохранить изменения', ['class' => 'btn btn-warning btn-xs right custom-save-button', 'onclick' => 'multiUpdate("update_form")', 'disabled' => 'disabled']) ?>
            <span class="edit-block">
                <?= Html::button('Удалить' . Html::img('/img/group-delete.png', ['class' => 'group-img']), ['class' => 'btn btn-warning btn-xs right custom-delete-button', 'onclick' => 'multiDelete("update_form")']) ?>
                <?= Html::button('Копировать' . Html::img('/img/group-copy.png', ['class' => 'group-img']), ['class' => 'btn btn-warning btn-xs right custom-copy-button', 'onclick' => 'multiCopy("update_form")']) ?>
            </span>
        </p>
        <?= Html::beginForm('/admin/' . Module::getInstance()->id . '/multi-action', 'post', ['id' => 'update_form']) ?>
            <?= Html::hiddenInput('form-multi-action', '', ['class' => 'form-multi-action']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-striped custom-table'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['class' => CheckboxColumn::className()],
                    [
                        'class' => EditColumn::className(),
                        'attribute' => 'title',
	                    'contentOptions' => ['style' => 'width: 30%;'],
                    ],
                    [
                        'class' => EditColumn::className(),
                        'attribute' => 'alias',
	                    'contentOptions' => ['style' => 'width: 25%;'],
                    ],
                    [
                        'class' => EditColumn::className(),
                        'attribute' => 'weight',
                        'fieldType' => 'number',
                        'style' => 'weight-right',
	                    'contentOptions' => ['style' => 'width: 12%;'],
                    ],
                    [
                        'class' => StatusColumn::className(),
                        'attribute' => 'status',
	                    'contentOptions' => ['style' => 'width: 12%;'],
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '<div>{clone}{update}{delete}</div>',
                        'buttons' => [
                            'clone' => function ($url, $model) {
                                return Html::a(
                                    '<img src="/img/copy.png">', $url, ['class' => 'custom-action-button']);
                            },
	                        'delete' => function ($url, $model) {
		                        return Html::a(
			                        '<img src="/img/delete.png">', $url, ['class' => 'custom-action-button', 'data-confirm' => 'Вы уверены, что хотите удалить этот элемент?', 'data-method' => 'post']);
	                        },
	                        'update' => function ($url, $model) {
		                        return Html::a(
			                        '<img src="/img/edit.png">', $url, ['class' => 'custom-action-button']);
	                        },
                        ]
                    ],
                ],
            ]); ?>
        <?= Html::endForm()?>
    </div>
</div>
