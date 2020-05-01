<?php

use app\components\helpers\Text;

/* @var $articles app\modules\category\models\Category */
?>
<div class="vacancy-block">
    <?php if ($vacancy) { ?>
	    <?php foreach ($vacancy as $item) { ?>
            <div class="slider-article">
                <span><?= Text::prettyDate($item->created_at) ?></span>
                <h3><a href="/vacancy/<?= $item->alias ?>"><?= $item->title ?></a><?= Text::_edit($item->id, 'vacancy') ?></h3>
            </div>
	    <?php } ?>
    <?php } ?>
    <a href="/vacancies" class="link-tab vacancy-arrows">Все вакансии</a>
</div>