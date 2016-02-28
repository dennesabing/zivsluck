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
 * @file CreateController.php
 * @project Zivsluck
 * @package Zivsluck\Http\Controllers
 */
use Zbase\Http\Controllers\Laravel\Controller;

class SiteController extends Controller
{

	public function addonsList()
	{
		return $this->view(zbase_view_file('site.addonslist'));
	}

	public function images()
	{
		return $this->view(zbase_view_file('site.images'));
	}

	public function upload()
	{
		$image = false;
		$success = false;
		if($this->isPost())
		{
			if(!empty($_FILES['file']))
			{
				$folder = zbase_storage_path() . '/zivsluck/site/images/';
				$filename = md5($_FILES['file']['name'] . date('Y-m-d-H'));
				$newFilename = zbase_file_name_from_file($_FILES['file']['name'], $filename, true);
				if(!file_exists($folder . $filename . '.png'))
				{
					$newFilename = zbase_file_upload_image('file', $folder, $newFilename, 'png', []);
					if(file_exists($newFilename))
					{
						$data = [
							'filename' => $filename,
						];
						$image = zbase_entity('images')->create($data);
					}
				}
				$image = zbase_entity('images')->repository()->by('filename', $filename)->first();
			}
			else
			{
				$imagex = zbase_request_input('image', false);
				$delete = zbase_request_input('delete', false);
				if(!empty($imagex))
				{
					$image = zbase_entity('images')->repository()->by('filename', $imagex)->first();
					if(!empty($image))
					{
						if(!empty($delete))
						{
							unlink($folder = zbase_storage_path() . '/zivsluck/site/images/' . $image->name() . '.png');
							$image->delete();
							return 1;
						}
						$image->font = zbase_request_input('font', null);
						$image->material = zbase_request_input('material', null);
						$image->tags = zbase_request_input('tags', null);
						$image->save();
						return 1;
					}
					return 0;
				}
			}
		}
		zbase_view_pagetitle_set('Images');
		return $this->view(zbase_view_file('site.upload'), compact('image'));
	}

	public function watermark()
	{
		$folder = zbase_storage_path() . '/zivsluck/site/images/';
		$filename = str_replace('.png', '', zbase_route_input('f', false));
		$download = zbase_request_query_input('d', false);
		if(!empty($download))
		{
			if(file_exists($folder . $filename . '.png'))
			{
				$w = new \Zivsluck\Models\Image();
				$w->watermark($folder . $filename . '.png');
				$w->download();
			}
		}
		else
		{
			if(file_exists($folder . $filename . '.png'))
			{
				$w = new \Zivsluck\Models\Image();
				$w->watermark($folder . $filename . '.png');
				$w->serve();
			}
		}
	}

}
