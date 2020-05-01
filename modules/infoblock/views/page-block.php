<?php
use yii\helpers\Html;
use app\components\helpers\Text;
?>
<?php if ($block && !empty($block->body)): ?>
	<div style="position:relative">	
		<?= Text::_edit($block->id, 'infoblock') ?>
		<?php if ($titleBlock && !empty($titleBlock)): ?>
			<h2 class="h h_primary">
				<span class="h__text"><?= Html::encode($titleBlock) ?></span>
			</h2>
		<?php endif; ?>
		<?= $block->body ?>
	</div>
<?php endif; ?>