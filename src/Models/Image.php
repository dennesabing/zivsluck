<?php

namespace Zivsluck\Models;

/**
 * Zivsluck-Watermark
 *
 * Place a zivsluck watermark on an image
 *
 * @link http://zbase.dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2016 ClaremontDesign/MadLabs-Dx
 * @file Watermark.php
 * @project Zivsluck
 * @package Zivsluck/Model
 */
class Image
{

	/**
	 * Path to Watermark image
	 * @var string
	 */
	protected $watermark = null;

	/**
	 * The Image Resource
	 * @var string
	 */
	protected $im = null;

	public function __construct()
	{
		$this->watermark = zivsluck()->path() . 'resources/assets/img/imagewatermark1.png';
	}

	/**
	 * Add watermark to image
	 * @param string $img
	 */
	public function watermark($img)
	{
		if(file_exists($img))
		{
			$this->im = \Image::make($img);
			$watermark = \Image::make($this->watermark);
			$this->im->insert($watermark, 'center');
		}
	}

	/**
	 * Serve the image
	 */
	public function serve()
	{
		header('Content-Type: image/png');
		echo $this->im->encode('png');
	}

	/**
	 * Serve the image
	 */
	public function download()
	{
		ini_set('display_errors', '0');
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Content-Type: image/png");
		header('Content-Disposition: attachment; filename=' . md5(time()) . '.png');
		echo $this->im->encode('png');
		exit();

	}

}
