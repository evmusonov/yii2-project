<?php

use yii\widgets\ActiveForm;
use app\modules\file\components\Img;

?>
<div class="row">
    <div class="col-sm-12">
        <label><?= $blockTitle ?></label>
    </div>
</div>
<div class="row">
    <?php if($model->{$link} AND !empty($model->{$link})):?>
        <?php foreach($model->{$link} as $file):?>
            <div class="gall-image-item col-sm-4" id="<?= $moduleImageDir ?>_<?= $model->id ?>_<?= $file->id ?>_imageblock">
                <div class="gall-item">
                    <a onclick="deleteImage('<?= $moduleImageDir ?>', '<?= $model->id ?>', '<?= $file->filename ?>', '<?= $file->id ?>');" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Удалить это изображение">
                        <span class="close-img-button"><img src="/img/close.png"></span>
                        <img src="<?= Img::_($moduleImageDir, $model->id, $size, $file->filename) ?>">
                    </a>

                    <div class="form-group form-group-mini">
                        <label>Заголовок</label>
                        <input type="text" class="form-control" name="<?= $attrName ?>[<?= $file->id ?>][title]" value="<?= $file->title ?>">
                    </div>
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group form-group-mini">
                                <label>Описание картинки</label>
                                <input type="text" class="form-control" name="<?= $attrName ?>[<?= $file->id ?>][alt]" value="<?= $file->alt ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-mini">
                                <label>Вес</label>
                                <input type="text" class="form-control" name="<?= $attrName ?>[<?= $file->id ?>][delta]" value="<?= $file->delta ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="row">
    <div class="col-sm-12 mt-3">
		<?= $form->field($model, $formName, ['options' => ['class' => 'input-file-block-gallery']])->fileInput(['multiple' => true, 'accept' => 'image/*', 'class' => 'input-file-gallery'])->label(false) ?>
        <div class="input-file-search-gallery">Выберите файл</div>
        <input class="input-file-fake-gallery" type="text" value="" disabled />
    </div>
</div>