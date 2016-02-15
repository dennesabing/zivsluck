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
		'checkout' => [
			'enable' => env('ZIVSLUCK_CHECKOUT', false),
		],
		'socialmedia' => [
			'facebook' => [
				'account' => '',
				'name' => 'Facebook',
				'title' => 'Like us on Facebook',
				'file' => 'icon_facebook.png',
				'enable' => true,
			],
			'twitter' => [
				'account' => '',
				'name' => 'Twitter',
				'title' => 'Tweet about us!',
				'file' => 'icon_twitter.png',
				'enable' => true,
			],
			'instagram' => [
				'account' => '',
				'name' => 'Instagram',
				'title' => 'Follow us on Instagram!',
				'file' => 'icon_instagram.png',
				'enable' => true,
			],
		],
		'telegram' => [
			'enable' => true,
			'shane' => '196511207',
			'bot' => [
				'name' => 'ZivsluckBot',
				'token' => '128765780:AAEToOGGeqPqqDXmSJkieV9wWd9QMUG0uc8'
			],
		],
		'shipping' => [
			'lbc' => [
				'name' => 'LBC',
				'fee' => 180,
				'mode' => [
					'pickup' => 'Pick-Up',
					'd2d' => 'Door to Door'
				],
			],
			'jrs' => [
				'name' => 'JRS',
				'fee' => 100,
				'mode' => [
					'pickup' => 'Pick-Up',
					'd2d' => 'Door to Door'
				],
			],
		],
		'paymentCenters' => [
			'cebuana' => [
				'name' => 'Cebuana Lhuillier',
				'shortName' => 'Cebuana',
				'file' => 'cebuanaLhuillier.png',
				'enable' => true
			],
			'mlhuillier' => [
				'name' => 'MLhuillier',
				'shortName' => 'MLhuillier',
				'file' => 'mLhuillier.png',
				'enable' => true
			],
			'palawan' => [
				'name' => 'Palawan Express',
				'shortName' => 'Palawan',
				'file' => 'palawanExpress.png',
				'enable' => true
			],
			'rd' => [
				'name' => 'RD Pawnshop',
				'shortName' => 'RD',
				'file' => 'rdPawnshop.png',
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
			'order' => [
				'name' => Zivsluck\Http\Controllers\__FRAMEWORK__\OrderController::class,
				'enable' => true
			],
			'maintenance' => [
				'name' => Zivsluck\Http\Controllers\__FRAMEWORK__\MaintenanceController::class,
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
				'separator' => ' ',
				'suffix' => 'Personalized Necklace by ZivsLuck'
			],
			'description' => 'Create a personalized necklace made from high-quality Stainless, Silver and Gold Plated!',
			'keywords' => ''
		],
	],
	'routes' => [
		'index' => [
			'controller' => [
				'name' => 'create',
				'method' => 'index',
				'enable' => false
			],
			'view' => [
				'name' => zivsluck_tag() . '::templates.front.default.maintenance',
				'enable' => true
			],
			'url' => '/',
			'enable' => true
		],
		'maintenance' => [
			'controller' => [
				'name' => 'maintenance',
				'method' => 'index',
				'enable' => false
			],
			'url' => '/maintenance',
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
			'url' => '/create',
			'enable' => true
		],
		'create' => [
			'controller' => [
				'name' => 'create',
				'method' => 'create',
				'enable' => true
			],
			'httpVerb' => ['get', 'post'],
			'url' => '/c/{name?}/{font?}/{material?}',
			'enable' => true
		],
		'createImage' => [
			'controller' => [
				'name' => 'create',
				'method' => 'createImage',
				'enable' => true
			],
			'httpVerb' => ['get', 'post'],
			'url' => '/x/{name?}/{font?}/{material?}',
			'enable' => true
		],
		'order' => [
			'controller' => [
				'name' => 'order',
				'method' => 'order',
				'enable' => true
			],
			'url' => '/order/{id?}/{task?}',
			'enable' => true
		],
		'orderUpdate' => [
			'controller' => [
				'name' => 'order',
				'method' => 'update',
				'enable' => true
			],
			'form' => [
				'enable' => true
			],
			'url' => '/update-order',
			'enable' => true
		],
	]
];
