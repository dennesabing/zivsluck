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
			<div class="input-group col-md-4 spinner spinner-addon spinner-addon-width">
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
			</div>
		</div>
	</div>
</div>

@section('head_bottom')
<style type="text/css">
	.addon-controlable{
		border:0px solid white;
	}
	#addOnControlsPosition{
		position: absolute;
		height: 0px;
	}
	#addOnControls .controlLabel,
	#addOnControlsPosition .controlLabel{
		display: none;
	}
	#addOnControlsPosition .positionControls{
		position: relative;
		z-index: 99999;
		top: 60px;
		left: 10px;
	}
	#addOnControls{
		position: absolute;
		height:0px;
	}
	#addOnControls .controls{
		position: relative;
		z-index: 99999;
		background: white;
		top: 0px;
		left: 0px;
		padding: 5px;
		margin: 20px;
		width: 280px;
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
	@media (min-width: 320px) and (max-width: 800px) {
		#addOnControls .controlLabel,
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
			/*background: yellow;*/
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
		#addOnControlsPosition .positionControls{
			border: 1px solid black;
			position: relative;
			top: -160px;
			left: -20px;
			width: 140px;
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
			left: -5px !important;
		}
		#addonPositionRight{
			position: relative;
			top: 50px;
			left: 30px;
		}
		#addonPositionUp{
			top: -30px;
			position: relative;
			left: 34px;
		}
		#addonPositionDown{
			top: 50px;
			position: relative;
			left: -9px;
		}

	}
</style>
@append
@section('body_bottom')
<script type="text/javascript">
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
	jQuery(document).ready(function () {
		$('#addOnControls').draggable();
		$('#addOnControlsPosition').draggable();

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