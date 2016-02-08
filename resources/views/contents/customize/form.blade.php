<?php
$fontMaps = zbase_config_get('zivsluck.fontmaps');
?>
<div class="row createForm" style="border-bottom: 2px solid #EBEBEB;padding-bottom:20px;">
	<div class="col-md-4">
		<a href="/customize" class="logo">ZivsLuck</a>
	</div>
	<div class="col-md-8">
		<form>
			<h1>Create your own necklace!</h1>
			<div class="form-group">
				<label for="name">Type the name to view your name on any font</label>
				<input type="text" required="required" class="form-control" id="name" name="name" placeholder="Type your name">
			</div>
			<div class="form-group">
				<label for="font">Font</label>
				<?php if(!empty($fontMaps)): ?>
					<select name="font" id="font" class="form-control">
						<option value="all">All</option>
						<?php foreach ($fontMaps as $fontName => $fontDetails): ?>
							<?php if(!empty($fontDetails['enable'])): ?>
								<option value="<?php echo $fontName ?>"><?php echo $fontDetails['name'] ?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>
			</div>
			<div>
				<p>The name preview is only to view how your name looks in the font of the necklace that you have chosen.</p>
			</div>
			<button id="btnCustomize" class="btn btn-default">Customize</button>
		</form>
	</div>
</div>
<div id="showCustom" style="padding-top: 20px;overflow:auto;"></div>
@section('body_bottom')
<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery('#btnCustomize').click(function (e) {
			e.preventDefault();
			var text = jQuery('#name').val();
			if (text == '')
			{
				jQuery('#name').closest('.form-group').addClass('has-error');
				return;
			}
			var font = jQuery('#font').val();
			$.ajax({
				url: '<?php echo zbase_url_from_route('create') ?>/' + text + '/' + font,
				beforeSend: function () {
					jQuery('#showCustom').html('<p class="bg-info" style="padding:20px;">Loading...</p>');
				},
				success: function (data) {
					jQuery('#showCustom').html(data);
				}}
			);

		});
	});
</script>
@append