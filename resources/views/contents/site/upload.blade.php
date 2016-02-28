<?php
zbase_view_head_meta_add('_token', zbase_csrf_token());
?>
<div class="row">
	<div class="col-md-6">
		<form method="post" action="<?php echo zbase_url_from_route('siteImageUpload') ?>" enctype="multipart/form-data">
			<?php echo zbase_csrf_token_field(); ?>
			<div class="form-group">
				<label for="imageUpload">Upload Image</label>
				<input type="file" name="file" id="imageUpload">
			</div>
			<button type="submit" class="btn btn-default">Upload</button>
		</form>
	</div>
	<div class="col-md-6">
		<?php if(!empty($image)): ?>
			<hr />
			<?php
			$fontMaps = zbase_config_get('zivsluck.fontmaps');
			$dataCustomize = [];
			?>
			<div class="form-group"  id="form-group-font">
				<label for="font">Font</label>
				<?php if(!empty($fontMaps)): ?>
					<select name="font" id="font" class="form-control">
						<option value="">Select Font</option>
						<?php foreach ($fontMaps as $fontName => $fontDetails): ?>
							<?php if(!empty($fontDetails['enable'])): ?>
								<option <?php echo $image->font() == $fontName ? ' selected="selected"' : ''?> value="<?php echo $fontName ?>"><?php echo $fontDetails['name'] ?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>
			</div>

			<div class="form-group"  id="form-group-material">
				<label for="material">Material</label>
				<select name="material" id="material" class="form-control">
					<option value="">Select Material</option>
					<option value="stainless" <?php echo $image->material() == 'stainless' ? ' selected="selected"' : ''?>>Stainless</option>
					<option value="silver" <?php echo $image->material() == 'silver' ? ' selected="selected"' : ''?>>Silver</option>
					<option value="goldplated" <?php echo $image->material() == 'goldplated' ? ' selected="selected"' : ''?>>Gold Plated</option>
				</select>
			</div>

<!--			<div class="form-group"  id="form-group-tags">
				<label for="name">Tags</label>
				<textarea class="form-control" rows="5" id="tags" value="Tags" name="tags" placeholder="Tags"><?php echo $image->tags()?></textarea>
			</div>-->
			<button id="btnSaveTags" class="btn btn-success">Save</button>
			<button id="btnDownload" class="btn btn-info">Download</button>
			<hr />
			<img class="img-shadow img-responsive" src="<?php echo $image->src() ?>.png" alt="" />
		<?php endif; ?>
	</div>
</div>
<br />
<br />
@section('body_bottom')
<?php if(!empty($image)): ?>
	<script type="text/javascript">
		jQuery(document).ready(function () {
			jQuery('#btnSaveTags').click(function () {
				var data = {'font': jQuery('#font').val(), 'material': jQuery('#material').val(), 'image': '<?php echo $image->name() ?>'};
				$.ajax({
					type: 'post',
					url: '<?php echo zbase_url_from_route('siteImageUpload') ?>',
					data: data,
					beforeSend: function () {
						jQuery('#btnSaveTags').text('Saving...').removeClass('btn-success').addClass('btn-default').attr('disabled', true);
					},
					success: function () {
						jQuery('#btnSaveTags').text('Save').removeClass('btn-default').addClass('btn-success').attr('disabled',false);
					}
				});
			});
			jQuery('#btnDownload').click(function () {
				window.location = '<?php echo $image->src() ?>?d=1';
			});
		});
	</script>
<?php endif; ?>
@append