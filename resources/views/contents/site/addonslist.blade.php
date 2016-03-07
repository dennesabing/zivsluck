<div class="row">
	<div class="col-md-12">
		<?php
		for ($ic = 1; $ic <= 103; $ic++)
		{
			$folder = zbase_public_path() . '/zbase/assets/zivsluck/img/addons/';
			$file = 'icon' . $ic . '.png';
			?>
			<?php
			if(file_exists($folder . $file))
			{
				?>
				<?php
				$name = $label = 'icon' . $ic;
				$addonHeight = 32;
				$addonWidth = 32;
				?>
				<div class="addon col-md-2 col-xs-3" style="margin:20px;text-align:center;">
					<img class="img-responsive" src="/zbase/assets/zivsluck/img/addons/<?php echo $file ?>"  alt="<?php echo $name; ?>">
				</div>
				<?php
			}
		}
		?>
	</div>
</div>