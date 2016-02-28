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
		'images' => [
			'enable' => true,
			'model' => Zivsluck\Entity\__FRAMEWORK__\Image::class,
			'table' => [
				'name' => 'z_images',
				'primaryKey' => 'img_id',
				'timestamp' => true,
				'softDelete' => true,
				'description' => 'Images',
				'columns' => [
					'img_id' => [
						'filterable' => [
							'name' => 'imageid',
							'enable' => true
						],
						'sortable' => [
							'name' => 'imageid',
							'enable' => true
						],
						'label' => 'Image ID',
						'hidden' => false,
						'fillable' => false,
						'type' => 'integer',
						'unique' => true,
						'unsigned' => true,
						'length' => 16,
						'comment' => 'Image Id'
					],
					'filename' => [
						'filterable' => [
							'name' => 'filename',
							'enable' => true
						],
						'sortable' => [
							'name' => 'filename',
							'enable' => true
						],
						'label' => 'The filename',
						'hidden' => false,
						'fillable' => true,
						'type' => 'string',
						'comment' => 'The Text'
					],
					'title' => [
						'filterable' => [
							'name' => 'title',
							'enable' => true
						],
						'sortable' => [
							'name' => 'title',
							'enable' => true
						],
						'label' => 'Title',
						'hidden' => false,
						'fillable' => true,
						'type' => 'string',
						'nullable' => true,
						'comment' => 'Image Title'
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
						'nullable' => true,
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
						'nullable' => true,
						'type' => 'string',
						'comment' => 'The chain'
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
						'nullable' => true,
						'type' => 'string',
						'comment' => 'The font used'
					],
					'tags' => [
						'filterable' => [
							'name' => 'tags',
							'enable' => true
						],
						'label' => 'Tags',
						'hidden' => false,
						'fillable' => true,
						'nullable' => true,
						'type' => 'text',
						'comment' => 'Tags'
					],
				]
			]
		],
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
					'total' => [
						'filterable' => [
							'name' => 'total',
							'enable' => true
						],
						'sortable' => [
							'name' => 'total',
							'enable' => true
						],
						'label' => 'Total',
						'hidden' => false,
						'fillable' => true,
						'type' => 'decimal',
						'length' => 16,
						'comment' => 'Total Amount'
					],
					'subtotal' => [
						'filterable' => [
							'name' => 'total',
							'enable' => true
						],
						'sortable' => [
							'name' => 'total',
							'enable' => true
						],
						'label' => 'Sub Total',
						'hidden' => false,
						'fillable' => true,
						'type' => 'decimal',
						'length' => 16,
						'comment' => 'Sub Total Amount'
					],
					'shipping_fee' => [
						'filterable' => [
							'name' => 'shippingfee',
							'enable' => true
						],
						'sortable' => [
							'name' => 'shippingfee',
							'enable' => true
						],
						'label' => 'Shipping Fee',
						'hidden' => false,
						'fillable' => true,
						'length' => 16,
						'type' => 'decimal',
						'comment' => 'Shipping Fee'
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
						'json' => true,
						'type' => 'text',
						'comment' => 'The order details'
					],
					'payment_merchant' => [
						'filterable' => [
							'name' => 'paymentmerchant',
							'enable' => true
						],
						'sortable' => [
							'name' => 'paymentmerchant',
							'enable' => true
						],
						'label' => 'Paid at',
						'hidden' => false,
						'fillable' => true,
						'type' => 'string',
						'comment' => 'Payment Center'
					],
					'payment_tracking_number' => [
						'filterable' => [
							'name' => 'paymenttrackingnumber',
							'enable' => true
						],
						'sortable' => [
							'name' => 'paymenttrackingnumber',
							'enable' => true
						],
						'label' => 'Tracking Number',
						'hidden' => false,
						'fillable' => true,
						'type' => 'string',
						'comment' => 'Payment Tracking Number'
					],
					'paid_date_at' => [
						'filterable' => [
							'name' => 'paiddateat',
							'enable' => true
						],
						'sortable' => [
							'name' => 'paiddateat',
							'enable' => true
						],
						'label' => 'Date Paid',
						'hidden' => false,
						'fillable' => true,
						'type' => 'timestamp',
						'comment' => 'Date Paid'
					],
					'shipping_tracking_number' => [
						'filterable' => [
							'name' => 'shippingtrackingnumber',
							'enable' => true
						],
						'sortable' => [
							'name' => 'shippingtrackingnumber',
							'enable' => true
						],
						'label' => 'Shipping Tracking',
						'hidden' => false,
						'fillable' => true,
						'type' => 'string',
						'comment' => 'Shipping Tracking Number'
					],
					'shipping_date_at' => [
						'filterable' => [
							'name' => 'shippingdateat',
							'enable' => true
						],
						'sortable' => [
							'name' => 'shippingdateat',
							'enable' => true
						],
						'label' => 'Date Shipped',
						'hidden' => false,
						'fillable' => true,
						'type' => 'timestamp',
						'comment' => 'Date Shipped'
					],
					'promo_flag' => [
						'hidden' => false,
						'fillable' => true,
						'type' => 'boolean',
						'nullable' => true,
						'comment' => 'Promo Eligibility Flag'
					],
					'tags' => [
						'filterable' => [
							'name' => 'tags',
							'enable' => true
						],
						'label' => 'Tags',
						'hidden' => false,
						'fillable' => true,
						'type' => 'text',
						'comment' => 'Tags'
					],
				]
			]
		]
	],
];
