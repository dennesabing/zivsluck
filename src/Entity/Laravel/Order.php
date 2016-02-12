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
		$createModel = new \Zivsluck\Models\CreateText();
		$createModel->create($this->name(), $this->font, $this->material, $options);
		$createModel->setOrderData($this);
		$createModel->download();
	}

	/**
	 * Return the Image Src
	 * @return string
	 */
	public function imageSrc()
	{
		$id = $this->maskedId();
		return zbase_url_from_route('order', compact('id'));
	}

	/**
	 * Send Order pHoto to Shane
	 */
	public function sendOrderToShane()
	{
		$token = zbase_config_get('zivsluck.telegram.bot.token');
		$shane = zbase_config_get('zivsluck.telegram.shane');
		$enable = zbase_config_get('zivsluck.telegram.enable', false);
		if($enable)
		{
			$folder = zbase_directory_check(zbase_storage_path() . '/zivsluck/orders/', true);
			$orderUrl = $this->imageSrc();
			$image = $folder . $this->id . '.png';
			file_put_contents($image, file_get_contents($orderUrl));
			$url = 'https://api.telegram.org/bot' . $token . '/sendPhoto?chat_id=' . $shane . '&photo=' . $image;
			file_get_contents($url);
		}
	}

}
