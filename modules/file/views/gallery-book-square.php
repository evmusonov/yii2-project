<?php
use app\components\helpers\Img;
?>

<?php if($content->files):?>
	<div class='book'>
		<div id='js-book-square'>
			<?php foreach($content->files as $file):?>
				<div class='book__page'>
					<img src="<?= Img::_($module, $content->id, 'vertical-large', $file->filename) ?>" alt="<?= $file->alt ?>">
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>