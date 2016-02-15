<div id="addonsForm" style="display: none;">
	<h2>Addons</h2>
	<p>
		Drag symbols to the box with your name.
		<br />Maximum of 7 letters and symbols. Additional letters and symbols at Php 20.00 each.
		<br />You can resize and reposition symbols anywhere as long as each symbols and letters touches each other.
		<br />Click on the selected symbols and use the controls to resize and position.
		<br />You can move the controls to anywhere you want on the screen.
	</p>
	<div class="row">
		<div id="addonsWrapper" class="col-md-12">
			<?php
			$addons = zbase_config_get('zivsluck.addons', []);
			if(!empty($addons))
			{
				foreach ($addons as $name => $addon)
				{
					?>
					<?php if(!empty($addon['enable'])): ?>
						<?php
						$addonHeight = !empty($addon['displayHeight']) ? $addon['displayHeight'] : 32;
						$addonWidth = !empty($addon['displayWidth']) ? $addon['displayWidth'] : 32;
						?>
						<div class="addon col-md-1 col-xs-3 thumbnail addon-thumbnail addon-thumbnail-<?php echo $name ?>">
							<img style="width:<?php echo $addonWidth ?>px;height:<?php echo $addonHeight ?>px;" data-width="<?php echo $addonWidth ?>" data-height="<?php echo $addonHeight ?>" data-sameonly="<?php echo (!empty($addon['sameonly']) ? 1 : 0) ?>" data-allowed="<?php echo (!empty($addon['allowed']) ? $addon['allowed'] : 1) ?>" class="draggable enable addon-<?php echo $name ?>" data-name="<?php echo $name ?>" src="/zbase/assets/zivsluck/img/addons/<?php echo $addon['file'] ?>" alt="<?php echo $addon['name'] ?>">
						</div>
					<?php endif; ?>
					<?php
				}
			}
			?>
		</div>
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
	#droppableWindow img{
		box-shadow: none;
		padding:0px;
	}
</style>
@append
@section('body_bottom')
<script type="text/javascript">
	/*!
	 * jQuery UI Touch Punch 0.2.3
	 *
	 * Copyright 2011–2014, Dave Furfero
	 * Dual licensed under the MIT or GPL Version 2 licenses.
	 *
	 * Depends:
	 *  jquery.ui.widget.js
	 *  jquery.ui.mouse.js
	 */
	!function(a){function f(a, b){if (!(a.originalEvent.touches.length > 1)){a.preventDefault(); var c = a.originalEvent.changedTouches[0], d = document.createEvent("MouseEvents"); d.initMouseEvent(b, !0, !0, window, 1, c.screenX, c.screenY, c.clientX, c.clientY, !1, !1, !1, !1, 0, null), a.target.dispatchEvent(d)}}if (a.support.touch = "ontouchend"in document, a.support.touch){var e, b = a.ui.mouse.prototype, c = b._mouseInit, d = b._mouseDestroy; b._touchStart = function(a){var b = this; !e && b._mouseCapture(a.originalEvent.changedTouches[0]) && (e = !0, b._touchMoved = !1, f(a, "mouseover"), f(a, "mousemove"), f(a, "mousedown"))}, b._touchMove = function(a){e && (this._touchMoved = !0, f(a, "mousemove"))}, b._touchEnd = function(a){e && (f(a, "mouseup"), f(a, "mouseout"), this._touchMoved || f(a, "click"), e = !1)}, b._mouseInit = function(){var b = this; b.element.bind({touchstart:a.proxy(b, "_touchStart"), touchmove:a.proxy(b, "_touchMove"), touchend:a.proxy(b, "_touchEnd")}), c.call(b)}, b._mouseDestroy = function(){var b = this; b.element.unbind({touchstart:a.proxy(b, "_touchStart"), touchmove:a.proxy(b, "_touchMove"), touchend:a.proxy(b, "_touchEnd")}), d.call(b)}}}(jQuery);
	function zivsluck_addOns()
	{
		jQuery('#form-group-ordernotes').hide();
		jQuery('#customizeForm').hide();
		jQuery('#showCustom').hide();
		jQuery('#addonsForm').show();
		jQuery('#btnAddons').hide();
		jQuery('#step').val(2);
		jQuery('#droppableWindow').css('border', '1px solid black');
		var htmlButtons = '<button onclick="zivsluck_addOnsBack();" id="btnAddOnsBack" class="btn btn-default">Back</button>';
		<?php if(!empty($checkout)):?>
		htmlButtons += '<br /><br /><br /><button onclick="zivsluck_shippingProcess();" id="btnCheckoutNecklace" class="btn btn-success btn-next">Checkout this Necklace</button>';
		<?php endif;?>
		jQuery('#submitButtons').html(htmlButtons);
		scroll(0, 0);
	}
	function zivsluck_addOnsBack()
	{
		jQuery('#addOnControls').hide();
		jQuery('#addOnControlsPosition').hide();
		jQuery('#form-group-ordernotes').show();
		jQuery('#addonsForm').hide();
		jQuery('#customizeForm').show();
		jQuery('#showCustom').show();
		jQuery('#step').val(1);
		jQuery('#btnCheckoutNecklace').hide();
		jQuery('#droppableWindow').css('border', '0px solid black');
		zivsluck_load();
		scroll(0, 0);
	}
	function zivsluck_addOnsInit()
	{
		var font = jQuery('#font').val();
		if(!empty(zivsluckAddOnsToFonts[font]))
		{
			console.log(zivsluckAddOnsToFonts[font]);
			jQuery('.addon-thumbnail').hide();
			jQuery.each(zivsluckAddOnsToFonts[font], function(i, v){
				jQuery('.addon-thumbnail-' + v).show();
			});
		}
		var clone = true;
		var unlimitedAddons = true;
		$("#droppableWindow").droppable({
		accept: ".draggable.enable",
				drop: function (event, ui) {
					jQuery('#droppableWindow').css('backgroundColor', 'rgba(255,255,255,0)');
					var newPosX = ui.offset.left - $(this).offset().left;
					var newPosY = ui.offset.top - $(this).offset().top;
					var item = jQuery(ui.helper);
					if (clone)
					{
						if (!ui.helper.hasClass('cloned'))
						{
							var item = jQuery(ui.helper).clone();
							item = item.appendTo(this);
							item.css({top:newPosY, left:newPosX});
							jQuery(ui.helper).remove();
							item.addClass('cloned');
							item.click(function(){
								jQuery('.draggable.selected').removeClass('addon-controlable');
								jQuery(item).addClass('addon-controlable');
								jQuery('#spinner-addon-height-value').val(jQuery(item).height());
								jQuery('#spinner-addon-width-value').val(jQuery(item).width());
							});
						}
					}
					var sameAddonOnly = parseInt(item.attr('data-sameonly'));
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
					jQuery('.draggable').removeClass('addon-controlable');
					item.addClass('addon-controlable');
					jQuery('#addOnControls').show();
					jQuery('#addOnControlsPosition').show();
					item.draggable();
				},
				out: function (event, ui) {
					if (unlimitedAddons === false) {
						jQuery('.draggable').show();
					}
				}
		});
	$("#addonsWrapper").droppable({
	accept: ".draggable",
			drop: function (event, ui) {
			ui.helper.remove();
			jQuery('#droppableWindow').css('backgroundColor', 'rgba(255,255,255,0)');
			if (jQuery('.draggable.selected').length < 1)
			{
				jQuery('#addOnControls').hide();
				jQuery('#addOnControlsPosition').hide();
			} else {
				jQuery('.draggable.selected').first().addClass('addon-controlable');
				jQuery('#addOnControls').show();
				jQuery('#addOnControlsPosition').show();
			}
			}
	});
	$('.draggable').draggable({
			helper: "clone",
			revert: "invalid",
			drag: function (event, ui) {
				jQuery('#droppableWindow').css('backgroundColor', 'rgba(255,255,255,0.6)');
			}
	});
	var htmlButtons = '<button onclick="zivsluck_addOns();" id="btnAddons" class="btn btn-success btn-next">Next, Addons</button>';
	jQuery('#submitButtons').html(htmlButtons);
	}
</script>
@append