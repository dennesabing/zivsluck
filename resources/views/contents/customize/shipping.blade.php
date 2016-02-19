<?php
$checkout = zbase_config_get('zivsluck.checkout.enable', false);
$dataShipping = [];
if(zbase_is_dev())
{
	$dataShipping = [
		'first_name' => 'Dennes',
		'last_name' => 'Abing',
		'email' => 'dennes.b.abing@gmail.com',
		'fb' => 'http://facebook.com/dennesabing',
		'phone' => '09257995993',
		'address' => 'Lot 41, Block 10, Phase 8',
		'addressb' => 'Deca Homes, Tacunan, Mintal',
		'city' => 'Davao City',
	];
}
?>
<div id="shippingForm" style="display: none;">
	<h1>Order Information</h1>
	<div class="form-group">
		<label for="first_name">First Name</label>
		<input type="text" required="required" minlength="1" class="form-control" id="first_name" name="first_name" value="<?php echo zbase_data_get($dataShipping, 'first_name') ?>" placeholder="First Name" />
	</div>
	<div class="form-group">
		<label for="last_name">Last Name</label>
		<input type="text" required="required" minlength="1" class="form-control" id="last_name" name="last_name" value="<?php echo zbase_data_get($dataShipping, 'last_name') ?>" placeholder="Last Name" />
	</div>
	<div class="form-group">
		<label for="email">Email Address</label>
		<input type="text" minlength="1" class="form-control" id="email" name="fb" value="<?php echo zbase_data_get($dataShipping, 'email') ?>" placeholder="Email Address" />
	</div>
	<div class="form-group">
		<label for="fb">Facebook Profile Page</label>
		<input type="text" minlength="1" class="form-control" id="fb" name="fb" value="<?php echo zbase_data_get($dataShipping, 'fb') ?>" placeholder="Your facebook profile page" />
		<span class="help-block">We will use this information to contact you.</span>
	</div>
	<div class="form-group">
		<label for="phone">Mobile/Phone Number</label>
		<input type="text" required="required" minlength="1" class="form-control" id="phone" name="phone" value="<?php echo zbase_data_get($dataShipping, 'phone') ?>" placeholder="Mobile Number" />
		<span class="help-block">We will use this information to contact you.</span>
	</div>
	<div class="form-group">
		<label for="phone">Our Facebook Profile Page</label>
		<p class="form-control-static"><a href="https://facebook.com/zivs.luck" title="Like us on Facebook" target="_blank">http://facebook.com/zivs.luck</a></p>
	</div>
	<h1>Shipping Information!</h1>

	<div class="checkbox">
		<label>
			<input type="checkbox" id="shippingSame" name="shippingSame" value="1" />If Your are the not receiver, kindly check this box.
		</label>
	</div>
	<div id="shippingNamesWrapper" style="display: none;">
		<div class="form-group">
			<label for="shipping_first_name">First Name</label>
			<input type="text" minlength="1" class="form-control" id="shipping_first_name" name="shipping_first_name" value="<?php echo zbase_data_get($dataShipping, 'first_name') ?>" placeholder="First Name" />
		</div>
		<div class="form-group">
			<label for="shipping_last_name">Last Name</label>
			<input type="text" minlength="1" class="form-control" id="shipping_last_name" name="shipping_last_name" value="<?php echo zbase_data_get($dataShipping, 'last_name') ?>" placeholder="Last Name" />
		</div>
	</div>

	<div class="form-group">
		<label for="address">Block/Lot/Purok/Street</label>
		<input type="text" required="required" minlength="1" class="form-control" id="address" name="address" value="<?php echo zbase_data_get($dataShipping, 'address') ?>" placeholder="Block/Lot/Purok/Street" />
	</div>
	<div class="form-group">
		<label for="address">Subdivision/Village</label>
		<input type="text" minlength="1" class="form-control" id="addressb" name="addressb" value="<?php echo zbase_data_get($dataShipping, 'addressb') ?>" placeholder="Subdivision/Village" />
	</div>
	<div class="form-group">
		<label for="city">City/Municipality</label>
		<input type="text" minlength="1" required="required" class="form-control" id="city" value="<?php echo zbase_data_get($dataShipping, 'city') ?>" name="city" placeholder="City/Municipality" />
	</div>
	<label for="courier">Select Courier</label>
	<div class="radio">
		<label>
			<input type="radio" name="courier" required="required" value="lbc" checked>LBC
		</label>
		<label>
			<input type="radio" name="courier" required="required" value="jrs">JRS
		</label>
	</div>
	<label for="courier">Delivery  Mode</label>
	<div class="radio">
		<label>
			<input type="radio" name="deliveryMode" required="required" value="pickup" checked>Pick-Up
		</label>
		<label>
			<input type="radio" name="deliveryMode" required="required" value="doortodoor">Door-to-Door
		</label>
		<label id="label-deliveryMode-meetUp" style="display:none;">
			<input type="radio" id="meetUpRadio" name="meetUp" required="required" value="meetup">Meet-Up
		</label>
	</div>
	<div id="meetUpsInfo" style="display:none;">
		<h4>For meet ups (Davao City area)</h4>
		<p>
			SM City (Ecoland) Annex -  3:00 PM to 5:00 PM (Sundays only)
		</p>
		<h4>For meet ups in (GenSan City area)</h4>
		<p>
			KCC Mall 2:00 PM to 3:00 PM (Saturdays and Sundays only)
		</p>
	</div>
	<button id="btnShippingConfirmCancel" class="btn btn-danger">Cancel Order</button>
	<button id="btnShippingConfirm" class="btn btn-success">Next, Confirm Order</button>
</div>
@section('head_bottom')
<style type="text/css">
</style>
@append
@section('body_bottom')
<?php if(!empty($checkout)):?>
<script type="text/javascript">

	function zivsluck_shippingProcess()
	{
		jQuery('#shippingForm').show();
		jQuery('#customizeForm').hide();
		jQuery('#showCustom').hide();
		jQuery('#addonsForm').hide();
		jQuery('#btnCheckoutNecklace').hide();
		scroll(0, 0);
		jQuery('#step').val(3);
		jQuery('#btnAddOnsBack').hide();
		zivsluck_load();
	}
	jQuery(document).ready(function () {
		if ($("#meetUpRadio").is(":checked")) {
			console.log('MeetUp Checked');
		}
		jQuery('#city').blur(function () {
			var city = jQuery('#city').val();
			var meetupsCity = new Array('Davao', 'Davao City', 'General Santos', 'General Santos City', 'Gensan City', 'Gensan', 'Gen. Santos City', 'Gen. Santos');
			jQuery('#label-deliveryMode-meetUp').hide();
			jQuery('#meetUpsInfo').hide();
		});
		zbase_event_checkbox('#shippingSame', 'change', function (e) {
			if (!empty(zbase_get_checkbox_value('#shippingSame')))
			{
				jQuery('#shippingNamesWrapper').show();
				jQuery('.shipping_last_name').attr('required', true).val('');
				jQuery('.shipping_first_name').attr('required', true).val('');
			} else {
				jQuery('#shippingNamesWrapper').hide();
				jQuery('.shipping_last_name').attr('required', false).val('');
				jQuery('.shipping_first_name').attr('required', false).val('');
			}
		});

		jQuery('#btnShippingConfirmCancel').click(function (e) {
			e.preventDefault();
			jQuery('#shippingForm').hide();
			jQuery('#customizeForm').show();
			jQuery('#showCustom').show();
			jQuery('#addonsForm').hide();
			jQuery('#step').val(1);
			zivsluck_load();
			addon = '';
		});
		jQuery('#btnShippingConfirm').click(function (e) {
			e.preventDefault();
			var fName = jQuery('#first_name');
			var lName = jQuery('#last_name');
			var city = jQuery('#city');
			var courier = jQuery('input[name="courier"]');
			var dMode = jQuery('input[name="deliveryMode"]');
			var address = jQuery('#address');
			var addressb = jQuery('#addressb');
			var phone = jQuery('#phone');
			var fb = jQuery('#fb');
			var shippingFirstName = jQuery('#shipping_first_name');
			var shippingLastName = jQuery('#shipping_last_name');
			if (!empty(zbase_get_checkbox_value('#shippingSame')))
			{
				if (shippingFirstName.val() == '')
				{
					shippingFirstName.closest('.form-group').addClass('has-error');
					return;
				}
				if (shippingLastName.val() == '')
				{
					shippingLastName.closest('.form-group').addClass('has-error');
					return;
				}
			}
			if (fName.val() == '')
			{
				fName.closest('.form-group').addClass('has-error');
				return;
			}
			if (lName.val() == '')
			{
				lName.closest('.form-group').addClass('has-error');
				return;
			}
			if (phone.val() == '')
			{
				phone.closest('.form-group').addClass('has-error');
				return;
			}
			if (courier.filter(':checked').val() === undefined)
			{
				courier.closest('.radio').addClass('has-error');
				return;
			}
			if (dMode.filter(':checked').val() === undefined)
			{
				dMode.closest('.radio').addClass('has-error');
				return;
			}
			if (address.val() == '')
			{
				address.closest('.form-group').addClass('has-error');
				return;
			}
			if (addressb.val() == '')
			{
				addressb.closest('.form-group').addClass('has-error');
				return;
			}
			if (city.val() == '')
			{
				city.closest('.form-group').addClass('has-error');
				return;
			}
			jQuery('#step').val(4);
			jQuery('#confirmOrderForm').show();
			jQuery('#shippingForm').hide();
			jQuery('#showCustom').show();
			scroll(0, 0);
			zivsluck_load();
		});
	});
</script>
<?php endif;?>
@append