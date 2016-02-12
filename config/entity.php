<?php

/**
 * Dx
 *
 * @link http://dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2015 ClaremontDesign/MadLabs-Dx
 * @version 0.0.0.1
 * @since Feb 11, 2016 9:43:39 PM
 * @file addons.blade.php
 * @project Expression project.name is undefined on line 13, column 15 in Templates/Scripting/EmptyPHP.php.
 * @package Expression package is undefined on line 14, column 15 in Templates/Scripting/EmptyPHP.php.
 */
return [
	'entity' => [
		'custom_orders' => [
			'enable' => true,
			'model' => Zivsluck\Entity\__FRAMEWORK__\Order::class,
			'table' => [
				'name' => 'z_custom_orders',
				'primaryKey' => 'order_id',
				'timestamp' => true,
				'softDelete' => true,
				'description' => 'Necklace Customized Orders',
				'columns' => [
					'order_id' => [
						'filterable' => [
							'name' => 'orderid',
							'enable' => true
						],
						'sortable' => [
							'name' => 'orderid',
							'enable' => true
						],
						'label' => 'Order ID',
						'hidden' => false,
						'fillable' => false,
						'type' => 'integer',
						'unique' => true,
						'unsigned' => true,
						'length' => 16,
						'comment' => 'Order Id'
					],
					'status' => [
						'hidden' => false,
						'fillable' => true,
						'type' => 'integer',
						'unsigned' => true,
						'nullable' => true,
						'length' => 16,
						'comment' => 'Order Status'
					],
					'text' => [
						'filterable' => [
							'name' => 'text',
							'enable' => true
						],
						'sortable' => [
							'name' => 'text',
							'enable' => true
						],
						'label' => 'The Text',
						'hidden' => false,
						'fillable' => true,
						'type' => 'string',
						'comment' => 'The Text'
					],
					'font' => [
						'filterable' => [
							'name' => 'font',
							'enable' => true
						],
						'sortable' => [
							'name' => 'font',
							'enable' => true
						],
						'label' => 'Font',
						'hidden' => false,
						'fillable' => true,
						'type' => 'string',
						'comment' => 'The font used'
					],
					'material' => [
						'filterable' => [
							'name' => 'material',
							'enable' => true
						],
						'sortable' => [
							'name' => 'material',
							'enable' => true
						],
						'label' => 'Material',
						'hidden' => false,
						'fillable' => true,
						'type' => 'string',
						'comment' => 'The material'
					],
					'chain' => [
						'filterable' => [
							'name' => 'chain',
							'enable' => true
						],
						'sortable' => [
							'name' => 'chain',
							'enable' => true
						],
						'label' => 'Chain',
						'hidden' => false,
						'fillable' => true,
						'type' => 'string',
						'comment' => 'The chain'
					],
					'chain_length' => [
						'filterable' => [
							'name' => 'chainlength',
							'enable' => true
						],
						'sortable' => [
							'name' => 'chainlength',
							'enable' => true
						],
						'label' => 'Chain Length',
						'hidden' => false,
						'fillable' => true,
						'type' => 'integer',
						'comment' => 'The chain length'
					],
					'name' => [
						'filterable' => [
							'name' => 'name',
							'enable' => true
						],
						'sortable' => [
							'name' => 'name',
							'enable' => true
						],
						'label' => 'Name',
						'hidden' => false,
						'fillable' => true,
						'type' => 'string',
						'length' => 64,
						'comment' => 'Name'
					],
					'email' => [
						'filterable' => [
							'name' => 'email',
							'enable' => true
						],
						'sortable' => [
							'name' => 'email',
							'enable' => true
						],
						'label' => 'Email Address',
						'hidden' => false,
						'fillable' => true,
						'type' => 'string',
						'length' => 64,
						'comment' => 'Email Address'
					],
					'details' => [
						'filterable' => [
							'name' => 'details',
							'enable' => true
						],
						'sortable' => [
							'name' => 'details',
							'enable' => true
						],
						'label' => 'Details',
						'hidden' => false,
						'fillable' => true,
						'type' => 'text',
						'comment' => 'The order details'
					],
				]
			]
		]
	],
];
