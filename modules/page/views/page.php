<?php

use yii\helpers\Html;
use app\components\helpers\Text;
use app\modules\main\components\BlockForm;
use app\modules\client\components\BlockClient;
use app\modules\team\components\BlockTeam;
use app\modules\page\Module;
use app\modules\file\components\Img;

$this->params['page_class'] = 'article';
?>
<?= Text::_edit($page->id, 'page') ?>

<div class="articles-container width-block">
    <div class="article">
        <h2><?= $page->title ?></h2>
        <div class="duties">
	        <?= $page->teaser ?>
        </div>
    </div>
</div>