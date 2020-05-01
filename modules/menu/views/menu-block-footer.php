<?php
use yii\helpers\Html;

/* @var $menu \app\modules\menu\models\Menu */
?>
<?php if ($menu): ?>
    <ul class="list-left">
	    <?php for($i = 0; $i < count($menu) / 2; $i++): ?>
            <li><a href="<?= $menu[$i]->url ?>"><?= $menu[$i]->title ?></a></li>
	    <?php endfor; ?>
    </ul>
    <ul class="list-right">
        <li><a href="/vacancies">Вакансии</a></li>
	    <?php for($i = count($menu) / 2 + 1; $i < count($menu); $i++): ?>
            <li><a href="<?= $menu[$i]->url ?>"><?= $menu[$i]->title ?></a></li>
	    <?php endfor; ?>
    </ul>
<?php endif; ?>