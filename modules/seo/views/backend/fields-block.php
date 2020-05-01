<div class="row">
	<div class="col-xs-12 col-md-12">
		<label><?= $blockTitle ?></label>
		<div class="form-group">
			<label class="control-label">Meta Title</label>
			<input type="text" class="form-control" name="Seo[meta_title]" value="<?= $data['meta_title'] ?>">
		</div>
		<div class="form-group">
			<label class="control-label">Meta Keywords</label>
			<textarea class="form-control" name="Seo[meta_key]" rows="6"><?= $data['meta_key'] ?></textarea>
		</div>
		<div class="form-group">
			<label class="control-label">Meta Description</label>
			<textarea class="form-control" name="Seo[meta_desc]" rows="6"><?= $data['meta_desc'] ?></textarea>
		</div>
	</div>
</div>