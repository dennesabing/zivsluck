<?php
$fontMaps = zbase_config_get('zivsluck.fontmaps');
$dataCustomize = [];
if(zbase_is_dev())
{
	$dataCustomize = [
		'name' => 'dennes'
	];
}
?>
<div id="customizeForm">
	<h1>Create your own necklace!</h1>
	<a href="/promo" title="View promo details"><img src="/zbase/assets/zivsluck/img/promo/100off.png" alt="100.00 Off on your next order" class="img-shadow img-responsive"></a>
	<br />
	<div class="form-group" id="form-group-name">
		<label for="name">Type the name to view your name on any font</label>
		<input type="text" required="required" minlength="1" class="form-control" id="name" value="<?php echo!empty($dataCustomize['name']) ? $dataCustomize['name'] : '' ?>" name="name" placeholder="Type your name" />
		<span class="help-block">Maximum of 7 letters and symbols. Additional letters/symbols at Php 20.00 each.</span>
		<span class="help-block">The name preview is only to view how your name looks in the font of the necklace that you have chosen.</span>
	</div>
	<button id="btnCustomize" class="btn btn-success">Create my necklace</button>
	<br />
	<br />
	<br />

	<div class="form-group"  id="form-group-font">
		<label for="font">Font</label>
		<?php if(!empty($fontMaps)): ?>
			<select name="font" id="font" class="form-control">
				<option value="all">All</option>
				<?php foreach ($fontMaps as $fontName => $fontDetails): ?>
					<?php if(!empty($fontDetails['enable'])): ?>
						<option value="<?php echo $fontName ?>"><?php echo $fontDetails['name'] ?></option>
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
		<?php endif; ?>
	</div>

	<div class="form-group"  id="form-group-material">
		<label for="material">Material</label>
		<select name="material" id="material" class="form-control">
			<option value="stainless">Stainless</option>
			<option value="silver">Silver</option>
			<option value="goldplated">Gold Plated</option>
		</select>
	</div>

	<div class="form-group"  id="form-group-chain"  style="display: none;">
		<div class="form-group"  >
			<label for="chain">Chain</label>
		</div>
		<div class="row">
			<?php
			$chains = zbase_config_get('zivsluck.chains', false);
			if(!empty($chains))
			{
				foreach ($chains as $chainType => $chainTypes)
				{
					foreach ($chainTypes as $chainId => $chain)
					{
						if(!empty($chain['enable']))
						{
							?>
							<div onclick="zivsluck_selectChain('<?php echo $chain['name'] ?>');" data-name="<?php echo $chain['name'] ?>" class="col-md-4 chain-type-group-<?php echo (!empty($chain['group']) ? $chain['group'] : null) ?> chain-type-<?php echo $chainId ?> chain-type chain-type-<?php echo $chainType ?>">
								<label>
									<input type="radio" name="chainText" value="<?php echo $chain['name'] ?>">&nbsp;<?php echo $chain['name'] ?>
									<br />
									<img src="/zbase/assets/zivsluck/img/chain/<?php echo $chain['file'] ?>" alt="<?php echo $chain['name'] ?>" />
								</label>
							</div>
							<?php
						}
					}
				}
			}
			?>
		</div>
	</div>

	<div class="form-group"  id="form-group-chain-length" style="display: none;">
		<label for="chain-length">Chain Length</label>
		<select name="chain-length" id="chain-length" class="form-control">
			<option value="13">13 inches</option>
			<option value="14">14 inches</option>
			<option value="15">15 inches</option>
			<option value="16">16 inches</option>
			<option value="17">17 inches</option>
			<option value="18">18 inches</option>
		</select>
		<span id="chain-lengthHelp" class="help-block">For chain length reference, <a href="javascript:void(0)" onclick="zivsluck_chainLengthReference();">click here</a>.</span>
		<div id="chain-length-reference" style="display: none;">
			<img src="/zbase/assets/zivsluck/img/chain-length.png" alt="Chain Length Reference" />
		</div>
	</div>
	<input type="hidden" name="chain" id="chain" value="" />
</div>