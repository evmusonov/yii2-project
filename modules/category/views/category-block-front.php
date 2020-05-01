<?php

use app\components\helpers\Text;
use app\modules\category\Module;
use app\modules\file\components\Img;
use app\modules\infoblock\components\BlockText;

/* @var $articles app\modules\category\models\Category */
?>
<div class="production-block">
    <div class="production-container width-block">
        <div class="article">
            <h1>
                <?= strip_tags(BlockText::_('text','product_title')) ?>
                <?= Text::_edit(BlockText::_getId('product_title'), 'infoblock') ?>
            </h1>
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