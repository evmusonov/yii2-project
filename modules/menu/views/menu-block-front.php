<?php
use yii\helpers\Html;

$pathArr = explode('/', Yii::$app->getRequest()->getPathInfo());
				
?>
<?php if ($menu): ?>
	<?php foreach($menu as $key => $item): ?>
		<?php $urlArr = explode('/', $item->url); ?>
		<li class="<?php if(isset($urlArr[1]) && $pathArr[0] == $urlArr[1]): ?>active<?php endif; ?>">
			<a <?= $menuClass ? 'class="menu__item"' : '' ?> href="<?= $item->url ?>"><?= mb_strtolower($item->title) ?></a>
		</li>
	<?php endforeach; ?>
<?php endif; ?>