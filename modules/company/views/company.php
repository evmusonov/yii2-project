<?php

use app\components\helpers\Text;
use app\modules\file\components\Img;
use app\modules\infoblock\components\BlockText;
use app\modules\infoblock\Module;
use app\modules\client\Module as ModuleClient;
use app\modules\page\models\Page;
use app\modules\vacancy\components\BlockVacancy;

$page = null;
if (Page::getContent()) {
	$page = Page::getContent();
}

$this->params['breadcrumbs'][] = ['label' => 'О компании', 'url' => ['/company']];
?>
<?php if ($page->show_spot) { ?>
    <div class="morph-wrap">
        <svg class="morph" width="1400" height="770" viewBox="0 0 1400 770" style="transform: scaleX(1.2) scaleY(1) translateX(0) translateY(-60px) rotate(0deg);">
            <path d="M 262.9,252.2 C 210.1,338.2 252.3250109428572,430.5975543142856 295.1481483714286,531.7142031142856 340.4592581428571,635.0732725428571 511.2,530.4962967428572 620.3,548.9962967428572 750.6,571.0962967428571 868.0879346,712.7906067428571 987.3,686.5 1097.5078277142857,662.7319207714286 1200.7224142857144,543.2732725428572 1173,429.2 1145.2775857142856,311.6712103142857 1096,189.1 995.1,130.7 852.1,47.07 658.8,78.95 498.1,119.2 410.7,141.1 322.6,154.8 262.9,252.2 Z" style="fill: #<?= $page->spot_color ?>;"></path>
        </svg>
    </div>
<?php } ?>
<div class="company_page">
<div class="company-container width-block">
    <div class="article">
        <h1><?= $page->title ?><?= Text::_edit($page->id, 'page') ?></h1>
        <p><?= $page->teaser ?></p>
    </div>
    <div class="company-block">
        <div class="company-items">
            <div class="company-head bg_1">
                <h3>
                    <?= strip_tags(BlockText::_('text','production_company_title')) ?>
                    <?= Text::_edit(BlockText::_getId('production_company_title'), 'infoblock') ?>
                </h3>
            </div>
            <div class="company-content">
                <div class="content-block">
                    <?php if (BlockText::_('img','production_company_img')) { ?>
	                    <?= Text::_edit(BlockText::_getId('production_company_img'), 'infoblock') ?>
	                    <?php foreach (BlockText::_('img','production_company_img') as $img) { ?>
                            <img src="<?= Img::_(Module::getInstance()->imagesDirectory, $img->content_id, '902x494', $img->filename) ?>">
	                    <?php } ?>
                    <?php } ?>
	                <?= Text::_edit(BlockText::_getId('production_company_text'), 'infoblock') ?>
                    <p><?= strip_tags(BlockText::_('text','production_company_text')) ?></p>
                </div>
            </div>
        </div>
        <div class="company-items">
            <div class="company-head bg_2">
                <h3>
                    <?= strip_tags(BlockText::_('text','team_company_title')) ?>
                    <?= Text::_edit(BlockText::_getId('team_company_title'), 'infoblock') ?>
                </h3>
            </div>
            <div class="company-content">
                <div class="content-block two-block">
	                <?= Text::_edit(BlockText::_getId('team_company_text'), 'infoblock') ?>
                    <p><?= strip_tags(BlockText::_('text','team_company_text')) ?></p>
	                <?php if (BlockText::_('img','team_company_img')) { ?>
		                <?= Text::_edit(BlockText::_getId('team_company_img'), 'infoblock') ?>
		                <?php foreach (BlockText::_('img','team_company_img') as $img) { ?>
                            <img src="<?= Img::_(Module::getInstance()->imagesDirectory, $img->content_id, '902x494', $img->filename) ?>">
		                <?php } ?>
	                <?php } ?>
                </div>
            </div>
        </div>
        <div class="company-items">
            <div class="company-head bg_3">
                <h3>
                    <?= strip_tags(BlockText::_('text','partner_company_title')) ?>
                    <?= Text::_edit(BlockText::_getId('partner_company_title'), 'infoblock') ?>
                </h3>
            </div>
            <div class="company-content">
                <div class="content-block">
                    <?php if ($partners) { ?>
	                    <?php foreach ($partners as $item) { ?>
                            <div class="partners">
	                            <?= Text::_edit($item->id, 'client') ?>
                                <?php if ($item->thumb) { ?>
                                    <img src="<?= Img::_(ModuleClient::getInstance()->imagesDirectory, $item->id, '200x150', $item->thumb->filename) ?>" alt="">
                                <?php } ?>
                                <a href="<?= $item->alias ?>"><?= $item->title ?></a>
                            </div>
	                    <?php } ?>
                    <?php } ?>


                    <div class="visible-slider">
                        <div class="company-awards">
                            <div class="company-slider_item">
                                <img src="img/_src/image%202.png" alt="">
                            </div>
                            <div class="company-slider_item">
                                <img src="img/_src/image%203.png" alt="">
                            </div>
                            <div class="company-slider_item">
                                <img src="img/_src/image%204.png" alt="">
                            </div>
                            <div class="company-slider_item">
                                <img src="img/_src/image%203.png" alt="">
                            </div>
                        </div>
                        <div class="arrows-slick awards">
                            <button class="prev-slick"></button>
                            <button class="next-slick active"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="company-items">
            <div class="company-head bg_4">
                <h3>
                    <?= strip_tags(BlockText::_('text','award_company_title')) ?>
                    <?= Text::_edit(BlockText::_getId('award_company_title'), 'infoblock') ?>
                </h3>
            </div>
            <div class="company-content">
                <div class="content-block">
                    <div class="company-slider">
	                    <?php if (BlockText::_('img','award_company_img')) { ?>
		                    <?= Text::_edit(BlockText::_getId('award_company_img'), 'infoblock') ?>
		                    <?php foreach (BlockText::_('img','award_company_img') as $img) { ?>
                                <div class="company-slider_item">
                                    <img src="<?= Img::_(Module::getInstance()->imagesDirectory, $img->content_id, '200x299', $img->filename) ?>">
                                </div>
                            <?php } ?>
	                    <?php } ?>
                    </div>
                    <div class="arrows-company arrows-articles">
                        <button class="prev-slider"></button>
                        <button class="next-slider"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="company-items four-block">
            <div class="company-head bg_5">
                <h3>
                    <?= strip_tags(BlockText::_('text','shop_company_title')) ?>
                    <?= Text::_edit(BlockText::_getId('shop_company_title'), 'infoblock') ?>
                </h3>
            </div>
            <div class="company-content ">
                <div class="content-block">
                    <span>
                        <?= strip_tags(BlockText::_('text','shop_company_shopcount')) ?>
                        <?= Text::_edit(BlockText::_getId('shop_company_shopcount'), 'infoblock') ?>
                    </span>
                    <p class="address-col">
                        <?= strip_tags(BlockText::_('text','shop_company_text')) ?>
                        <?= Text::_edit(BlockText::_getId('shop_company_text'), 'infoblock') ?>
                    </p>
                    <a href="/shops" class="link-tab">Смотреть адреса</a>
                </div>
            </div>
        </div>
        <div class="company-items five-block">
            <div class="company-head bg_6">
                <h3>
                    <?= strip_tags(BlockText::_('text','vacancy_company_title')) ?>
                    <?= Text::_edit(BlockText::_getId('vacancy_company_title'), 'infoblock') ?>
                </h3>
            </div>
            <div class="company-content four-block">
                <div class="content-block">
                    <?= BlockVacancy::front() ?>
                </div>
            </div>
        </div>
    </div>
    <div class="page-transition">
        <a href="/products" class="link-prev">Продукция</a>
        <a href="/articles" class="link-next">Статьи</a>
    </div>
</div>
</div>