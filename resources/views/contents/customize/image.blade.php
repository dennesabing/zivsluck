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
					echo '<div class="" style="padding-top:20px;border-bottom:2px solid #EBEBEB;width:100%;text-align:center;">'
					. '<img src="' . zbase_url_from_route('createImage', array('name' => $name, 'font' => $font)) . '" alt="' . $fontName . '" />'
					. '</div>';
				}
			}
		}
		else
		{
			$fontDetails = $fontMaps[$font];
			if(!empty($fontDetails['enable']))
			{
				$fontName = $fontDetails['name'];
				echo '<div class="" style="padding-top:20px;border-bottom:2px solid #EBEBEB;width:100%;text-align:center;">'
				. '<img src="' . zbase_url_from_route('createImage', array('name' => $name, 'font' => $font)) . '" alt="' . $fontName . '" />'
				. '</div>';
			}
		}
	}
}
if(!empty($create))
{
	$createModel = new \Zivsluck\Models\CreateText();
	$createModel->create($name, $font);
	$createModel->serve();
}