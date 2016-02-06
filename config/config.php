<?php

/**
 * Zbase-Zivsluck
 *
 * @link http://dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2015 ClaremontDesign/MadLabs-Dx
 * @version 0.0.0.1
 * @since Feb 6, 2016 1:09:50 PM
 * @file config.php
 * @project Zivsluck
 * @package Zivsluck
 */
return [
	'controller' => [
		'class' => [
			'create' => [
				'name' => Zivsluck\Http\Controllers\__FRAMEWORK__\CreateController::class,
				'enable' => true
			],
		],
	],
	'view' => [
		'templates' => [
			'front' => [
				'package' => zivsluck_tag()
			],
		],
		'default' => [
			'title' => [
				'prefix' => '',
				'suffix' => 'Personalized Necklace by ZivsLuck'
			],
		],
	],
	'routes' => [
		'zivsluck' => [
			'view' => [
				'name' => zivsluck_tag() . '::contents.zivsluck',
				'enable' => true
			],
			'url' => '/zivsluck',
			'enable' => true
		],
		'customize' => [
			'controller' => [
				'name' => 'customize',
				'method' => 'index',
				'enable' => true
			],
			'url' => '/customize',
			'enable' => true
		],
		'create' => [
			'controller' => [
				'name' => 'create',
				'method' => 'create',
				'enable' => true
			],
			'url' => '/create/{name?}/{font?}',
			'enable' => true
		],
	]
];
