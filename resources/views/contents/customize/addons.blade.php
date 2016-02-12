<div id="addonsForm" style="display: none;">
	<h2>Addons</h2>
	<p>Drag symbol to the box with your name.</p>
	<span class="help-block">Maximum of 7 letters and symbols. Additional letters and symbols at Php 20.00 each.</span>
	<div id="addonsWrapper">
		<?php
		$addons = zbase_config_get('zivsluck.addons', []);
		if(!empty($addons))
		{
			foreach ($addons as $name => $addon)
			{
				?>
				<?php if(!empty($addon['enable'])): ?>
					<div class="addon">
						<img data-sameonly="<?php echo (!empty($addon['sameonly']) ? 1 : 0) ?>" data-allowed="<?php echo (!empty($addon['allowed']) ? $addon['allowed'] : 1) ?>" class="draggable enable addon-<?php echo $name ?>" data-name="<?php echo $name ?>" src="/zbase/assets/zivsluck/img/addons/<?php echo $addon['file'] ?>" alt="<?php echo $addon['name'] ?>">
					</div>
					<?php if(!empty($addon['allowed'])): ?>
						<?php for ($x = 0; $x < ($addon['allowed'] - 1); $x++): ?>
							<div class="addon">
								<img data-sameonly="<?php echo (!empty($addon['sameonly']) ? 1 : 0) ?>" data-allowed="<?php echo (!empty($addon['allowed']) ? $addon['allowed'] : 1) ?>" class="draggable enable addon-<?php echo $name ?>" data-name="<?php echo $name ?>" src="/zbase/assets/zivsluck/img/addons/<?php echo $addon['file'] ?>" alt="<?php echo $addon['name'] ?>">
							</div>
						<?php endfor; ?>
					<?php endif; ?>
				<?php endif; ?>
				<?php
			}
		}
		?>
	</div>
</div>
@section('head_bottom')
<style type="text/css">
	#droppableWrapper{
		position: relative;
		height: 0px;
	}
	#droppableWindow{
		border: 0px solid black !important;
		position: absolute;
		height: <?php echo zbase_config_get('zivsluck.addons.configuration.droppable.height') ?>px;
		width: <?php echo zbase_config_get('zivsluck.addons.configuration.droppable.width') ?>px;
		top: <?php echo zbase_config_get('zivsluck.addons.configuration.droppable.top') ?>px;
		left: <?php echo zbase_config_get('zivsluck.addons.configuration.droppable.left') ?>px;
	}
</style>
@append
@section('body_bottom')
<script type="text/javascript">

	function zivsluck_addOns()
	{
		jQuery('#customizeForm').hide();
		jQuery('#showCustom').hide();
		jQuery('#addonsForm').show();
		jQuery('#btnAddons').hide();
		jQuery('#step').val(2);
		jQuery('#droppableWindow').css('border', '1px solid black');
		var htmlButtons = '<button onclick="zivsluck_addOnsBack();" id="btnAddOnsBack" class="btn btn-default">Back</button>';
		htmlButtons += '<br /><br /><br /><button onclick="zivsluck_shippingProcess();" id="btnCheckoutNecklace" class="btn btn-success">Checkout this Necklace</button>';
		jQuery('#submitButtons').html(htmlButtons);
	}
	function zivsluck_addOnsBack()
	{
		jQuery('#addonsForm').hide();
		jQuery('#customizeForm').show();
		jQuery('#showCustom').show();
		jQuery('#step').val(1);
		jQuery('#btnCheckoutNecklace').hide();
		jQuery('#droppableWindow').css('border', '0px solid black');
		zivsluck_load();
	}
	function zivsluck_addOnsInit()
	{
		var unlimitedAddons = true;

		$("#droppableWindow").droppable({
			accept: ".draggable.enable",
			drop: function (event, ui) {
				jQuery('#droppableWindow').css('backgroundColor', 'rgba(255,255,255,0)');
				var item = ui.helper;
				// item.addClass("tempclass");
				// $(this).append(item);
				var sameAddonOnly = parseInt(item.attr('data-sameonly'));
				var newPosX = ui.offset.left - $(this).offset().left;
				var newPosY = ui.offset.top - $(this).offset().top;
				item.attr('data-position', newPosX + ',' + newPosY);
				item.addClass('selected enable');
				if (unlimitedAddons === false)
				{
					var addonName = item.attr('data-name');
					var allowedAddon = item.attr('data-allowed');
					var addon = jQuery('.draggable.addon-' + addonName + '.selected');
					jQuery('.draggable').not(item).hide();
					if (sameAddonOnly === 1)
					{
						jQuery('.draggable.addon-' + addonName).show();
					}
				}
			},
			out: function (event, ui) {
				if (unlimitedAddons === false) {
					jQuery('.draggable').show();
				}
			}
		});
		$("#addonsForm").droppable({
			accept: ".draggable",
			drop: function (event, ui) {
				ui.helper.attr('data-position', false);
				ui.helper.removeClass('selected');
				jQuery('#droppableWindow').css('backgroundColor', 'rgba(255,255,255,0)');
			}
		});
		$('.draggable').draggable({
			revert: "invalid",
			drag: function (event, ui) {
				jQuery('#droppableWindow').css('backgroundColor', 'rgba(255,255,255,0.6)');
			}
		});
		var htmlButtons = '<button onclick="zivsluck_addOns();" id="btnAddons" class="btn btn-success">Next, Addons</button>';
		jQuery('#submitButtons').html(htmlButtons);
	}
	jQuery(document).ready(function () {
	});
</script>
@append