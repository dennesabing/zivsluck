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
 * @file PageController.php
 * @project Zivsluck
 * @package Zivsluck\Http\Controllers
 */
use Zbase\Http\Controllers\Laravel\Controller;

class CreateController extends Controller
{

	public function index()
	{
		return $this->view(zbase_view_file('create.customize'));
	}

	public function create()
	{
		$name = str_replace(' ', '', $this->getRouteParameter('name', \Zbase\Models\Data\Column::f('string', 'personfirstname')));
		$font = $this->getRouteParameter('font', null);
		$create = false;
		return $this->view(zbase_view_file('customize.image'), compact('name', 'font', 'create'));
	}

	public function createImage()
	{
		$name = str_replace(' ', '', $this->getRouteParameter('name', \Zbase\Models\Data\Column::f('string', 'personfirstname')));
		$font = $this->getRouteParameter('font', null);
		$create = true;
		return $this->view(zbase_view_file('customize.image'), compact('name', 'font', 'create'));
	}
}
