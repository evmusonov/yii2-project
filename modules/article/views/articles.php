<?php
use app\components\helpers\Text;
use app\modules\article\Module;
use app\modules\file\components\Img;
use app\modules\page\models\Page;
use yii\widgets\LinkPager;

$page = null;
if (Page::getContent()) {
    $page = Page::getContent();
}
?>
<?php if ($page->show_spot) { ?>
    <div class="morph-wrap">
        <svg class="morph" width="1400" height="770" viewBox="0 0 1400 770" style="transform: scaleX(1.2) scaleY(1) translateX(0) translateY(-60px) rotate(0deg);">
            <path d="M 262.9,252.2 C 210.1,338.2 252.3250109428572,430.5975543142856 295.1481483714286,531.7142031142856 340.4592581428571,635.0732725428571 511.2,530.4962967428572 620.3,548.9962967428572 750.6,571.0962967428571 868.0879346,712.7906067428571 987.3,686.5 1097.5078277142857,662.7319207714286 1200.7224142857144,543.2732725428572 1173,429.2 1145.2775857142856,311.6712103142857 1096,189.1 995.1,130.7 852.1,47.07 658.8,78.95 498.1,119.2 410.7,141.1 322.6,154.8 262.9,252.2 Z" style="fill: #<?= $page->spot_color ?>;"></path>
        </svg>
    </div>
<?php } ?>
<div class="article-page">
<div class="articles">
    <div class="articles-container width-block">
        <div class="article">
            <h1><?= $page->title ?><?= Text::_edit($page->id, 'page') ?></h1>
            <ul class="articles-content">
                <?php if ($articles) { ?>
	                <?php foreach ($articles as $item) { ?>
                        <li class="articles-items">
                            <a href="/articles/<?= $item->alias ?>">
                                <div class="img-wrapper_2">
                                    <?php if ($item->thumb) { ?>
                                        <img src="<?= Img::_(Module::getInstance()->imagesDirectory, $item->id, '314x250', $item->thumb->filename) ?>" alt="">
                                    <?php } ?>
                                    <div class="img-mask">читать</div>
                                </div>
	                            <?= Text::_edit($item->id, 'article') ?>
                                <div class="slider-article">
                                    <span><?= Text::prettyDate($item->created_at) ?></span>
                                    <h3><?= $item->title ?></h3>
                                </div>
                            </a>
                        </li>
	                <?php } ?>
                <?php } ?>
            </ul>
	        <?= LinkPager::widget([
		        'pagination' => $pages,
                'prevPageLabel' => '',
                'prevPageCssClass' => 'pag-prev',
		        'nextPageLabel' => '',
		        'nextPageCssClass' => 'pag-next'

	        ]); ?>
        </div>
    </div>
</div>
</div>