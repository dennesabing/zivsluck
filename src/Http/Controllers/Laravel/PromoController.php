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
 * @file PromoController.php
 * @project Zivsluck
 * @package Zivsluck\Http\Controllers
 */
use Zbase\Http\Controllers\Laravel\Controller;

class PromoController extends Controller
{

	public function index()
	{
		return $this->view(zbase_view_file('promo.index'));
	}

}
