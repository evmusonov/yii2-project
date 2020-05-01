<?php

use app\components\helpers\Text;
use app\modules\file\components\Img;
use app\modules\infoblock\components\BlockText;
use app\modules\minislider\Module;

/* @var $minislider app\modules\minislider\models\MiniSlider */
?>
<div class="production-block_3">
    <div class="production3-container width-block">
        <div class="article">
            <h1>
                <?= strip_tags(BlockText::_('text','production_title')) ?>
                <?= Text::_edit(BlockText::_getId('production_title'), 'infoblock') ?>
            </h1>
            <div class="production-slider">
                <div class="slider-content">
                    <div class="counter-slick">
                        <div class="counter-block_1">
                            <div class="counter__item js-current">0</div>
                        </div>
                        <div class="counter-block_2">
                            <div class="counter__item js-total">0</div>
                        </div>
                    </div>
                    <div class="block-slides">
                        <?php if ($minislider) { ?>
	                        <?php foreach ($minislider as $item) { ?>
                                <div class="production-items">
                                <div class="img-wrapper_3">
                                    <?php if ($item->thumb) { ?>
                                        <img src="<?= Img::_(Module::getInstance()->imagesDirectory, $item->id, '600x381', $item->thumb->filename) ?>" alt="">
                                    <?php } ?>
                                 </div>
                                    <div class="slick-article">
                                        <h3><?= $item->title ?><?= Text::_edit($item->id, 'minislider') ?></h3>
                                        <p><?= $item->sub_title ?></p>
                                    </div>
                                </div>
	                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="arrows-slick">
                        <button class="prev-slick"></button>
                        <button class="next-slick active"></button>
                    </div>
                </div>
                <div class="arrow_link">
                    <a href="/company" class="link-tab">О компании</a>
                </div>
            </div>
        </div>
    </div>
</div>