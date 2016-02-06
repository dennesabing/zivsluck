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
	protected $fontMaps = [
		'deftone' => [
			'file' => 'deftonestylus.ttf',
			'name' => 'Deftone Stylus'
		],
		'scriptina' => [
			'file' => 'scriptina.ttf',
			'name' => 'Scriptina'
		],
	];

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
		$boxWidth = 500;
		$boxHeight = 200;
		$size = 48; // font size
		$chars = 30; // prevent really long strings
		$fontFile = zivsluck()->path() . 'storage/fonts/deftonestylus.ttf'; // the text file to be used
		$fontDetails = $this->getFontDetails();
		if(!empty($fontDetails))
		{
			$fontFile = zivsluck()->path() . 'storage/fonts/' . $fontDetails['file'];
		}
		$color = array(0, 0, 0); // Color[ red, green, blue ]
		$shade = array(0, 0, 0, 1); // Shadow [ red, green, blue, distance ]
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
		$box = imagettfbbox($size, 0, $fontFile, $text);
		$width = abs($box[2] - $box[0]) + 4;
		$height = abs($box[5] - $box[3]) + 10;

		/**
		 * Create <span id="IL_AD2" class="IL_AD">the blank</span> image, alpha channel and colors.
		 */
		//$im = imagecreatetruecolor($width, $height);
		$im = imagecreatetruecolor($boxWidth, $boxHeight);
		$alpha = imagesavealpha($im, true);
		$trans = imagecolorallocatealpha($im, 0, 0, 0, 27);
		$fill = imagefill($im, 0, 0, $trans);
		$fg = imagecolorallocate($im, $color[0], $color[1], $color[2]);
		$bg = imagecolorallocate($im, $shade[0], $shade[1], $shade[2]);

		/**
		 * Finally, we add the font and the shadow to our new image.
		 */
		$posY = ($boxHeight / 2);
		$posX = 100;
		imagettftext($im, $size, 0, $posX, $posY, $bg, $fontFile, $text);
		$this->_image = $im;
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
