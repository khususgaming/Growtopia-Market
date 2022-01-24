<?php namespace App\Validations;

use App\Models\WorldModel;
use App\Models\ItemModel;
use App\Models\ItemSellModel;

class ItemRules {
    public function item_exist(string $str, string $fields, array $data):bool {
        $item = new ItemModel();
		$item_exist = $item->getItemByTitle($data['item_name']);
		if($item_exist) {
			return true;
		} else {
			return false;
		}
	}

    public function sell_exist(string $str, string $fields, array $data):bool {
        $item_model = new ItemModel();
        $item_sell_model = new ItemSellModel();
        $world_model = new WorldModel();
        $item = $item_model->getItemByTitle($data['item_name']);
        $world = $world_model->getWorldByName($data['world_name']);
        $item_id = $item['item_id'];
        $world_id = $world['world_id'];
        $user_id = session()->get('user_id');
		$item_exist = $item_sell_model->where('item_id = '.$item_id.' AND world_id = '.$world_id.' AND user_id = '.$user_id)->first();
		if($item_exist) {
			return false;
		} else {
			return true;
		}
	}
}