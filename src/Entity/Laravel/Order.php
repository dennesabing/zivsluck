<?php

namespace Zivsluck\Entity\Laravel;

/**
 * Zbase-UserProfile Entity
 *
 * UserProfile Entity Model
 *
 * @link http://zbase.dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2016 ClaremontDesign/MadLabs-Dx
 * @file UserProfile.php
 * @project Zbase
 * @package Zbase/Entity/User
 */
use Zbase\Entity\Laravel\Entity as BaseEntity;
use Zbase\Interfaces;

class Order extends BaseEntity implements Interfaces\IdInterface
{

	const STATUS_NEW = 1;
	const STATUS_PAID = 2;
	const STATUS_PROCESSING = 3;
	const STATUS_SHIPPED = 4;
	const STATUS_COMPLETE = 5;

	/**
	 * Entity name as described in the config
	 * @var string
	 */
	protected $entityName = 'custom_orders';

	/**
	 * PrimaryKey Id
	 * @return integer
	 */
	public function id()
	{
		return $this->order_id;
	}

	/**
	 * PrimaryKey Id
	 * @return integer
	 */
	public function maskedId()
	{
		return $this->order_id;
	}

	/**
	 * The Role Name
	 * @return string
	 */
	public function name()
	{
		return $this->text;
	}

	/**
	 * Title string
	 * @return string
	 */
	public function title()
	{
		return ucfirst($this->text());
	}

	/**
	 * Description
	 * @return string
	 */
	public function description()
	{
		return $this->id() . ': ' . $this->name();
	}

	/**
	 * Serve the Image
	 */
	public function serveImage()
	{
		$options = json_decode($this->details, true);
		$options['oid'] = $this->maskedId();
		$createModel = new \Zivsluck\Models\CreateText();
		$createModel->setOrderData($this);
		$createModel->create($this->name(), $this->font, $this->material, $options);
		$createModel->serve();
	}

	/**
	 * Serve the Image
	 */
	public function download()
	{
		$options = json_decode($this->details, true);
		$options['oid'] = $this->maskedId();
		$options['download'] = true;
		$createModel = new \Zivsluck\Models\CreateText();
		$createModel->setOrderData($this);
		$createModel->create($this->name(), $this->font, $this->material, $options);
		$createModel->download();
	}

	/**
	 * Serve the Image
	 */
	public function dealer()
	{
		$options = json_decode($this->details, true);
		$options['oid'] = $this->maskedId();
		$options['dealerCopy'] = true;
		$createModel = new \Zivsluck\Models\CreateText();
		$createModel->create($this->name(), $this->font, $this->material, $options);
		$createModel->setOrderData($this);
		$createModel->serve();
	}

	/**
	 * Return the Image Src
	 * @return string
	 */
	public function imageSrc($task = null)
	{
		$id = $this->maskedId();
		return zbase_url_from_route('order', compact('id', 'task'));
	}

	/**
	 * Send Order pHoto to Shane
	 */
	public function sendOrderToShane()
	{
		$token = zbase_config_get('zivsluck.telegram.bot.token');
		$shane = zbase_config_get('zivsluck.telegram.shane');
		$enable = env('ZIVSLUCK_TELEGRAM', zbase_config_get('zivsluck.telegram.enable', false));
		if($enable)
		{
			$folder = zbase_storage_path() . '/zivsluck/var/';
			zbase_directory_check($folder, true);
			$orderUrl = $this->imageSrc();
			$image = $folder . $this->id() . '.png';
			file_put_contents($image, file_get_contents($orderUrl));
			$url = 'https://api.telegram.org/bot' . $token . '/sendPhoto?chat_id=' . $shane;
			$post_fields = array(
				'chat_id' => $shane,
				'photo' => new \CURLFile(realpath($image)),
				'caption' => 'New Order from ' . $this->name . ' with Order ID: ' . $this->maskedId()
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Content-Type:multipart/form-data"
			));
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
			curl_exec($ch);

			/**
			 * Send the dealer Image
			 */
			zbase_directory_check($folder, true);
			$orderUrl = $this->imageSrc('dealer');
			$image = $folder . $this->id() . '.png';
			file_put_contents($image, file_get_contents($orderUrl));
			$url = 'https://api.telegram.org/bot' . $token . '/sendPhoto?chat_id=' . $shane;
			$post_fields = array(
				'chat_id' => $shane,
				'photo' => new \CURLFile(realpath($image)),
				'caption' => 'Dealer\'s copy for Order from ' . $this->name . ' with Order ID: ' . $this->maskedId()
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Content-Type:multipart/form-data"
			));
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
			curl_exec($ch);
		}
	}

	public function paymentMerchant()
	{
		return zbase_config_get('zivsluck.paymentCenters.' . $this->paymentMerchant . '.name');
	}

	/**
	 * Send Order pHoto to Shane
	 */
	public function sendPaymentReceiptToShane()
	{
		$token = zbase_config_get('zivsluck.telegram.bot.token');
		$shane = zbase_config_get('zivsluck.telegram.shane');
		$enable = env('ZIVSLUCK_TELEGRAM', zbase_config_get('zivsluck.telegram.enable', false));
		if($enable)
		{
			$folder = zbase_storage_path() . '/zivsluck/order/receipts/';
			$image = $folder . $this->id() . '.png';
			$url = 'https://api.telegram.org/bot' . $token . '/sendPhoto?chat_id=' . $shane;
			$post_fields = array(
				'chat_id' => $shane,
				'photo' => new \CURLFile(realpath($image)),
				'caption' => 'Payment received from ' . $this->name . ' via '.$this->paymentMerchant().' for Order ID ' . $this->maskedId()
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Content-Type:multipart/form-data"
			));
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
			curl_exec($ch);
		}
	}

}
