<?php

/**
 * Zivsluck Helpers
 *
 * Functions and Helpers
 *
 * @link http://zbase.dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2016 ClaremontDesign/MadLabs-Dx
 * @file {Filename}.php
 * @project Zivsluck
 * @package Zivsluck
 */


/**
 * Return Zivsluck Main model
 * @return Zbase\Interfaces\ZbaseInterface
 */
function zivsluck()
{
	return app('zivsluck');
}