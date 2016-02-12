<div id="shippingForm" style="display: none;">
	<h1>Order Information</h1>
	<div class="form-group">
		<label for="first_name">First Name</label>
		<input type="text" required="required" minlength="1" class="form-control" id="first_name" name="first_name" value="Dennes" placeholder="First Name" />
	</div>
	<div class="form-group">
		<label for="last_name">Last Name</label>
		<input type="text" required="required" minlength="1" class="form-control" id="last_name" name="last_name" value="Abing" placeholder="Last Name" />
	</div>
	<div class="form-group">
		<label for="email">Email Address</label>
		<input type="text" minlength="1" class="form-control" id="email" name="fb" value="dennes.b.abing@gmail.com" placeholder="Email Address" />
	</div>
	<div class="form-group">
		<label for="fb">Facebook Profile Page</label>
		<input type="text" required="required" minlength="1" class="form-control" id="fb" name="fb" value="http://facebook.com/dennesabing" placeholder="Your facebook profile page" />
		<span class="help-block">We will use this information to contact you.</span>
	</div>
	<div class="form-group">
		<label for="phone">Mobile/Phone Number</label>
		<input type="text" required="required" minlength="1" class="form-control" id="phone" name="phone" value="09257995992" placeholder="Mobile Number" />
		<span class="help-block">We will use this information to contact you.</span>
	</div>
	<div class="form-group">
		<label for="phone">Our Facebook Profile Page</label>
		<p class="form-control-static"><a href="https://facebook.com/zivs.luck" title="Like us on Facebook" target="_blank">http://facebook.com/zivs.luck</a></p>
	</div>
	<h1>Shipping Information!</h1>
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
	</div>
	<div class="form-group">
		<label for="address">Block/Lot/Purok/Street</label>
		<input type="text" required="required" minlength="1" class="form-control" id="address" name="address" value="Lot 41, Block 10, Phase 8" placeholder="Block/Lot/Purok/Street" />
	</div>
	<div class="form-group">
		<label for="address">Subdivision/Village</label>
		<input type="text" minlength="1" class="form-control" id="addressb" name="addressb" value="Deca Homes, Tacunan, Mintal" placeholder="Subdivision/Village" />
	</div>
	<div class="form-group">
		<label for="city">City/Municipality</label>
		<input type="text" minlength="1" required="required" class="form-control" id="city" value="Davao City" name="city" placeholder="City/Municipality" />
	</div>
	<button id="btnShippingConfirmCancel" class="btn btn-default">Back</button>
	<button id="btnShippingConfirm" class="btn btn-success">Next, Confirm Order</button>
</div>
@section('head_bottom')
<style type="text/css">
</style>
@append
@section('body_bottom')
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
		jQuery('#btnShippingConfirmCancel').click(function (e) {
			e.preventDefault();
			jQuery('#shippingForm').hide();
			jQuery('#customizeForm').show();
			jQuery('#showCustom').show();
			jQuery('#addonsForm').hide();
			jQuery('#step').val(1);
			zivsluck_load();
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
			if (fb.val() == '')
			{
				fb.closest('.form-group').addClass('has-error');
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
			zivsluck_load();
		});
	});
</script>
@append