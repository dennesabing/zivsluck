<?php

namespace Zivsluck;
date_default_timezone_set ('Asia/Manila');
/**
 * Zbase ServiceProvider
 *
 *
 * @link http://zbase.dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2016 ClaremontDesign/MadLabs-Dx
 * @file ServiceProvider.php
 * @project Zivsluck
 * @package Zivsluck
 */
class LaravelServiceProvider extends \Illuminate\Support\ServiceProvider
{

	public function register()
	{
		$this->app->singleton(zivsluck_tag(), function(){
			return new Zivsluck;
		});
		zbase()->addPackage(zivsluck_tag());
	}

	public function boot()
	{
		$this->loadViewsFrom(__DIR__ . '/../resources/views', zivsluck_tag());
		$this->publishes([
			__DIR__ . '/../resources/assets' => zbase_public_path(zbase_path_asset(zivsluck_tag())),
				], 'public');

		$this->publishes([
			__DIR__ . '/../database/migrations' => base_path('database/migrations'),
			__DIR__ . '/../database/seeds' => base_path('database/seeds'),
			__DIR__ . '/../database/factories' => base_path('database/factories')
				], 'migrations');
		require __DIR__ . '/Http/Controllers/Laravel/routes.php';
	}

}
