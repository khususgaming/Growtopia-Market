<?php namespace App\Controllers\Users;
use App\Models\WorldModel;
use App\Models\WorldCategoriesModel;

class Category extends BaseController
{
	public function index()
	{
		echo "Index";
	}

	public function world($category)
	{
		if(is_string($category)) {
			$world_categories = new WorldCategoriesModel();
			$category_search = $world_categories->getCategoryByTitle($category);
			if($category_search) {
				$world = new WorldModel();
				$data['category_title'] = $category;
				$data['worlds'] = $world->getAllWorldByCategory($category_search['category_id']);
				return view('users/world_category', $data);
			} else {
				echo "Tidak Ada";
			}
		} else {
			return redirect()->to(base_url());
		}
	}

	public function item($category)
	{
		if(is_string($category)) {
			$category = str_replace('_', ' ', $category);
			$item_categories = new ItemCategoriesModel();
			$category_search = $item_categories->getCategoryByTitle($category);
			if($category_search) {
				echo "Ada";
			} else {
				echo "Tidak Ada";
			}
		} else {
			return redirect()->to(base_url());
		}
	}
}
