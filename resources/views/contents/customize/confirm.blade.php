<?php
$checkout = zbase_config_get('zivsluck.checkout.enable', false);
?>
<?php if(!empty($checkout)):?>
<div id="confirmOrderForm" style="display: none;">
	<h1>Please confirm your order below.</h1>
	<div class="col-md-12">
		<h3>Terms and Conditions</h3>
		<ul>
			<li>Confirmation message will be sent via SMS and Facebook message to confirm availability of your order.</li>
			<li>Once order has been confirmed, you need to send the payment via available methods.</li>
			<li>Once payment has been made, please send us a copy of the deposit slip as Proof of Payment.</li>
			<li>You can send to us the deposit/payment slip using the Update Order page at
				<a target="_blank" href="<?php echo zbase_url_from_route('orderUpdate')?>">http://zivsluck.com/update-order</a>.</li>
			<li><strong>No Proof of Payment, No Processing of Order.</strong></li>
			<li>No cancellation of order once payment has been made.</li>
			<li>No rush orders</li>
		</ul>
	</div>

	<div class="col-md-12">
		<h3>Pay only through these Remittance Centers:</h3>
		<?php
		$paymentCenters = zbase_config_get('zivsluck.paymentCenters');
		if(!empty($paymentCenters))
		{
			foreach ($paymentCenters as $paymentCenter)
			{
				if(!empty($paymentCenter['enable']))
				{
					echo '<div class="col-md-2 paymentCenter" style="margin-bottom: 20px;"><img src="/zbase/assets/zivsluck/img/payments/' . $paymentCenter['file'] . '"></div>';
				}
			}
		}
		?>
	</div>
	<div class="col-md-12">
		<h3>Use the information below when paying through a Remittance Center:</h3>
		<address>
			<strong>Gladdys Joi Gamat</strong>
			<br />
			Countryside Village, Bangkal<br />
			Davao City, PH<br />
			<abbr title="Mobile">Mobile:</abbr> (0925) 799-5993
		</address>
	</div>
</div>
@section('body_bottom')
<script type="text/javascript">

	function zivsluck_confirmOrder()
	{
		var agreement = jQuery('#agreement');
		var orderChecked = jQuery('#order_checked');
		if (jQuery('input[name="agreement"]:checked').length < 1)
		{
			agreement.closest('div.checkbox').addClass('has-error');
			return;
		}
		if (jQuery('input[name="order_checked"]:checked').length < 1)
		{
			orderChecked.closest('div.checkbox').addClass('has-error');
			return;
		}
		jQuery('#step').val(5);
		zivsluck_load();
	}
	function zivsluck_confirmOrderCancel()
	{
		jQuery('#shippingForm').hide();
		jQuery('#customizeForm').show();
		jQuery('#confirmOrderForm').hide();
		jQuery('#step').val(1);
		zivsluck_load();
	}
	jQuery(document).ready(function () {

	});
</script>
@append
<?php endif;?>