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
			'angel-tears' => [
				'file' => 'angel-tears.ttf',
				'name' => 'Angel Tears',
				'enable' => true,
				'fontsize' => 60
			],
			'brush-script' => [
				'file' => 'brush-script.ttf',
				'name' => 'Soho Script',
				'enable' => true,
				'fontsize' => 35
			],
			'classic-cursive' => [
				'file' => 'classic-cursive.ttf',
				'name' => 'Classic Cursive',
				'enable' => true,
				'fontsize' => 40
			],
			'commercial-script' => [
				'file' => 'commercial-script.ttf',
				'name' => 'Commercial Script',
				'enable' => true,
				'fontsize' => 35
			],
			'deftone' => [
				'file' => 'deftone-stylus.ttf',
				'name' => 'Deftone Stylus',
				'enable' => true,
				'fontsize' => 30
			],
			'lauren-script' => [
				'file' => 'lauren-script.ttf',
				'name' => 'Lauren Script',
				'enable' => true,
				'fontsize' => 25
			],
			'canterbury' => [
				'file' => 'Canterbury.ttf',
				'name' => 'Canterbury',
				'enable' => true,
				'fontsize' => 35
			],
			'perfect-penmanship' => [
				'file' => 'perfect-penmanship.ttf',
				'name' => 'Perfect Penmanship',
				'enable' => true,
				'fontsize' => 30
			],
			'scriptina' => [
				'file' => 'scriptina.ttf',
				'name' => 'Scriptina',
				'enable' => true,
				'fontsize' => 35
			],
			'swirl-print' => [
				'file' => 'swirl-print.ttf',
				'name' => 'Swirl Print',
				'enable' => true,
				'fontsize' => 30
			],
			'valentines' => [
				'file' => 'valentines.ttf',
				'name' => 'Valentine\'s',
				'enable' => true,
				'fontsize' => 35
			],
			'verdana' => [
				'file' => 'verdana.ttf',
				'name' => 'Verdana',
				'enable' => true,
				'fontsize' => 23
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
