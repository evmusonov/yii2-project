<?php

use yii\helpers\Html;
use app\modules\article\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;
use yii\widgets\Breadcrumbs;


$this->params['page_class'] = 'article';
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
?>
<div class="articles-inside_page">
<div class="articles-container width-block">

    <div class="block-articles_1">
	    <?= Text::_edit($article->id, 'article') ?>
        <div class="articles-img">
            <?php if ($article->thumb) { ?>
                <img src="<?= Img::_(Module::getInstance()->imagesDirectory, $article->id, '900x493', $article->thumb->filename) ?>" alt="">
            <?php } ?>
        </div>
        <div class="articles-social">
            <p>Опубликовано:</p>
            <span><?= Text::prettyDate($article->created_at, 0) ?></span>
            <p>Время чтения:</p>
            <span><?= $article->readtime ?></span>
            <p>Поделиться:</p>
            <?= $this->render('@app/modules/main/views/social', ['url' => $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']]) ?>
        </div>
    </div>
    <div class="article">
        <h2><?= Html::encode($article->title) ?></h2>
        <div class="duties">
            <div class="img-wrapper3">
	        <?= $article->body ?>
	        </div>
        </div>
        <div class="page-transition">
            <a href="/articles" class="link-prev">Назад в «Статьи»</a>
            <?php if ($article->getNextArticle()) { ?>
                <a href="/articles/<?= $article->getNextArticle()->alias ?>" class="link-next">Далее: «<?= $article->getNextArticle()->title ?>»</a>
            <?php } ?>
        </div>
    </div>
</div>
</div>