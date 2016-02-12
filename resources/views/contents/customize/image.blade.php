<?php

if(empty($create))
{
	if(!empty($font))
	{
		$fontMaps = zbase_config_get('zivsluck.fontmaps');
		if($font == 'all')
		{
			foreach ($fontMaps as $font => $fontDetails)
			{
				if(!empty($fontDetails['enable']))
				{
					$fontName = $fontDetails['name'];
					echo '<div class="col-md-6 imagePreviews" onclick="zivsluck_selectImage(\'' . $font . '\')" title="Click to choose font: ' . $fontName . '">'
					. '<img src="' . zbase_url_from_route('createImage', compact('name', 'font', 'material')) . '" alt="' . $fontName . '" data-font="' . $font . '" data-fontname="' . $fontName . '"/>'
					. zbase_csrf_token_field() . '</div>';
				}
			}
		}
		else
		{
			$fontDetails = $fontMaps[$font];
			$orderData = null;
			$orderId = null;
			if(!empty($fontDetails['enable']))
			{
				if(!empty($options['step']))
				{
					if($options['step'] == 5)
					{
						$data = [
							'status' => 1,
							'text' => $name,
							'font' => $font,
							'material' => $material,
							'chain' => $options['chain'],
							'chain_length' => $options['chainLength'],
							'name' => $options['first_name'] . ' ' . $options['last_name'],
							'email' => $options['email'],
							'details' => json_encode($options)
						];
						$orderData = zbase_entity('custom_orders')->create($data);
						$options['oid'] = $orderData->maskedId();
					}
				}
				$url = zbase_url_from_route('createImage', compact('name', 'font', 'material')) . '?' . zbase_url_array_to_get($options);
				$fontName = $fontDetails['name'];
				$str = '<div class="imagePreview"><div id="droppableWrapper"><div id="droppableWindow"></div></div>'
						. '<img src="' . $url . '" alt="' . $fontName . '" data-font="' . $font . '" data-fontname="' . $fontName . '"/><br /><br />';
				if(!empty($orderData))
				{
					$orderData->sendOrderToShane();
					$str .= '<br /><button onclick="zivsluck_orderDownload(\'' . $orderData->maskedId() . '\')" class="btn btn-info">Save Order</button>';
					$str .= '&nbsp;<a href="' . zbase_url_create('customize') . '" class="btn btn-success">Create again!</a>';
				}
				$str .= zbase_csrf_token_field();
				$str .= '</div>';
				echo $str;
			}
		}
	}
}
if(!empty($create))
{
	$createModel = new \Zivsluck\Models\CreateText();
	$createModel->create($name, $font, $material, $options);
	$createModel->serve();
}