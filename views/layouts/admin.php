<?php

use app\components\widgets\Debugger;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\assets\AdminAsset;
use app\components\widgets\Alert;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
	<?php
	/* Yii::$app->user->identity->username; */
    NavBar::begin([
        'brandLabel' => '<img class="" src="/img/_src/logo.svg" alt="" style="width:45px">',
        'brandUrl' => Url::to(['/main/backend/default/index']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
	echo Debugger::widget([]);
    echo Nav::widget([
        'options' => ['class' => 'main-menu navbar-nav navbar-right'],
        'items' => [
			['label' => 'Аккаунт', 'url' => ['/user/backend/default/index']],

            ['label' => 'Настройки', 'options' => ['class' => 'mark-menu-item'],
                'items' => [
                    ['label' => 'Общая информация сайта', 'url' => ['/main/backend/default/index']],
                ],
            ],
            ['label' => 'Меню', 'url' => ['/menu/backend/default/index']],

			['label' => 'Контент', 'options' => ['class' => 'mark-menu-item'],
				'items' => [
					['label' => 'Вакансии', 'url' => ['/vacancy/backend/default/index']],
					['label' => 'Главный слайдер', 'url' => ['/slider/backend/default/index']],
					['label' => 'Инфоблоки', 'url' => ['/infoblock/backend/default/index']],
					['label' => 'Категории', 'url' => ['/category/backend/default/index']],
					['label' => 'Мини-слайдер', 'url' => ['/minislider/backend/default/index']],
					['label' => 'Партнеры', 'url' => ['/client/backend/default/index']],
					['label' => 'Продукты', 'url' => ['/product/backend/default/index']],
					['label' => 'Страницы', 'url' => ['/page/backend/default/index']],
					['label' => 'Статьи', 'url' => ['/article/backend/default/index']],
					['label' => 'Розничные магазины', 'options' => ['class' => 'mark-menu-item'],
						'items' => [
							['label' => 'Города', 'url' => ['/shopcity/backend/default/index']],
							['label' => 'Магазины', 'url' => ['/shoplist/backend/default/index']],
						],
					],
				],
			],

			['label' => 'На сайт', 'url' => [Yii::$app->homeUrl], 'linkOptions' => ['target' => '_blank']],
			['label' => 'Выйти', 'url' => ['/user/default/logout'], 'linkOptions' => ['data-method' => 'post']],
        ],
    ]);
    NavBar::end();
    ?>
	<div class="container">
        <?= Breadcrumbs::widget([
			'homeLink' => false,
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumb']
        ]) ?>
		<?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= date('Y') ?> г. <?= Html::a('Студия дизайна Вадима Гончарова', Url::to('https://vadimdesign.ru'), ['target' => '_blank']) ?></p>
    </div>
</footer>
<?php
    Modal::begin([
        'header' => '<h2>Предупреждение</h2>',
        'options' => ['id' => 'debug-modal'],
        'footer' => '<div class="btn btn-success debug-modal-close">Понятно</div>',
        'footerOptions' => ['style' => 'text-align: center;']
    ]);

    echo '<div class="debug-modal-info"></div>';

    Modal::end();
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>