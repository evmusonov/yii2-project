<?php

use app\components\helpers\Text;
use app\modules\file\components\Img;
use app\modules\slider\Module;

/* @var $slider Module */
?>
<div class="slider_block">
    <div class="slider">
        <?php foreach($slider as $index => $item) { ?>
            <div class="cell <?= $index == 0 ? 'slide_yes' : '' ?>">
                <div style="background-image: url(<?= Img::_(Module::getInstance()->imagesDirectory, $item->id, '1920x865', $item->thumb->filename) ?>);">
                    <div class="container_block">
                        <div class="article">
	                        <?= Text::_edit($item->id, 'slider') ?>
                            <h1><?= $item->title ?></h1>
                            <p><?= $item->sub_title ?></p>
                        </div>
                    </div>
                </div>
                <div style="background: rgb(67,87,160);"></div>
            </div>
        <?php } ?>
    </div>
    <div class="nav-slider">
        <div class="counter">
            <div class="counter__item js-current">0</div>
            <div class="counter__item js-total">0</div>
        </div>
        <button class="next"></button>
    </div>
</div>