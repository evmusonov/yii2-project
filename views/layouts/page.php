<?php

use app\modules\article\components\BlockArticle;
use app\modules\category\components\BlockCategory;
use app\modules\minislider\components\BlockMiniSlider;
use app\modules\page\models\Page;
use app\modules\slider\components\BlockSlider;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
use app\components\widgets\Alert;
use app\modules\menu\components\BlockMenu;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);

$page = null;
if (Page::getContent()) {
	$page = Page::getContent();
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?= $this->params['meta_description'] ?>">
	<meta name="keywords" content="<?= $this->params['meta_keywords'] ?>">

	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>

	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <!-- google / search meta tags-->
    <meta itemprop="name" content="website">
    <meta itemprop="description" content="<?= $this->params['meta_description'] ?>">
    <meta itemprop="image" content="/img/share-big.png">
    <!-- facebook / vk meta tags-->
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:title" content="<?= isset($this->params['meta_title']) ? $this->params['meta_title'] : '' ?>">
    <meta property="og:site_name" content="<?= $this->params['siteinfo']->title ?>">
    <meta property="og:description" content="<?= $this->params['meta_description'] ?>">
    <meta property="og:image" content="/img/share-big.png">



    <!-- Для twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= isset($this->params['meta_title']) ? $this->params['meta_title'] : '' ?>">
    <meta name="twitter:description" content="<?= $this->params['meta_description'] ?>">

    <meta name="twitter:image:src" content="/img/share-big.png">
    <meta name="twitter:url" content="">
    <meta name="twitter:domain" content="">

    <!-- Для всех остальных -->
    <meta property="og:title" content="<?= isset($this->params['meta_title']) ? $this->params['meta_title'] : '' ?>"/>
    <meta property="og:description" content="<?= $this->params['meta_description'] ?>" />
    <meta property="og:type" content="website"/>
    <meta property="og:url" content=""/>
    <meta property="og:image" content="/img/share-big.png"/>
    <meta property="og:image:type" content="image/png">

	<?= $this->params['siteinfo']->head ?>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $this->params['siteinfo']->counter ?>

<!--[if lte IE 9]>
<div class="page__upgrade">Вы используете <strong>устаревший</strong> браузер. Пожалуйста,
	<a href="https://browsehappy.com/" target="_blank">обновите ваш браузер</a> для
	корректного отображения сайта.
</div><![endif]-->
<div class="container_main">
    <!--header-->
    <header style='background: <?= !empty($page->page_color) ? "#$page->page_color" : "#f3f5fa" ?>;'>
        <div class="header-menu">
            <a href="/"><img src="/img/_src/logo.svg" alt="logo"></a>
            <nav>
                <ul class="header-list">
	                <?= BlockMenu::front($menuClass = false) ?>
                </ul>
            </nav>
        </div>

        <div class="hamburger-menu">
            <input id="menu__toggle" type="checkbox" />
            <label class="menu__btn js-hamburger" for="menu__toggle">
                <span></span>
            </label>

            <ul class="menu__box">
                <a href="/" class="logo_mobile"><img src="/img/_src/logo.svg" alt="logo"></a>
	            <?= BlockMenu::front() ?>
            </ul>
        </div>


        <div class="fixed-container">
            <div class="fixed-menu showno">
                <a href="/"><img src="/img/_src/fixed_logo.svg" alt="logo"></a>
                <nav>
                    <ul class="header-list">
	                    <?= BlockMenu::front($menuClass = false) ?>
                    </ul>
                </nav>
                <div class="fixed-hamburger">
                    <input id="menu__toggle" type="checkbox" />
                    <label class="menu__btn js-hamburger" for="menu__toggle">
                        <span></span>
                    </label>

                    <ul class="menu__box">
                        <a href="/" class="logo_mobile"><img src="/img/_src/logo.svg" alt="logo"></a>
                        <?= BlockMenu::front() ?>
                    </ul>
                </div>
            </div>
        </div>




    </header>
    <!--header-->

    <!--main-->
    <main style='background: <?= !empty($page->page_color) ? "#$page->page_color" : "#f3f5fa" ?>;'>
            <div class="width-block">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => ['class' => 'breadcrumb']
                ]) ?>
	        </div>
        <?= $content ?>
    </main>
    <!--main-->

    <!--footer-->
    <footer style='background: <?= !empty($page->page_color) ? "#$page->page_color" : "#f3f5fa" ?>;'>
        <div class="footer-container">
            <div class="footer-left">
                <nav>
                    <?= BlockMenu::footer() ?>
                </nav>
            </div>
            <div class="footer-right">
                <img src="/img/_src/arrow_2.svg" alt="">
                <span><?= $this->params['siteinfo']->address ?></span>
                <ul class="list-right_2">
                    <li><a href="tel:<?= $this->params['siteinfo']->phone ?>"><?= $this->params['siteinfo']->phone ?></a></li>
                    <li><a href="mailto:<?= $this->params['siteinfo']->email ?>"><?= $this->params['siteinfo']->email ?></a></li>
                </ul>
            </div>
        </div>
    </footer>
    <!--footer-->
    <!--copyright-->
    <div class="copyright">
        <a class="page_up" href="#"><img src="/img/_src/up.svg" alt=""></a>
        <div class="copy-width">

            <div class="copy-left">
                <div><a href="/page/polzovatelskoe-soglashenie">Пользовательское соглашение<br>и политика конфеденциальности сайта</a></div>
                <div>© Молочная азбука, <?= date('Y') ?></div>
            </div>
            <div class="copy-right">
                <a href="https://vadimdesign.ru/" target="_blank">
                    Создание сайта
                    <img src="/img/_src/special.png" alt="">
                </a>
            </div>
        </div>
    </div>
    <!--copyright-->
    <!--cookie-->
<!--    <div class="cookie-container">-->
<!--        <div class="cookie-block">-->
<!--            <div>Мы используем файлы cookie, чтобы улучшить работу и повысить эффективность сайта.-->
<!--                Продолжая пользование данным сайтом, вы соглашаетесь с <a href="#" style="color: #d5d9de; text-decoration: underline;" target="_blank">политикой конфеденциальности</a></div>-->
<!--            <button><img src="img/_src/close.svg" alt=""></button>-->
<!--        </div>-->
<!--    </div>-->
    <!--cookie-->

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
