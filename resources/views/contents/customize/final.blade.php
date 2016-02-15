<?php
$checkout = zbase_config_get('zivsluck.checkout.enable', false);
?>
<?php if(!empty($checkout)):?>
<div id="finalOrderForm" style="display: none;">
	<h1>Thank you very much!</h1>
	<p>Save the <strong>ORDER image</strong> below for your reference, or <a id="orderImageDownload" href="javascript:void(0)" title="Download order image">click here</a> to download it automatically.</p>
	<h3>Your ORDER ID is <span style="color: red;font-weight:bold;" id="orderId"></span>.</h3>
	<ul>
		<li>You will need this <strong>ORDER ID</strong> when you update your Order.</li>
		<li>After sending the payment, make a copy of the deposit/payment slip and mark it with the <strong>ORDER ID</strong> and send it to us through facebook.</li>
		<li>Alternatively, you can also upload your deposit/payment slip at <strong><a target="_blank" href="<?php echo zbase_url_from_route('orderUpdate')?>">http://zivsluck.com/update-order</a></strong></li>
		<li>Or if you are sending a message through our mobile, include also your <strong>ORDER ID</strong> for faster processing.</li>
		<li>Whenever you need to contact us, make sure that you always have your <strong>ORDER ID</strong> as a referece.</li>
		<li>Always keep your <strong>ORDER ID</strong> for future reference.</li>
	</ul>
	<br />
	<br />
	<div class="col-md-12">
		{!! view(zbase_view_file_contents('sharethis')) !!}
	</div>
</div>
<?php endif;?>