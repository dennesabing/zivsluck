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

class Image extends BaseEntity implements Interfaces\IdInterface
{

	/**
	 * Entity name as described in the config
	 * @var string
	 */
	protected $entityName = 'images';

	/**
	 * PrimaryKey Id
	 * @return integer
	 */
	public function id()
	{
		return $this->img_id;
	}

	/**
	 * Title string
	 * @return string
	 */
	public function title()
	{
		return $this->title;
	}

	/**
	 * Title string
	 * @return string
	 */
	public function name()
	{
		return $this->filename;
	}

	/**
	 * @return string
	 */
	public function material()
	{
		return $this->material;
	}

	/**
	 * @return string
	 */
	public function chain()
	{
		return $this->chain;
	}

	/**
	 * @return string
	 */
	public function font()
	{
		return $this->font;
	}

	/**
	 * @return string
	 */
	public function tags()
	{
		return $this->tags;
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
	 * The Image
	 */
	public function src()
	{
		return zbase_url_from_route('siteImageWatermark', ['f' => $this->filename]);
	}

}
