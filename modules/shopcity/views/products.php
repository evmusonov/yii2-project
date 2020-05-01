<?php
use app\components\helpers\Text;
use app\modules\category\Module;
use app\modules\category\components\BlockCategory;
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
<div class="product-page">
<div class="production-block">
    <div class="production-container width-block">
        <div class="article">
            <h1><?= $page->title ?><?= Text::_edit($page->id, 'page') ?></h1>
            <p><?= $page->teaser ?></p>
            <div class="product">
				<?php if ($category) { ?>
					<?php foreach ($category as $item) { ?>
                        <div class="product-item">
	                        <?= Text::_edit($item->id, 'category') ?>
                            <a href="/category/<?= $item->alias ?>">
                                <?php if ($item->thumb) { ?>
                                    <img src="<?= Img::_(Module::getInstance()->imagesDirectory, $item->id, '250x380', $item->thumb->filename) ?>" alt="<?= $item->title ?>">
                                <?php } ?>
                                <span><?= $item->title ?></span>
                                <span>Смотреть <img src="img/_src/arrow_3.svg" alt=""></span>
                            </a>
                        </div>
					<?php } ?>
				<?php } ?>
            </div>
        </div>
    </div>
</div>
</div>