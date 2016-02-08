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
	 * The Image
	 * @var
	 */
	protected $_image = null;

	public function __construct()
	{
		$this->fontMaps = zbase_config_get('zivsluck.fontmaps');
	}

	public function create($text, $font = null)
	{
		if(!empty($text))
		{
			$this->setText($text);
		}
		if(!empty($font))
		{
			$this->setFont($font);
		}
		/**
		 * <span id="IL_AD8" class="IL_AD">Setup</span> some custom variables for creating our font and image.
		 */
		$boxWidth = 300;
		$boxHeight = 200;
		$fontSize = 30; // font size
		$chars = 30; // prevent really long strings
		$useTexture = false;
		$fontFile = zbase_public_path() . '/zbase/assets/zivsluck/fonts/deftonestylus.ttf'; // the text file to be used
		$verdanaFont = zbase_public_path() . '/zbase/assets/zivsluck/fonts/verdana.ttf'; // the text file to be used
		$textureFile = zivsluck()->path() . 'resources/assets/img/texture/gold1.png'; // the texture file
		$fontDetails = $this->getFontDetails();
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
		// $height = abs($box[5] - $box[3]) + 100;

		/**
		 * Create <span id="IL_AD2" class="IL_AD">the blank</span> image, alpha channel and colors.
		 */
		// $im = imagecreatetruecolor($width, $height);
		// $im = imagecreatetruecolor($boxWidth, $boxHeight);
		// http://stackoverflow.com/questions/26288347/php-gd-complex-stacking-multiple-layers
		$clipart = imagecreatefrompng(zivsluck()->path() . 'resources/assets/img/createBaseImage.png');

		/**
		 * Create text on a white background
		 */
		// $clipart = imagecreatetruecolor($boxWidth, $boxHeight);
		$white = imagecolorallocate($clipart, 255, 255, 255);
		imagefill($clipart, 0, 0, $white);
		$textColor = imagecolorallocate($clipart, 0, 0, 0);
		$posY = ($boxHeight / 2);
		$posX = ($boxWidth / 2) - ($width / 2) + 25;
		imagettftext($clipart, $fontSize, 0, $posX, $posY, $textColor, $fontFile, $text);
		// imagettftext($clipart, $fontSize, 0, $posX + 1, $posY + 1, $textColor, $fontFile, $text);

		$texture = imagecreatefrompng($textureFile);
		$im = imagecreatetruecolor($boxWidth, $boxHeight);
		imagecopy($im, $clipart, 0, 0, 0, 0, $boxWidth, $boxHeight);
		if($useTexture)
		{
			imagecolortransparent($im, imagecolorclosest($clipart, 0, 0, 0));
		}


		$img = imagecreatetruecolor($boxWidth, $boxHeight);
		imagecopymerge($img, $texture, 0, 50, 0, 0, $boxWidth, $boxHeight, 100);
		imagecopymerge($img, $im, 0, 0, 0, 0, $boxWidth, $boxHeight, 100);
		/**
		 * Label
		 */
		imagettftext($img, 11, 0, 20, 23, $textColor, $verdanaFont, 'Font Name: ' . $fontDetails['name']);
		imagettftext($img, 7, 0, 30, 180, $textColor, $verdanaFont, 'Create your necklace at http://zivsluck.com');
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
