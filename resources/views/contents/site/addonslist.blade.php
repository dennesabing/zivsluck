<div class="row">
	<div class="col-md-12">
		<?php
		$addons = zbase_config_get('zivsluck.addons', []);
		if(!empty($addons))
		{
			foreach ($addons as $name => $addon)
			{
				if(!empty($addon['enable']))
				{
					?>
					<div class="addon col-md-2 col-xs-3 thumbnail" style="margin:20px;text-align:center;">
						<img class="img-responsive" src="/zbase/assets/zivsluck/img/addons/<?php echo $addon['file']; ?>" alt="<?php echo $addon['name']; ?>">
						<span><?php echo $name ?></span>
					</div>
					<?php
				}
			}
		}
		?>
	</div>
</div>