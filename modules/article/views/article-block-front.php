<?php

use app\components\helpers\Text;
use app\modules\article\Module;
use app\modules\infoblock\components\BlockText;
use app\components\helpers\Img;

/* @var $articles app\modules\article\models\Article */
?>
<?php if ($articles): ?>
    <div class="articles-block">
        <div class="articles-container width-block">
            <div class="article">
                <h1>
                    <?= strip_tags(BlockText::_('text','article_title')) ?>
                    <?= Text::_edit(BlockText::_getId('article_title'), 'infoblock') ?>
                </h1>
                <div class="production-slider">
                    <div class="slider-content">
                        <div class="block-slides_article">
                            <?php foreach ($articles as $item) { ?>
                                <div class="articles-items">
                                    <a href="/articles/<?= $item->alias ?>">
                                        <div class="img-wrapper">
                                            <?php if ($item->thumb) { ?>
                                                <img src="<?= Img::_(Module::getInstance()->imagesDirectory, $item->id, '314x250', $item->thumb->filename) ?>" alt="">
                                            <?php } ?>
                                            <div class="img-mask">читать</div>
                                        </div>
                                        <div class="slider-article">
                                            <span><?= Text::prettyDate($item->created_at) ?></span>
                                            <h3><?= $item->title ?></h3>
                                        </div>
                                    </a>
	                                <?= Text::_edit($item->id, 'article') ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="arrows-articles">
                            <button class="prev-slider"></button>
                            <button class="next-slider"></button>
                        </div>
                    </div>
                    <div class="arrow_link">
                        <a href="/articles" class="link-tab">Все статьи</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>