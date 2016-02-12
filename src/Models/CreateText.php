<?php

namespace Zivsluck\Models;

/**
 * Zivsluck-CreateText
 *
 * Create a necklace with a selected font
 *
 * @link http://zbase.dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2016 ClaremontDesign/MadLabs-Dx
 * @file CreateText.php
 * @project Zivsluck
 * @package Zivsluck/Model
 */
class CreateText
{

	/**
	 * The default font
	 */
	const DEFAULT_FONT = 'deftone';

	/**
	 * Map of Fonts
	 * @var array
	 */
	protected $fontMaps = null;

	/**
	 * The Selected font
	 * @var string
	 */
	protected $font = null;

	/**
	 * The Text to be created
	 * @var string
	 */
	protected $text = null;

	/**
	 * order Data
	 * @var \Zivsluck\Entity\Order
	 */
	protected $orderData = null;

	/**
	 * The Image
	 * @var
	 */
	protected $_image = null;

	public function __construct()
	{
		$this->fontMaps = zbase_config_get('zivsluck.fontmaps');
	}

	public function create($text, $font = null, $material = null, $options = null)
	{
		if(!empty($text))
		{
			$this->setText($text);
		}
		if(!empty($font))
		{
			$this->setFont($font);
		}
		$dealerCopy = !empty($options['dealerCopy']) ? true : false;
		/**
		 * <span id="IL_AD8" class="IL_AD">Setup</span> some custom variables for creating our font and image.
		 */
		$chain = !empty($options['chain']) ? $options['chain'] : false;
		$chainLength = !empty($options['chainLength']) ? $options['chainLength'] : false;
		$maxLetter = 7;
		$pricePerLetter = 20;
		$boxWidth = 280;
		$boxHeight = 200;
		$borderWidth = 10;
		$hasBorder = !empty($dealerCopy) ? true : false;
		$hasDetails = false;
		if(!empty($chain) && !empty($chainLength))
		{
			$hasDetails = true;
			$boxWidth = 280;
			$boxHeight = 600;
			$chainFile = zbase_config_get('zivsluck.chains.' . strtolower($material) . '.' . strtolower($chain) . '.file', false);
			$chainImage = zbase_public_path() . '/zbase/assets/zivsluck/img/chain/' . $chainFile;
		}

		$letterPrice = 0;
		$shippingFee = 0;
		$hasShipping = false;
		$total = 0;
		$courier = !empty($options['courier']) ? $options['courier'] : false;
		if(!empty($courier))
		{
			$courier = zbase_config_get('zivsluck.shipping.' . strtolower($courier), false);
			if(!empty($courier))
			{
				$deliveryMode = !empty($options['deliveryMode']) ? $options['deliveryMode'] : false;
				$hasShipping = true;
				$courierName = $courier['name'];
				$shippingFee = $courier['fee'];
				$courierText = $courierName . ' - ' . ($deliveryMode == 'doortodoor' ? 'Door-to-Door' : 'PickUp');

				$boxWidth = 280;
				$boxHeight = 800;
			}
		}
		if(!empty($dealerCopy))
		{
			$boxWidth = 280;
			$boxHeight = 500;
		}
		$price = zbase_config_get('zivsluck.fontmaps.' . $font . '.material.' . $material . '.price', false);
		if(empty($price))
		{
			if($material == 'stainless')
			{
				$price = 350;
			}
			elseif($material == 'silver')
			{
				$price = 700;
			}
			else
			{
				$price = 700;
			}
		}
		$fontSize = 30; // font size
		$chars = 30; // prevent really long strings
		$fontFile = zbase_public_path() . '/zbase/assets/zivsluck/fonts/deftonestylus.ttf'; // the text file to be used
		$verdanaFont = zbase_public_path() . '/zbase/assets/zivsluck/fonts/verdana.ttf'; // the text file to be used
		$textureFile = zivsluck()->path() . 'resources/assets/img/texture/' . strtolower($material) . '.png'; // the texture file
		$logo = zivsluck()->path() . 'resources/assets/img/texture/logo.png'; // the texture file
		$fontDetails = $this->getFontDetails();
		$customerNote = !empty($options['customerNote']) ? $options['customerNote'] : '';
		if(!empty($fontDetails['enable']))
		{
			$fontFile = zbase_public_path() . '/zbase/assets/zivsluck/fonts/' . $fontDetails['file'];
			if(!empty($fontDetails['fontsize']))
			{
				$fontSize = $fontDetails['fontsize'];
			}
		}
		else
		{
			$fontFile = $verdanaFont;
			$text = 'FONT NOT AVAILABLE.';
		}
		/**
		 * Get text string that is <span id="IL_AD7" class="IL_AD">passed</span> to this file and clean it up.
		 */
		$text = $this->getText();
		$text = trim(strip_tags(html_entity_decode($text)));
		$text = trim(preg_replace('/ss+/', ' ', $text));
		$text = ( strlen($text) > $chars ) ? substr($text, 0, $chars) . '..' : $text;


		/**
		 * Read the TTF file and get the width and height of our font.
		 */
		$box = imagettfbbox($fontSize, 0, $fontFile, $text);
		$width = abs($box[2] - $box[0]) + 50;
		/**
		 * Create <span id="IL_AD2" class="IL_AD">the blank</span> image, alpha channel and colors.
		 */
		// http://stackoverflow.com/questions/26288347/php-gd-complex-stacking-multiple-layers
		// $clipart = imagecreatefrompng(zivsluck()->path() . 'resources/assets/img/createBaseImage.png');
		$bgTexture = imagecreatefrompng($textureFile);
		$logo = imagecreatefrompng($logo);
		$white = imagecolorallocate($bgTexture, 255, 255, 255);
		if($dealerCopy)
		{
			// Canvass
			$bgTexture = imagecreatetruecolor($boxWidth - ($borderWidth * 2), $boxHeight - ($borderWidth * 2));
			// Background Color
			$white = imagecolorallocate($bgTexture, 255, 255, 204);
		}
		/**
		 * Create text on a white background
		 */
		imagefill($bgTexture, 0, 0, $white);
		$textColorBlack = imagecolorallocate($bgTexture, 0, 0, 0);

		if($hasDetails)
		{
			if($hasShipping)
			{
				$posY = ($boxHeight / 2) + 10 - 300;
			}
			else
			{
				$posY = ($boxHeight / 2) + 10 - 200;
			}
		}
		else
		{
			$posY = ($boxHeight / 2) + 10;
		}
		$posX = ($boxWidth / 2) - ($width / 2) + 10;
		if(!empty($hasBorder))
		{
			$posY = ($boxHeight / 2) + 10 - 150 - $borderWidth;
			$posX = ($boxWidth / 2) - ($width / 2);
		}
		imagettftext($bgTexture, $fontSize, 0, $posX, $posY, $textColorBlack, $fontFile, $text);

		$im = imagecreatetruecolor($boxWidth, $boxHeight);
		if(!empty($dealerCopy))
		{

			imagecopy($im, $bgTexture, $borderWidth, $borderWidth, 0, 0, $boxWidth, $boxHeight);
		}
		else
		{
			imagecopy($im, $bgTexture, 0, 0, 0, 0, $boxWidth, $boxHeight);
		}
		$img = imagecreatetruecolor($boxWidth, $boxHeight);
		imagecopymerge($img, $im, 0, 0, 0, 0, $boxWidth, $boxHeight, 100);
		if($hasBorder)
		{
			imagecopy($img, $logo, 234, $boxHeight - 45, 0, 0, imagesx($logo), imagesy($logo));
		}
		else
		{
			imagecopy($img, $logo, 245, $boxHeight - 35, 0, 0, $boxWidth, $boxHeight);
		}

		if(!empty($dealerCopy))
		{
			// Add border
			imagefilltoborder($img, 1, 1, $textColorBlack, $white);
		}

		$totalAddon = 0;
		if(!empty($options['addon']))
		{
			$addonDroppableTop = zbase_config_get('zivsluck.addons.configuration.droppable.top') - 5;
			$addonDroppableLeft = zbase_config_get('zivsluck.addons.configuration.droppable.left') - 5;
			$addonDroppableHeight = zbase_config_get('zivsluck.addons.configuration.droppable.height');
			$addonDroppableWidth = zbase_config_get('zivsluck.addons.configuration.droppable.width');
			$addons = explode('|', $options['addon']);
			foreach ($addons as $addon)
			{
				if(!empty($addon))
				{
					$addon = explode('-', $addon);
					$addonName = !empty($addon[0]) ? $addon[0] : false;
					$addonEnabled = zbase_config_get('zivsluck.addons.' . $addonName . '.enable');
					$addonFile = zivsluck()->path() . 'resources/assets/img/addons/' . zbase_config_get('zivsluck.addons.' . $addonName . '.file');
					$addonPosition = !empty($addon[1]) ? explode(',', $addon[1]) : false;
					$addonSize = !empty($addon[2]) ? explode('x', $addon[2]) : false;
					if(!empty($addonEnabled) && file_exists($addonFile))
					{
						$totalAddon++;
						imagecopy($img, imagecreatefrompng($addonFile), $addonPosition[0] + $addonDroppableLeft, $addonPosition[1] + $addonDroppableTop, 0, 0, $addonSize[0], $addonSize[1]);
					}
				}
			}
		}

		/**
		 * Label
		 */
		if($hasDetails)
		{
			if(empty($dealerCopy))
			{
				$chainImage = imagecreatefrompng($chainImage);
				$total = $price;
				$letterCount = strlen($text);
				$addonPrice = 0;
				if($letterCount < $maxLetter)
				{
					if(!empty($totalAddon))
					{
						$addonCount = ($letterCount + $totalAddon) - $maxLetter;
						$addonPrice = $addonCount * 20;
						$total += $addonPrice;
					}
				}
				if($letterCount > $maxLetter)
				{
					$letterPrice = ($letterCount - $maxLetter) * 20;
					$total += $letterPrice;
					$addonPrice = $totalAddon * 20;
					$total += $addonPrice;
				}
				$total += $shippingFee;
				if(!empty($options['oid']))
				{
					imagettftext($img, 12, 0, 15, 180, $textColorBlack, $verdanaFont, 'ORDER ID: ' . $options['oid']);
				}
				imagecopy($img, $chainImage, 15, 295, 0, 0, imagesx($chainImage), imagesy($chainImage));
			}

			if(!empty($dealerCopy))
			{
				imagettftext($img, 9, 0, 25, 200, $textColorBlack, $verdanaFont, 'Text: ' . $text);
				imagettftext($img, 9, 0, 25, 220, $textColorBlack, $verdanaFont, 'Font: ' . $fontDetails['name']);
				imagettftext($img, 9, 0, 25, 240, $textColorBlack, $verdanaFont, 'Material: ' . ucfirst($material));
				imagettftext($img, 9, 0, 25, 260, $textColorBlack, $verdanaFont, 'Chain: ' . strtoupper($chain));
				imagettftext($img, 9, 0, 25, 280, $textColorBlack, $verdanaFont, 'Chain Length: ' . $chainLength . '"');
				if(!empty($customerNote))
				{
					imagettftext($img, 9, 0, 25, 300, $textColorBlack, $verdanaFont, 'Customer Note:');
					imagettftext($img, 8, 0, 25, 320, $textColorBlack, $verdanaFont, wordwrap($customerNote, 40));
				}
			}
			else
			{
				imagettftext($img, 9, 0, 15, 200, $textColorBlack, $verdanaFont, 'Text: ' . $text);
				imagettftext($img, 9, 0, 15, 215, $textColorBlack, $verdanaFont, 'Font: ' . $fontDetails['name']);
				imagettftext($img, 9, 0, 15, 230, $textColorBlack, $verdanaFont, 'Character: ' . strlen($text));
				imagettftext($img, 9, 0, 15, 245, $textColorBlack, $verdanaFont, 'Symbols: ' . $totalAddon);
				imagettftext($img, 9, 0, 15, 260, $textColorBlack, $verdanaFont, 'Material: ' . ucfirst($material));
				imagettftext($img, 9, 0, 15, 275, $textColorBlack, $verdanaFont, 'Chain Length: ' . $chainLength . '"');
				imagettftext($img, 9, 0, 15, 290, $textColorBlack, $verdanaFont, 'Chain: ' . strtoupper($chain));

				imagettftext($img, 9, 0, 15, 430, $textColorBlack, $verdanaFont, ucfirst($material) . ' Price: Php ' . number_format($price, 2));
				imagettftext($img, 9, 0, 15, 445, $textColorBlack, $verdanaFont, 'Characters: Php ' . number_format($letterPrice, 2));
				imagettftext($img, 9, 0, 15, 460, $textColorBlack, $verdanaFont, 'Symbols: Php ' . number_format($addonPrice, 2));
				if($hasShipping)
				{
					imagettftext($img, 9, 0, 15, 480, $textColorBlack, $verdanaFont, 'Shipping: Php ' . number_format($shippingFee, 2));
					imagettftext($img, 9, 0, 15, 495, $textColorBlack, $verdanaFont, 'Courier: ' . $courierText);
					imagettftext($img, 9, 0, 15, 570, $textColorBlack, $verdanaFont, 'Shipping Information:');
					imagettftext($img, 9, 0, 15, 590, $textColorBlack, $verdanaFont, $options['first_name'] . ' ' . $options['last_name']);
					imagettftext($img, 9, 0, 15, 605, $textColorBlack, $verdanaFont, $options['address']);
					imagettftext($img, 9, 0, 15, 620, $textColorBlack, $verdanaFont, $options['addressb']);
					imagettftext($img, 9, 0, 15, 635, $textColorBlack, $verdanaFont, $options['city']);
					imagettftext($img, 8, 0, 15, 680, $textColorBlack, $verdanaFont, $options['fb']);
					imagettftext($img, 8, 0, 15, 695, $textColorBlack, $verdanaFont, 'Phone: ' . $options['phone']);
					if(!empty($options['email']))
					{
						imagettftext($img, 8, 0, 15, 710, $textColorBlack, $verdanaFont, 'Email: ' . $options['email']);
					}
					if(!empty($options['oid']))
					{
						imagettftext($img, 8, 0, 15, 748, $textColorBlack, $verdanaFont, 'Order Link: ' . zbase_url_create('order', array('id' => $options['oid'])));
					}
					imagettftext($img, 8, 0, 15, 760, $textColorBlack, $verdanaFont, 'Date: ' . date('F d, Y h:i A'));
				}
				imagettftext($img, 18, 0, 15, 535, $textColorBlack, $verdanaFont, 'Total: Php ' . number_format($total, 2));
			}
		}
		else
		{
			imagettftext($img, 9, 0, 15, 23, $textColorBlack, $verdanaFont, 'Font: ' . $fontDetails['name']);
		}
		if(!empty($hasBorder))
		{
			imagettftext($img, 7, 0, 15, $boxHeight - (10 + $borderWidth), $textColorBlack, $verdanaFont, 'Create your necklace at http://zivsluck.com');
		}
		else
		{
			imagettftext($img, 7, 0, 15, $boxHeight - 10, $textColorBlack, $verdanaFont, 'Create your necklace at http://zivsluck.com');
		}
		$this->_image = $img;
		return $this;
	}

	/**
	 * Display image
	 */
	public function serve()
	{
		/**
		 * Turn off PHP errors, Disable caching and set the Content-Type.
		 */
		ini_set('display_errors', '0');

		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Content-Type: image/png");
		imagepng($this->_image);
		imagedestroy($this->_image);
		/**
		 * Output the image and do a little cleanup.
		 */
		exit();
	}

	public function download()
	{
		/**
		 * Turn off PHP errors, Disable caching and set the Content-Type.
		 */
		ini_set('display_errors', '0');

		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Content-Type: image/png");
		header('Content-Disposition: attachment; filename=zivsluck-order-' . $this->orderData->maskedId() . '.png');
		imagepng($this->_image);
		imagedestroy($this->_image);
		/**
		 * Output the image and do a little cleanup.
		 */
		exit();
	}

	/**
	 * Return the Font Details
	 * @param type $font
	 * @return boolean
	 */
	public function getFontDetails($font = null)
	{
		if(empty($font))
		{
			$font = $this->getFont();
		}
		if(array_key_exists($font, $this->fontMaps))
		{
			return $this->fontMaps[$font];
		}
		return false;
	}

	function getOrderData()
	{
		return $this->orderData;
	}

	function setOrderData(\Zivsluck\Entity\Laravel\Order $orderData)
	{
		$this->orderData = $orderData;
	}

	/**
	 *
	 * @see $this->font
	 */
	public function getFont()
	{
		return $this->font;
	}

	/**
	 * @see $this->text
	 * @return strng
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 *
	 * @see $this->font
	 */
	public function setFont($font)
	{
		$this->font = $font;
		return $this;
	}

	/**
	 * @see $this->text
	 */
	public function setText($text)
	{
		$this->text = $text;
		return $this;
	}

}

function imagettftexttexture(&$im, &$textureim, $size, $angle, $x, $y, $fontfile, $text)
{
	$width = imagesx($im); // Get the width of the image
	$height = imagesy($im); // Get the height of the image
	$buffer = imagecreate($width, $height); // Create the buffer image
	$tile_w = imagesx($textureim); // Get the width of the texture image
	$tile_h = imagesy($textureim); // Get the height of the texture image
	$fits_x = (int) ($im_w / $tile_w); // Find out how many times it fits horizontally
	$fits_y = (int) ($im_h / $tile_h); // Find out how many times it fits vertically
	for ($i = 0; $i <= $fits_x; $i++)
	{ // Loop through every time (and another, for extra space) it fits horizontally
		$x = (int) ($tile_w * $i); // Change the X location based on where in the loop it is
		for ($i2 = 0; $i2 <= $fits_y; $i2++)
		{ // Loop through every time it fits vertically
			$y = (int) ($tile_h * $i2); // Change the Y location
			$copy = imagecopy($im, $textureim, $x, $y, 0, 0, $tile_w, $tile_h); // Copy the image to the X,Y location
		}
	}
	$pink = imagecolorclosest($im, 255, 0, 255); // Create magic pink, a color commonly used for masks
	$trans = imagecolortransparent($im, $pink); // Make magic pink the transparent color
	imagettftext($im, $size, $angle, $x, $y, -$pink, $fontfile, $text); // Draw text over magic pink without aliasing
	imagecopy($buffer, $im, 0, 0, 0, 0, $width, $height); // Copy the main image onto the buffer
	imagecopy($im, $buffer, 0, 0, 0, 0, $width, $height); // Copy the buffer back onto the main image
	imagedestroy($buffer); // Destroy the buffer
}
