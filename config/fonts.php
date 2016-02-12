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
		'telegram' => [
			'enable' => false,
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
				'file' => 'cebuanaLhuillier.png',
				'enable' => true
			],
			'mlhuillier' => [
				'file' => 'mLhuillier.png',
				'enable' => true
			],
			'palawan' => [
				'file' => 'palawanExpress.png',
				'enable' => true
			],
			'rd' => [
				'file' => 'rdPawnshop.png',
				'enable' => true
			],
		],
		'chains' => [
			'stainless' => [
				'slc-1' => [
					'name' => 'SLC-1',
					'file' => 'stainless-1.png',
					'enable' => true,
					'group' => 'victoria',
				],
				'slc-2' => [
					'name' => 'SLC-2',
					'file' => 'stainless-2.png',
					'enable' => true,
					'group' => 'victoria',
				],
				'slc-3' => [
					'name' => 'SLC-3',
					'file' => 'stainless-3.png',
					'enable' => true,
					'group' => 'victoria',
				],
				'slc-4' => [
					'name' => 'SLC-4',
					'file' => 'stainless-4.png',
					'enable' => true,
					'group' => 'victoria',
				],
				'slcpwc-1' => [
					'name' => 'SLCPWC-1',
					'file' => 'stainless-pwc-1.png',
					'enable' => true,
					'group' => 'pwc',
				],
				'slcpwc-2' => [
					'name' => 'SLCPWC-2',
					'file' => 'stainless-pwc-2.png',
					'enable' => true,
					'group' => 'pwc',
				],
				'slcpwc-3' => [
					'name' => 'SLCPWC-3',
					'file' => 'stainless-pwc-3.png',
					'enable' => true,
					'group' => 'pwc',
				],
				'slcpwc-4' => [
					'name' => 'SLCPWC-4',
					'file' => 'stainless-pwc-4.png',
					'enable' => true,
					'group' => 'pwc',
				],
				'slcpwc-5' => [
					'name' => 'SLCPWC-5',
					'file' => 'stainless-pwc-5.png',
					'enable' => true,
					'group' => 'pwc',
				],
			],
			'silver' => [
				'svc-1' => [
					'name' => 'SVC-1',
					'file' => 'silver-1.png',
					'enable' => true
				],
				'svc-2' => [
					'name' => 'SVC-2',
					'file' => 'silver-2.png',
					'enable' => true
				],
				'svc-3' => [
					'name' => 'SVC-3',
					'file' => 'silver-3.png',
					'enable' => true
				],
			],
			'goldplated' => [
				'gc-1' => [
					'name' => 'GC-1',
					'file' => 'gold-1.png',
					'enable' => true
				],
				'gc-2' => [
					'name' => 'GC-2',
					'file' => 'gold-2.png',
					'enable' => true
				],
				'gc-3' => [
					'name' => 'GC-3',
					'file' => 'gold-3.png',
					'enable' => true
				],
				'gc-4' => [
					'name' => 'GC-4',
					'file' => 'gold-4.png',
					'enable' => true
				],
				'gc-5' => [
					'name' => 'GC-5',
					'file' => 'gold-5.png',
					'enable' => true
				],
			],
		],
		'fontmaps' => [
			'angel-tears' => [
				'file' => 'angel-tears.ttf',
				'name' => 'Angel Tears',
				'enable' => true,
				'fontsize' => 60,
				'chaingroup' => ['pwc']
			],
			'brush-script' => [
				'file' => 'brush-script.ttf',
				'name' => 'Soho Script',
				'enable' => true,
				'fontsize' => 35,
				'chaingroup' => ['pwc']
			],
			'classic-cursive' => [
				'file' => 'classic-cursive.ttf',
				'name' => 'Classic Cursive',
				'enable' => true,
				'fontsize' => 40,
				'chaingroup' => ['pwc']
			],
			'commercial-script' => [
				'file' => 'commercial-script.ttf',
				'name' => 'Commercial Script',
				'enable' => true,
				'fontsize' => 35,
				'chaingroup' => ['pwc']
			],
			'deftone' => [
				'file' => 'deftone-stylus.ttf',
				'name' => 'Deftone Stylus',
				'enable' => true,
				'fontsize' => 30,
				'chaingroup' => ['pwc']
			],
			'lauren-script' => [
				'file' => 'lauren-script.ttf',
				'name' => 'Lauren Script',
				'enable' => true,
				'fontsize' => 25,
				'chaingroup' => ['pwc']
			],
			'canterbury' => [
				'file' => 'Canterbury.ttf',
				'name' => 'Canterbury',
				'enable' => true,
				'fontsize' => 35,
				'chaingroup' => ['pwc']
			],
			'perfect-penmanship' => [
				'file' => 'perfect-penmanship.ttf',
				'name' => 'Perfect Penmanship',
				'enable' => true,
				'fontsize' => 30,
				'chaingroup' => ['pwc']
			],
			'scriptina' => [
				'file' => 'scriptina.ttf',
				'name' => 'Scriptina',
				'enable' => true,
				'fontsize' => 35,
				'chaingroup' => ['victoria'],
				'material' => [
					'stainless' => [
						'price' => 270
					]
				]
			],
			'swirl-print' => [
				'file' => 'swirl-print.ttf',
				'name' => 'Swirl Print',
				'enable' => true,
				'fontsize' => 30,
				'chaingroup' => ['pwc']
			],
			'valentines' => [
				'file' => 'valentines.ttf',
				'name' => 'Valentine\'s',
				'enable' => true,
				'fontsize' => 35,
				'chaingroup' => ['pwc']
			],
			'verdana' => [
				'file' => 'verdana.ttf',
				'name' => 'Verdana',
				'enable' => true,
				'fontsize' => 23,
				'chaingroup' => ['victoria'],
				'material' => [
					'stainless' => [
						'price' => 270
					]
				]
			],
		],
	],
	'controller' => [
		'class' => [
			'create' => [
				'name' => Zivsluck\Http\Controllers\__FRAMEWORK__\CreateController::class,
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
				'suffix' => 'Personalized Necklace by ZivsLuck'
			],
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
				'enable' => true
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
			'url' => '/customize',
			'enable' => true
		],
		'create' => [
			'controller' => [
				'name' => 'create',
				'method' => 'create',
				'enable' => true
			],
			'url' => '/create/{name?}/{font?}/{material?}',
			'enable' => true
		],
		'createImage' => [
			'controller' => [
				'name' => 'create',
				'method' => 'createImage',
				'enable' => true
			],
			'url' => '/c/{name?}/{font?}/{material?}',
			'enable' => true
		],
		'order' => [
			'controller' => [
				'name' => 'create',
				'method' => 'order',
				'enable' => true
			],
			'url' => '/order/{id?}/{task?}',
			'enable' => true
		],
	]
];
