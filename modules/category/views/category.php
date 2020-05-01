<?php

use app\components\helpers\Text;
use app\modules\file\components\Img;
use app\modules\product\Module;

$this->params['breadcrumbs'][] = ['label' => 'Продукция', 'url' => ['/products']];
?>
<div class="morph-wrap">
    <svg class="morph" width="1400" height="770" viewBox="0 0 1400 770" style="transform: scaleX(1.2) scaleY(1) translateX(0) translateY(-60px) rotate(0deg);">
        <path d="M 262.9,252.2 C 210.1,338.2 252.3250109428572,430.5975543142856 295.1481483714286,531.7142031142856 340.4592581428571,635.0732725428571 511.2,530.4962967428572 620.3,548.9962967428572 750.6,571.0962967428571 868.0879346,712.7906067428571 987.3,686.5 1097.5078277142857,662.7319207714286 1200.7224142857144,543.2732725428572 1173,429.2 1145.2775857142856,311.6712103142857 1096,189.1 995.1,130.7 852.1,47.07 658.8,78.95 498.1,119.2 410.7,141.1 322.6,154.8 262.9,252.2 Z" style="fill: #f1ebfc;"></path>
    </svg>
</div>
<div class="product_inside-page">
<div class="production-container width-block">
    <div class="article">
        <h1><?= $category->title ?><?= Text::_edit($category->id, 'category') ?></h1>
        <p><?= $category->body ?></p>
    </div>
    <div class="inside-product_container">
        <?php if ($category->products) { ?>
	        <?php foreach ($category->products as $item) { ?>
                <div class="inside-items">
                    <div class="items-left">
                        <?php if ($item->thumb) { ?>
                            <img src="<?= Img::_(Module::getInstance()->imagesDirectory, $item->id, '600x570', $item->thumb->filename) ?>" alt="">
                        <?php } ?>
                    </div>
                    <div class="items-right">
	                    <?= Text::_edit($item->id, 'product') ?>
                        <h3><?= $item->title ?></h3>
                        <div class="duties"><?= $item->body ?></div>
                    </div>
                </div>
	        <?php } ?>
        <?php } ?>
    </div>
    <div class="page-transition">
        <a href="/products" class="link-prev">Назад к продукции</a>
        <?php if ($category->getNextCategory()) { ?>
            <a href="/category/<?= $category->getNextCategory()->alias ?>" class="link-next">Далее - «<?= $category->getNextCategory()->title ?>»</a>
        <?php } ?>
    </div>
</div>
</div>