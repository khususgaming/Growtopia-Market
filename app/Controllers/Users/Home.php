<?php namespace App\Controllers\Users;
use App\Models\WorldModel;
use App\Models\WorldCategoriesModel;

class Home extends BaseController
{
	public function index()
	{
		$world = new WorldModel();
		$world_categories = new WorldCategoriesModel();
		$data['worlds'] = $world->findAll();
		$data['world_categories'] = $world_categories->findAll();
		return view('users/home', $data);
	}
	
	public function about()
	{
		return view('users/about');
	}

	public function farming()
	{
		return view('users/farming');
	}
}
