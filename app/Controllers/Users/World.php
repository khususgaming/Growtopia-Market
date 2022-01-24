<?php namespace App\Controllers\Users;
use App\Models\WorldModel;
use App\Models\WorldCategoriesModel;
use App\Models\UserModel;
use App\Models\ItemModel;
use App\Models\ItemSellModel;

class World extends BaseController
{
	public function index()
	{
		echo "Index";
	}

	public function world($world_name)
	{
		if(is_string($world_name)) {
			$world = new WorldModel();
			$world_search = $world->getWorldByName($world_name);
			if($world_search) {
				$user_id = session()->get('user_id');
				$category = new WorldCategoriesModel();
				$user = new UserModel();
				$item = new ItemModel();
				$item_sell = new ItemSellModel();
				$world_category = $category->getCategoryByID($world_search['category_id']);
				$data['world'] = $world_search;
				$data['user'] = $user->getUserByID($world_search['user_id']);
				$data['items'] = $item->findAll();
				$data['category_title'] = $world_category['category_title'];
				$data['item_sell'] = $item_sell->where('world_id = '.$world_search['world_id'].' AND user_id ='.$user_id)->findAll();
				return view('users/world', $data);
			} else {
				echo "Tidak Ada";
			}
		} else {
			return redirect()->to(base_url());
		}
	}
}
