<?php

use app\components\widgets\backend\grid\CheckboxColumn;
use app\modules\user\models\User;
use app\modules\user\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Аккаунт';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>

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
					'filter' => DatePicker::widget([
						'model' => $searchModel,
						'attribute' => 'date_from',
						'attribute2' => 'date_to',
						'type' => DatePicker::TYPE_RANGE,
						'separator' => '-',
						'pluginOptions' => ['format' => 'yyyy-mm-dd']
					]),
					'attribute' => 'created_at',
					'format' => 'date',
				],
				'username',
				'email:email',
				[
					'filter' => User::getStatusesArray(),
					'attribute' => 'status',
					'format' => 'raw',
					'value' => function ($model, $key, $index, $column) {
						$value = $model->{$column->attribute};
						switch ($value) {
							case User::STATUS_ACTIVE:
								$class = 'success';
								break;
							case User::STATUS_WAIT:
								$class = 'warning';
								break;
							case User::STATUS_BLOCKED:
							default:
								$class = 'default';
						};

						$html = '<p class="text-right"><span class="label label-'.$class.'">'.Html::encode($model->getStatusName()).'</span>';
						return $value === null ? $column->grid->emptyCell : $html;
					}
				],
				[
					'class' => 'yii\grid\ActionColumn',
					'template' => '<div>{update}{delete}</div>',
					'contentOptions' => ['style' => 'width: 12%;'],
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
