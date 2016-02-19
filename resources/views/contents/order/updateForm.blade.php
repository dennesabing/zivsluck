<h1>Update Order</h1>
<?php if(!empty($orderEntity)): ?>
	<h3>Thank you very much.</h3>
	<p>Thank you very much for the payment. We will update you soon of your order.</p>
	<p>Below is your Order:</p>
	<div class="col-md-12">
		<img src="<?php echo zbase_url_from_route('order', array('id' => $orderEntity->maskedId())) ?>" title="Order # <?php echo $orderEntity->maskedId() ?>" />
	</div>
<?php else: ?>
	<p>
		If you already made payments via a Remittance Center,
		use this form to update your order by uploading your deposit or payment slip.
		<br />
		We will validate your payments with your <strong>Order Id</strong>, the <strong>Name</strong> and the <strong>Total Amount</strong> in your order.
		<br />Make sure that you entered the correct information, you can only do this once.
	</p>
	<p>
		Make a copy (take a shot using your phone camera or scan it) of the deposit or payment slip and indicate on the slip
		the ORDER ID that the payment is intended for.
	</p>
	<p>
		If you paid once for multiple orders, make a copy of the deposit/payment slip and write all the Order IDs on it
		and update each order with the correspoding amount intended for each order.
		Also, you have to upload a copy of the deposit/slip for each order update.
	</p>
	<div class="row">
		<div class="col-md-12">
			<form method="post" action="<?php echo zbase_url_from_route('orderUpdate'); ?>" enctype="multipart/form-data">
				<?php echo zbase_csrf_token_field() ?>
				<div class="form-group">
					<label for="order_id">Order ID</label>
					<input type="text" required="required" minlength="6" maxlength="7" class="form-control" id="order_id" value="<?php echo zbase_form_old('order_id', zbase_is_dev() ? '2' : null) ?>" name="order_id" placeholder="Order ID" />
				</div>
				<div class="form-group">
					<label for="name">Name on your order</label>
					<input type="text" required="required" class="form-control" id="first_name" value="<?php echo zbase_form_old('name', zbase_is_dev() ? 'Dennes Abing' : null) ?>" name="name" placeholder="Name" />
					<span class="help-block">The name you used on your order.</span>
				</div>
				<div class="form-group">
					<label for="payment_center">Payment Center</label>
					<select required="required" class="form-control" id="payment_center" name="payment_center">
						<option value="">-</option>
						<option value="cebuana">Cebuana Lhullier</option>
						<option value="mlhuillier">M Lhuillier</option>
						<option value="palawan">Palawan Express</option>
						<option value="rd">RD Pawnshop</option>
					</select>
				</div>
				<div class="form-group">
					<label for="amount">Amount Sent/Paid</label>
					<input type="text" class="form-control" id="amount" value="<?php echo zbase_form_old('amount') ?>" name="amount" placeholder="0.00" />
					<span class="help-block">The amount sent/paid.</span>
				</div>
				<div class="form-group">
					<label for="tracking">Tracking Number</label>
					<input type="text" class="form-control" id="tracking" value="" name="tracking" placeholder="The Tracking Number" />
					<span class="help-block">Date in format of <strong>mm/dd/yy</strong>. Example: <?php echo date('m/d/Y') ?> (<?php echo date('F d, Y') ?>)</span>
				</div>
				<div class="form-group">
					<label for="date">Date Paid</label>
					<input type="date" required="required" class="form-control" min="2016-02-14" max="<?php echo date('Y-m-d') ?>" id="date" value="<?php echo zbase_form_old('date', date('Y-m-d')) ?>" name="date" placeholder="Date Paid" />
					<span class="help-block">Date in format of <strong>mm/dd/yy</strong>. Example: <?php echo date('m/d/Y') ?> (<?php echo date('F d, Y') ?>)</span>
				</div>
				<div class="form-group">
					<label for="file">Upload copy of your deposit or payment slip</label>
					<input type="file" id="file" name="file" />
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" required="required" id="agreement" name="agreement" value="1" />All information I entered is correct.
					</label>
				</div>
				<hr />
				<div class="form-action">
					<button id="btnOrderUpdateSubmit" class="btn btn-success">Submit</button>
				</div>
			</form>
		</div>
	</div>
<?php endif; ?>