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
require_once __DIR__ . '/' . zbase_framework() . '/helpers.php';

/**
 * The Zivsluck Tag/Prefix
 *
 * @return string
 */
function zivsluck_tag()
{
	return strtolower('zivsluck');
}

/**
 * Check if promotion is enabled
 * @return boolean
 */
function zivsluck_promotion()
{
	return zbase_config_get('zivsluck.promotion.enable', false);
}
