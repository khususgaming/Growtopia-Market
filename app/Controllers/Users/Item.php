<?php namespace App\Controllers\Users;
use App\Models\ItemModel;

class Item extends BaseController
{
	public function index()
	{
		echo "Index";
	}

	public function item($item_title)
	{
		if(is_string($item_title)) {
			$item_title = str_replace('_', ' ', $item_title);
			$item = new ItemModel();
			$item_search = $item->getItemByTitle($item_title);
			if($item_search) {
				echo "Ada";
				
			} else {
				echo "Tidak Ada";
			}
		} else {
			return redirect()->to(base_url());
		}
	}
}
