<?php

/**
 * Main configuration
 *
 * @link http://zbase.dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2016 ClaremontDesign/MadLabs-Dx
 * @file config.php
 * @project Zbase
 * @package config
 */
$config = [];
return array_replace_recursive($config, require __DIR__ . '/zivsluck.php', require __DIR__ . '/chains.php', require __DIR__ . '/fonts.php', require __DIR__ . '/addons.php', require __DIR__ . '/entity.php');
