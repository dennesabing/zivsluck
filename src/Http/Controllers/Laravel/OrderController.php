<?php

namespace Zivsluck\Http\Controllers\Laravel;

/**
 * CreateController
 *
 *
 * @link http://zbase.dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2016 ClaremontDesign/MadLabs-Dx
 * @file OrderController.php
 * @project Zivsluck
 * @package Zivsluck\Http\Controllers
 */
use Zbase\Http\Controllers\Laravel\Controller;

class OrderController extends Controller
{

	public function order()
	{
		$id = $this->getRouteParameter('id', false);
		$task = $this->getRouteParameter('task', false);
		if(!empty($id))
		{
			$order = zbase_entity('custom_orders')->repository()->byId($id);
			if(!empty($order))
			{
				if($task == 'download')
				{
					return $order->download();
				}
				if($task == 'dealer')
				{
					return $order->dealer();
				}
				return $order->serveImage();
			}
		}
		return $this->notfound('404 Order Not Found.');
	}

	public function update()
	{
		$orderEntity = false;
		if($this->isPost())
		{
			$tableName = zbase_entity('custom_orders')->getTable();
			$name = zbase_request_input('name', false);
			$orderId = zbase_request_input('order_id', false);
			$amount = zbase_request_input('amount', false);
			$validators = [
				'name' => 'required',
				'amount' => 'required',
				'order_id' => 'required|exists:' . $tableName . ',order_id,name,' . $name . ',total,' . number_format($amount, 2) .',status,1',
				'date' => 'required|date_format:Y-m-d|before:' . zbase_date_now()->addDay(),
				'payment_center' => 'required',
				'file' => 'required|image'
			];
			$messages = [
				'order_id.exists' => 'Order ID, Name and Amount don\'t match.',
				'amount.required' => 'Enter the amount that you deposited or paid.',
				'file.required' => 'Kindly upload your deposit or payment slip.',
				'file.image' => 'The file you uploaded is not an image.'
			];
			$this->validate(zbase_request(), $validators, $messages);
			$folder = zbase_storage_path() . '/zivsluck/order/receipts/';
			$newFilename = zbase_file_name_from_file($_FILES['file']['name'], $orderId, true);
			$newFilename = zbase_file_upload_image('file', $folder, $newFilename, 'png', [280, null]);
			if(file_exists($newFilename))
			{
				$orderEntity = zbase_entity('custom_orders')->repository()->byId($orderId);
				$orderEntity->status = 2;
				$orderEntity->payment_merchant = zbase_request_input('payment_center', null);
				$orderEntity->paid_date_at = zbase_request_input('date', null);
				$orderEntity->payment_tracking_number = zbase_request_input('payment_tracking', null);
				$orderEntity->save();
				$orderEntity->sendPaymentReceiptToShane();
			}
		}
		zbase_view_pagetitle_set('Update Order');
		return $this->view(zbase_view_file('order.update'), compact('orderEntity'));
	}

}
