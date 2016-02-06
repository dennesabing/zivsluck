<?php

namespace Zivsluck;

/**
 * Zivsluck Main
 *
 *
 * @link http://zbase.dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2016 ClaremontDesign/MadLabs-Dx
 * @file Main.php
 * @project Zivsluck
 * @package Zivsluck
 */
use Zbase\Interfaces;

class Zivsluck implements Interfaces\ZbaseInterface
{

	/**
	 * Return all configuration files included for this packages
	 * @return array
	 */
	public function config()
	{
		return [__DIR__ . '/../config/config.php'];
	}

	/**
	 * Path to this package src
	 * @return string
	 */
	public function path()
	{
		return __DIR__ . '/../';
	}

}
