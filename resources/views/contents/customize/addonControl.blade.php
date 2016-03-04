<?php
$checkout = zbase_config_get('zivsluck.checkout.enable', false);
?>
<div class="col-md-12">
	<div id="addOnControls" class="row" style="display: none;">
		<span class="controlLabel">Resize symbol</span>
		<div class="controls col-md-12">
			<div class="input-group spinner col-md-4 spinner-addon spinner-addon-height">
				<input type="text" class="form-control" id="spinner-addon-height-value" name="spinner-addon-height-value" value="32" readonly>
				<div class="input-group-btn-vertical">
					<button class="btn btn-default" type="button"><i class="glyphicon glyphicon-plus"></i></button>
					<button class="btn btn-default" type="button"><i class="glyphicon glyphicon-minus"></i></button>
				</div>
			</div>
			<div class="input-group col-md-4 spinner spinner-addon spinner-addon-width" style="display: none;">
				<input type="text" class="form-control" id="spinner-addon-width-value" name="spinner-addon-width-value" disabled value="32" readonly>
				<div class="input-group-btn-vertical">
					<button class="btn btn-default" type="button"><i class="glyphicon glyphicon-plus"></i></button>
					<button class="btn btn-default" type="button"><i class="glyphicon glyphicon-minus"></i></button>
				</div>
			</div>
			<div class="checkbox col-md-4">
				<label>
					<input type="checkbox" id="constraint" name="constraint" value="1" checked />Constraint
				</label>
			</div>
		</div>
	</div>
	<div id="addOnControlsPosition" class="row" style="display: none;">
		<span class="controlLabel">Reposition symbol</span>
		<div class="positionControls col-md-12">
			<div class="input-group-btn-vertical">
				<button class="btn btn-default btn-xs" id="addonPositionLeft" type="button"><i class="glyphicon glyphicon-chevron-left"></i></button>
				<button class="btn btn-default btn-xs" id="addonPositionRight" type="button"><i class="glyphicon glyphicon-chevron-right"></i></button>
				<button class="btn btn-default btn-xs" id="addonPositionUp" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button>
				<button class="btn btn-default btn-xs" id="addonPositionDown" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button>
				<button class="btn btn-default btn-xs" id="addonPositionRotate" type="button"><i class="glyphicon glyphicon-repeat"></i></button>
				<!--<button class="btn btn-default btn-xs" id="addonPositionFlipH" type="button"><i class="glyphicon glyphicon-object-align-horizontal"></i></button>-->
				<!--<button class="btn btn-default btn-xs" id="addonPositionFlipV" type="button"><i class="glyphicon glyphicon-object-align-vertical"></i></button>-->
			</div>
		</div>
	</div>
</div>

@section('head_bottom')
<style type="text/css">
	.flipped {
		-moz-transform: scaleX(-1);
		-o-transform: scaleX(-1);
		-webkit-transform: scaleX(-1);
		transform: scaleX(-1);
		filter: FlipH;
		-ms-filter: "FlipH";
	}
	.addon-controlable{
		border:0px solid white;
	}
	#addOnControlsPosition{
		position: absolute;
		height: 0px;
		left: 150px;
		top: -25px;
	}
	#addOnControls .controlLabel,
	#addOnControlsPosition .controlLabel{
		display: none;
	}
	#addOnControlsPosition .positionControls{
		position: relative;
		z-index: 99999;
		top: 10px;
		left: 20px;
		padding: 10px;
		background: rgba(255,255,255,0.4);
	}
	#addOnControls{
		position: absolute;
		height:0px;
		top:20px;
	}
	#addOnControls .controls{
		position: relative;
		z-index: 99999;
		background: white;
		top: -50px;
		left: 0px;
		padding: 5px;
		margin: 20px;
		width: 280px;
		background: rgba(255,255,255,0.4);
	}
	.spinner-addon {
		width: 50px;
	}
	.spinner-addon input {
		text-align: right;
	}
	.spinner-addon input.form-control {
		text-align: center;
		width: 40px;
		padding: 6px 10px;
	}
	.spinner-addon.input-group[class*=col-]{
		float: left;
	}
	.spinner-addon .input-group-btn-vertical {
		position: relative;
		white-space: nowrap;
		width: 1%;
		vertical-align: middle;
		display: table-cell;
	}
	.spinner-addon .input-group-btn-vertical > .btn {
		display: block;
		float: none;
		width: 100%;
		max-width: 100%;
		padding: 8px;
		margin-left: -1px;
		position: relative;
		border-radius: 0;
	}
	.spinner-addon .input-group-btn-vertical > .btn:first-child {
		border-top-right-radius: 4px;
	}
	.spinner-addon .input-group-btn-vertical > .btn:last-child {
		margin-top: -2px;
		border-bottom-right-radius: 4px;
	}
	.spinner-addon .input-group-btn-vertical i{
		position: absolute;
		top: 0;
		left: 1px;
	}
	#addOnControls .controls .checkbox{
		display: none;
	}
	@media (min-width: 320px) and (max-width: 568px) {
		#addOnControlsPosition{
			position: fixed;
			height: 0px;
			top: 250px;
			z-index: 99;
			left: 150px;
		}
		#addOnControls {
			position: fixed;
			height: 0px;
			top: 310px;
			z-index: 99;
		}
		#addOnControls .controls
		{
			padding: 0px;
			margin: 0px;
			height: 35px;
			background: none;
		}
		#addOnControls .controls input
		{
			display: none;
		}
		#addOnControls .controls .btn {
			padding: 20px;
			border-radius: 5px;
			/* padding: 15px; */
			display: block;
			/* text-align: center; */
			border-radius: 5px;
			width: 35px;
			height: 35px;
			float: left;
		}
		#addOnControls .controls .btn i{
			top: 12px;
			left: 12px;
		}
		#addOnControls .controls .checkbox{
			display: none;
		}
		#addOnControls .controls .btn:last-child{
			margin-top:0px;
		}
		#addOnControls .input-group.spinner{
			width:105px;
		}
	}
	@media (min-width: 320px) and (max-width: 800px) {
		/*		#addOnControls .controlLabel,
				#addOnControlsPosition .controlLabel{
					display: block;
					position: relative;
					top: -190px;
					background: black;
					color: white;
					text-align: center;
					font-size: 11px;
				}
				#addOnControls .controlLabel{
					position: relative;
					top: -190px;
				}
				#addOnControls{
					position: fixed;
					z-index: 99999;
					height:0px;
					bottom: 0px;
					cursor: grab;
				}
				#addOnControls .controls {
					border: 1px solid black;
					padding: 0px;
					margin: 0px;
					width: 125px;
					height: 170px;
					top: -190px;
					background: rgba(255,255,255,0.5);
					background: yellow;
				}
				.spinner-addon {
				}
				#addOnControls .checkbox label {
					position: relative;
					left: 0px;
					top: 0px;
					content: none;
				}
				.spinner-addon input.form-control {
					top: 72px;
					text-align: center;
					width: 40px;
					padding: 6px 10px;
				}
				.spinner-addon.input-group[class*=col-]{
					width:50px;
				}
				.spinner-addon.spinner-addon-width{
					position: absolute;
					top: 0px;
					left: 15px
				}
				.spinner-addon.spinner-addon-height{
					position: absolute;
					left: 65px;
					top: 0px;
				}
				.spinner-addon .input-group-btn-vertical {
					display: block;
					z-index: 999;
					top: 0px;
				}
				.spinner-addon .input-group-btn-vertical > .btn {
					padding: 20px;
					border-radius: 5px;
				}
				.spinner-addon .input-group-btn-vertical > .btn:first-child {
					border-bottom-right-radius: 0px;
					border-bottom-left-radius: 0px;
				}
				.spinner-addon .input-group-btn-vertical > .btn:last-child {
					top:30px;
					border-top-right-radius: 0px;
					border-top-left-radius: 0px;
				}
				.spinner-addon .input-group-btn-vertical i{
					top: 12px;
					left: 12px;
				}

				#addOnControlsPosition{
					position: fixed;
					height: 0px;
					z-index:9999;
					right:0px;
					bottom:0px;
				}
				#addOnControlsPosition .controlLabel{
					position: relative;
					top: -160px;
					left: -20px;

				}
				#addOnControlsPosition .input-group-btn-vertical{
					position: relative;
					padding: 0px;
					margin: 0px;
					height: 140px;
					left: -5px;
					width: 120px;
					top: -12px;
				}
				#addOnControlsPosition .positionControls{
					border: 1px solid black;
					position: relative;
					top: -160px;
					left: -20px;
					width: 121px;
					background: rgba(255,255,255,0.5);
					height: 140px;
				}
				#addOnControlsPosition .btn-xs{
					padding: 10px;
					width: 40px;
				}
				#addonPositionLeft{
					position: relative;
					top: 50px !important;
					left: -10px !important;
				}
				#addonPositionRight{
					position: relative;
					top: 50px;
					left: 35px;
				}
				#addonPositionUp{
					top: -35px;
					position: relative;
					left: 34px;
				}
				#addonPositionDown{
					top: 55px;
					position: relative;
					left: -9px;
				}
				#addonPositionRotate{
					position: relative;
					top: -30px;
					left: 35px;
				}*/

	}
</style>
@append
@section('body_bottom')
<script type="text/javascript">
	function zivsluck_flip_h()
	{
		var addon = jQuery('.addon-controlable');
		if (addon.hasClass('flipped'))
		{
			addon.removeClass('flipped');
		} else {
			addon.addClass('flipped');
		}
	}
	function zivsluck_addOns_height_add()
	{
		var height = parseInt(jQuery('.addon-controlable').height(), 10) + 1;
		jQuery('.spinner-addon-height input').val(height);
		jQuery('.addon-controlable').height(height);
	}
	function zivsluck_addOns_height_sub()
	{
		var height = parseInt(jQuery('.addon-controlable').height(), 10) - 1;
		jQuery('.spinner-addon-height input').val(height);
		jQuery('.addon-controlable').height(height);
	}
	function zivsluck_addOns_width_add()
	{
		var width = parseInt(jQuery('.addon-controlable').width(), 10) + 1;
		jQuery('.spinner-addon-width input').val(width);
		jQuery('.addon-controlable').width(width);
	}
	function zivsluck_addOns_width_sub()
	{
		var width = parseInt(jQuery('.addon-controlable').width(), 10) - 1;
		jQuery('.spinner-addon-width input').val(width);
		jQuery('.addon-controlable').width(width);
	}
	function zivsluck_addOn_position_set(pos)
	{
		var item = jQuery('.addon-controlable');
		var container = item.parent();
		var newPosX = parseInt(item.css('left'));
		var newPosY = parseInt(item.css('top'));
		if (pos == 'left')
		{
			newPosX -= 1;
			item.css('left', newPosX + 'px');
		}
		if (pos == 'right')
		{
			newPosX += 1;
			item.css('left', newPosX + 'px');
		}
		if (pos == 'top')
		{
			newPosY -= 1;
			item.css('top', newPosY + 'px');
		}
		if (pos == 'bottom')
		{
			newPosY += 1;
			item.css('top', newPosY + 'px');
		}
		item.attr('data-position', newPosX + ',' + newPosY);
	}
	function zivsluck_addOn_rotate()
	{
		var deg = parseInt(jQuery('.addon-controlable').attr('data-rotate'), 10) + 90;
		if (deg === 360)
		{
			deg = 0;
		}
		var degValue = 'rotate(' + deg + 'deg)';
		jQuery('.addon-controlable').css({'-moz-transform': degValue, 'transform': degValue, '-webkit-transform': degValue, '-ms-transform': degValue}).attr('data-rotate', deg);
	}
	jQuery(document).ready(function () {
		$('#addOnControls').draggable();
		$('#addOnControlsPosition').draggable();

		jQuery('#addonPositionFlipH').click(function () {
			zivsluck_flip_h();
		});
		jQuery('#addonPositionRotate').click(function () {
			zivsluck_addOn_rotate();
		});
		jQuery('#addonPositionLeft').click(function () {
			zivsluck_addOn_position_set('left');
		});
		jQuery('#addonPositionRight').click(function () {
			zivsluck_addOn_position_set('right');
		});
		jQuery('#addonPositionUp').click(function () {
			zivsluck_addOn_position_set('top');
		});
		jQuery('#addonPositionDown').click(function () {
			zivsluck_addOn_position_set('bottom');
		});

		jQuery('.draggable.enable').click(function () {
			if (jQuery(this).hasClass('selected'))
			{
				jQuery('.draggable.selected').removeClass('addon-controlable');
				jQuery(this).addClass('addon-controlable');
				jQuery('.spinner-addon-width input').val(jQuery(this).width());
				jQuery('.spinner-addon-height input').val(jQuery(this).height());
			}
		});

		jQuery('.spinner-addon-height .btn:first-of-type').on('click', function () {
			if (!empty(zbase_get_checkbox_value('#constraint')))
			{
				zivsluck_addOns_width_add();
			}
			zivsluck_addOns_height_add();
		});
		jQuery('.spinner-addon-height .btn:last-of-type').on('click', function () {
			if (!empty(zbase_get_checkbox_value('#constraint')))
			{
				zivsluck_addOns_width_sub();
			}
			zivsluck_addOns_height_sub();
		});

		jQuery('.spinner-addon-width .btn:first-of-type').on('click', function () {
			if (!empty(zbase_get_checkbox_value('#constraint')))
			{
				zivsluck_addOns_height_add();
			}
			zivsluck_addOns_width_add();
		});
		jQuery('.spinner-addon-width .btn:last-of-type').on('click', function () {
			if (!empty(zbase_get_checkbox_value('#constraint')))
			{
				zivsluck_addOns_height_sub();
			}
			zivsluck_addOns_width_sub();
		});
	});
</script>
@append