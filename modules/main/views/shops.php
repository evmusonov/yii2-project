<?php
use app\modules\infoblock\components\BlockText;
use app\modules\portfolio\components\BlockPortfolio;
use app\components\helpers\Text;
use mirocow\yandexmaps\Canvas;

?>

<?= Canvas::widget([
	'htmlOptions' => [
		'style' => 'height: 400px;',
	],
	'map' => $map,
]);
?>
