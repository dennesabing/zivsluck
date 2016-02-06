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
	'zivsluck' => [
		'fontmaps' => [
			'deftone' => [
				'file' => 'deftonestylus.ttf',
				'name' => 'Deftone Stylus',
				'enable' => true
			],
			'scriptina' => [
				'file' => 'scriptina.ttf',
				'name' => 'Scriptina',
				'enable' => true
			],
			'verdana' => [
				'file' => 'verdana.ttf',
				'name' => 'Verdana',
				'enable' => true
			],
		],
	],
	'controller' => [
		'class' => [
			'create' => [
				'name' => Zivsluck\Http\Controllers\__FRAMEWORK__\CreateController::class,
				'enable' => true
			],
		],
	],
	'view' => [
		'plugins' => [],
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
		'index' => [
			'controller' => [
				'name' => 'create',
				'method' => 'index',
				'enable' => true
			],
			'url' => '/',
			'enable' => true
		],
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
				'name' => 'create',
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
		'createImage' => [
			'controller' => [
				'name' => 'create',
				'method' => 'createImage',
				'enable' => true
			],
			'url' => '/c/{name?}/{font?}',
			'enable' => true
		],
	]
];
