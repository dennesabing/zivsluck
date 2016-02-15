<?php
zbase_view_head_meta_add('_token', zbase_csrf_token());
$checkout = zbase_config_get('zivsluck.checkout.enable', false);
?>
<div class="row" style="border-bottom: 2px solid #EBEBEB;padding-bottom:20px;">
	<div class="col-md-6">

		{!! view(zbase_view_file_contents('customize.customize')) !!}
		{!! view(zbase_view_file_contents('customize.addons')) !!}

		<div class="form-group" id="form-group-ordernotes">
			<label for="name">Notes on your order</label>
			<textarea class="form-control" rows="5" id="orderNotes" value="Notes" name="orderNotes" placeholder="Notes on your order"></textarea>
		</div>

		{!! view(zbase_view_file_contents('customize.shipping')) !!}
		{!! view(zbase_view_file_contents('customize.confirm')) !!}
		{!! view(zbase_view_file_contents('customize.final')) !!}
	</div>
	<div class="col-md-6">

		{!! view(zbase_view_file_contents('customize.addonControl')) !!}
		<div id="customizedImage" class="col-md-12" style="padding-top: 20px;overflow:hidden;"></div>
		<div id="submitButtons" class="col-md-12" style="padding-top: 20px;"></div>
		<div id="bayadCenterId" class="col-md-12" style="padding-top: 20px;display: none;">
			<img src="/zbase/assets/zivsluck/img/payments/bayadCenter.png" alt="Remittance Centers">
		</div>
		<input type="hidden" name="step" id="step" value="1" />
	</div>
</div>

@section('head_bottom')
<style type="text/css">
	.imagePreviews{
		cursor: pointer;padding:0px 0px 20px 0px;border-bottom:0px solid #EBEBEB;text-align:center;
	}
	#bayadCenterId img,
	.paymentCenter img,
	.imagePreview img,
	.chain-type img,
	#chain-length-reference img,
	.imagePreviews img{
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}
	.addon img{
		z-index:99999;
	}
	.imagePreviews img,
	.imagePreview img{
		padding: 5px;
	}
	.chain-type{
		margin-bottom: 20px;
	}
	.chain-type img{
		padding:5px;
	}
	#chain-length-reference img{
		padding:5px;
	}
	#orderStatus .value{
		font-weight: bold;
	}
	#addonsForm{
		margin-bottom: 20px;
	}

	@media (min-width: 320px) and (max-width: 550px) {
		#customizedImage{
			padding-left:0px;
		}
	}
</style>
<script type="text/javascript">
	var zivsluckFonts = <?php echo json_encode(zbase_config_get('zivsluck.fontmaps')); ?>;
	var zivsluckChains = <?php echo json_encode(zbase_config_get('zivsluck.chains')); ?>;
	var zivsluckAddOnsToFonts = <?php echo json_encode(zbase_config_get('zivsluck.addons.configuration.fonts')); ?>;
	var addon = '';
</script>
@append
@section('body_bottom')
<script type="text/javascript">
	function zivsluck_exit_alert() {
		var step = parseInt(jQuery('#step').val());
		var font = jQuery('#font').val();
		if (step === 5)
		{
			return 'Order processing is in progress... Kindly just wait!';
		} else if (step > 1 && step < 5)
		{
			return 'You have customized necklace in progress, are you sure you want to cancel?';
		} else {
			if (font != 'all')
			{
				return 'You have customized necklace in progres, are you sure you want to cancel?';
			}
		}
		return '';
	}
	function zivsluck_shutdown_ordering(tag)
	{
		if (tag == 'fontToMaterial')
		{
			jQuery('.btn-next').hide();
		}
	}
	function zivsluck_start_ordering()
	{
		jQuery('.btn-next').show();
	}
	function zivsluck_check_fontToMaterial()
	{
		var material = jQuery('#material').val();
		var font = jQuery('#font').val();
		if (!empty(zivsluckChains[material]['fonts']))
		{
			if (!empty(zivsluckChains[material]['fonts']['not']))
			{
				if (in_array(font, zivsluckChains[material]['fonts']['not']))
				{
					jQuery('.btn-next').hide();
					zivsluck_shutdown_ordering('fontToMaterial');
					return;
				}
			}
		}
		zivsluck_start_ordering();
	}
	function zivsluck_load()
	{
		var step = parseInt(jQuery('#step').val());
		var text = jQuery('#name').val();
		if (text == '')
		{
			jQuery('#name').closest('.form-group').addClass('has-error');
			return;
		}
		var material = jQuery('#material').val();
		var font = jQuery('#font').val();
		var chain = jQuery('#chain').val();
		var chainLength = jQuery('#chain-length').val();
		var data = {};
		jQuery('.draggable.selected').each(function (i, v) {
			var addn = jQuery(v);
			addon += addn.attr('data-name') + '-' + addn.attr('data-position') + '-' + parseInt(addn.css('width')) + 'x' + parseInt(addn.css('height')) + '|';
		});
		if (step >= 2)
		{
			jQuery('#form-group-ordernotes').hide();
			jQuery('#addOnControls').hide();
			jQuery('#addOnControlsPosition').hide();
		} else {
			jQuery('#form-group-ordernotes').show();
		}
		if (step === 4 || step === 5)
		{
			if(step === 5)
			{
				jQuery('#orderConfirmationWrapper').remove();
			}
			var fName = jQuery('#first_name');
			var lName = jQuery('#last_name');
			var city = jQuery('#city');
			var courier = jQuery('input[name="courier"]');
			var dMode = jQuery('input[name="deliveryMode"]');
			var address = jQuery('#address');
			var addressb = jQuery('#addressb');
			var phone = jQuery('#phone');
			var fb = jQuery('#fb');
			var email = jQuery('#email');
			var orderNotes = jQuery('#orderNotes');
			var shippingFirstName = jQuery('#shipping_first_name');
			var shippingLastName = jQuery('#shipping_last_name');
			data = {
				shippingFirstName: shippingFirstName.val(),
				shippingLastName: shippingLastName.val(),
				shippingSame: zbase_get_checkbox_value('#shippingSame'),
				addon: addon,
				chain: chain,
				customerNote: orderNotes.val(),
				chainLength: chainLength,
				first_name: fName.val(),
				last_name: lName.val(),
				city: city.val(),
				deliveryMode: dMode.filter(':checked').val(),
				courier: courier.filter(':checked').val(),
				address: address.val(),
				addressb: addressb.val(),
				phone: phone.val(),
				fb: fb.val().replace('http://', ''),
				email: email.val(),
				step: step
			};
		} else if (step == 3) {
			data = {
				chain: chain,
				chainLength: chainLength,
				addon: addon
			};
		} else {
			data = {chain: chain, chainLength: chainLength};
		}
		$.ajax({
			type: 'GET',
			url: '<?php echo zbase_url_from_route('create') ?>/' + text + '/' + font + '/' + material,
			data: data,
			beforeSend: function () {
				if (step === 5 && font != 'all')
				{
					jQuery('#customizedImage').html('<p class="bg-danger" style="padding:20px;">Prcessing your order, kindly wait...</p>');
				} else {
					jQuery('#customizedImage').html('<p class="bg-info" style="padding:20px;">Creating a preview, kindly wait...</p>');
				}
			},
			success: function (data) {
				window.onbeforeunload = zivsluck_exit_alert;
				jQuery('#customizedImage').html(data);
				if (step === 1 && font != 'all')
				{
					zivsluck_addOnsInit();
				}
				if (step === 2 && font != 'all')
				{
					var htmlButtons = '<button onclick="zivsluck_addOnsBack();" id="btnAddOnsBack" class="btn btn-default">Back</button>';
					<?php if(!empty($checkout)):?>
					htmlButtons += '<br /><br /><br /><button onclick="zivsluck_shippingProcess();" id="btnCheckoutNecklace" class="btn btn-success btn-next">Checkout this Necklace</button>';
					<?php endif;?>
					jQuery('#submitButtons').html(htmlButtons);
				}
				if (step === 4 && font != 'all')
				{
					<?php if(!empty($checkout)):?>
					var htmlButtons = '<div id="orderConfirmationWrapper"><div class="checkbox"><label><input type="checkbox" required="required" id="agreement" name="agreement" value="1" />I Agree and I understand the Terms and Conditions.</label></div>';
					htmlButtons += '<br /><button onclick="zivsluck_confirmOrderCancel();" id="btnConfirmOrderCancel" class="btn btn-danger">Cancel Order</button>';
					htmlButtons += '&nbsp; &nbsp;<button onclick="zivsluck_confirmOrder();" id="btnConfirmOrder" class="btn btn-success btn-next">Yes, I want to order</button></div>';
					jQuery('#submitButtons').html(htmlButtons);
					<?php endif;?>
				}
				if (step === 5 && font != 'all')
				{
					<?php if(!empty($checkout)):?>
					jQuery('#shippingForm').remove();
					jQuery('#customizeForm').remove();
					jQuery('#confirmOrderForm').remove();
					jQuery('#finalOrderForm').show();
					jQuery('#bayadCenterId').show();

					data = jQuery.parseHTML(data);
					var orderInput = jQuery(data).find('#orderId');

					if (orderInput.length > 0)
					{
						var orderId = orderInput.val();
						if (!empty(orderId))
						{
							jQuery('#orderId').text(orderId);
							jQuery('#orderImageDownload').attr('href', '/order/' + orderId + '/download');
						}
					}
					var htmlButtons = '';
					jQuery('#submitButtons').html(htmlButtons);
					window.onbeforeunload = null;
					scroll(0, 0);
					jQuery('#orderConfirmationWrapper').remove();
					<?php endif;?>
				}
				if (step === 1 && font != 'all')
				{
					zivsluck_check_fontToMaterial();
				}
			}}
		);
	}
	function zivsluck_chainLengthReference()
	{
		jQuery('#chain-length-reference').toggle();
	}
	function zivsluck_resetForm()
	{
		jQuery('#form-group-chain').hide();
		jQuery('#form-group-chain-length').hide();
	}
	function zivsluck_selectFont(font, selectMaterial)
	{
		var material = jQuery('#material').val();
		if (selectMaterial === true)
		{
			zivsluck_selectMaterial();
		}
		jQuery('#font').val(font);
		if (font == 'all')
		{
			zivsluck_resetForm();
			zivsluck_load();
		} else {
			zivsluck_load();
			if (material == 'stainless')
			{
				$.each(zivsluckFonts, function (index, val) {
					if (index == font)
					{
						if (val.chaingroup !== undefined)
						{
							jQuery('.chain-type').hide();
							$.each(val.chaingroup, function (i, v) {
								jQuery('.chain-type-group-' + v).show();
								jQuery('.chain-type-group-' + v).first().find('input').attr('checked', true);
							});
						}
					}
				});
			}
		}
	}
	function zivsluck_selectImage(font)
	{
		zivsluck_selectMaterial();
		zivsluck_selectFont(font);
	}
	function zivsluck_selectChain(chain)
	{
		jQuery('#chain').val(chain);
		zivsluck_load();
	}
	function zivsluck_selectMaterial()
	{
		var material = jQuery('#material').val();
		jQuery('#form-group-chain').show();
		jQuery('#form-group-chain-length').show();
		jQuery('.chain-type').hide();
		jQuery('.chain-type-' + material).show();
		jQuery('#chain').val(jQuery('.chain-type-' + material + ':visible').first().attr('data-name'));
		jQuery('.chain-type-' + material + ':visible').first().find('input').attr('checked', true);
	}
	function zivsluck_orderDownload(id)
	{
		window.location = '/order/' + id + '/download';
	}
	jQuery(document).ready(function () {
		jQuery('#btnCustomize').click(function (e) {
			e.preventDefault();
			zivsluck_load();
		});
		jQuery('#font').change(function (e) {
			e.preventDefault();
			zivsluck_selectFont(jQuery('#font').val(), true);
		});
		jQuery('#material').change(function (e) {
			e.preventDefault();
			zivsluck_selectMaterial();
			var font = jQuery('#font').val();
			if (font != 'all')
			{
				zivsluck_selectFont(font);
			} else {
				zivsluck_load();
			}
		});
		jQuery('#chain-length').change(function (e) {
			zivsluck_load();
		});
	});
</script>
@append