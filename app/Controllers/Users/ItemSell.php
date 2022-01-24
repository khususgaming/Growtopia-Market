<?php namespace App\Controllers\Users;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\WorldModel;
use App\Models\ItemModel;
use App\Models\ItemSellModel;
use App\Models\ItemCategoriesModel;

class ItemSell extends Controller
{
	public function __construct()
	{
		$this->user = new UserModel();
		$this->world = new WorldModel();
		$this->item = new ItemModel();
		$this->item_sell = new ItemSellModel();
		$this->item_categories = new ItemCategoriesModel();
		$this->user_id = session()->get('user_id');
	}
	
	public function index()
	{
		helper(['form']);
		$data['users'] = $this->user->findAll();
		$data['worlds'] = $this->world->findAll();
		$data['user_worlds'] = $this->world->getAllWorldByUser($this->user_id);
		$data['items'] = $this->item->findAll();
		$data['item_sell'] = $this->item_sell->getAllItemByUser($this->user_id);
		$data['item_categories'] = $this->item_categories->findAll();
		return view('users/item_sell', $data);
	}

	public function create()
	{
		helper(['form']);
		$rules = [
			'item_name'		=>	[
				'rules'		=> 'required|item_exist[item_name]|sell_exist[item_name,world_name]',
				'errors' 	=> [
					'item_exist' => 'Item not exist.',
					'sell_exist' => 'Item already sale.',
				],
			],
			'world_name'	=>	'required',
			'item_price'	=>	'required',
			'item_amount'	=>	'required',
		];
		if($this->validate($rules)) {
			$item = $this->item->getItemByTitle($this->request->getPost('item_name'));
			$world = $this->world->getWorldByName($this->request->getPost('world_name'));
			$save = [
				'item_id'		=>	$item['item_id'],
				'world_id'		=>	$world['world_id'],
				'user_id'		=>	$this->user_id,
				'item_price'	=>	$this->request->getPost('item_price'),
				'item_amount'	=>	$this->request->getPost('item_amount'),
			];
			$this->item_sell->save($save);
			return redirect()->to(base_url('item'));
		} else {
			$data['users'] = $this->user->findAll();
			$data['worlds'] = $this->world->findAll();
			$data['user_worlds'] = $this->world->getAllWorldByUser($this->user_id);
			$data['items'] = $this->item->findAll();
			$data['item_sell'] = $this->item_sell->getAllItemByUser($this->user_id);
			$data['item_categories'] = $this->item_categories->findAll();
			$data['validation'] = $this->validator;
			return view('users/item_sell', $data);
		}
	}

	public function update($id)
	{
		$data['item'] = $this->item_sell->getUserItem($id, $this->user_id);
		if($data['item']) {
			$data['item_categories'] = $this->item_categories->findAll();
			if(isset($_POST['item_name'])) {
				$rules = [
					'item_name'		=>	'required|is_unique[item_sell.item_name]',
					'item_category'	=>	'required',
					'item_info'		=>	'required',
				];
				if($this->validate($rules)) {
					$update = [
						'category_id'	=>	$this->request->getPost('item_category'),
						'item_name'	=>	$this->request->getPost('item_name'),
						'item_info'	=>	$this->request->getPost('item_info'),
					];
					$this->item_sell->update($id, $update);
					return redirect()->to(base_url('item'));
					
				}
				$data['validation'] = $this->validator;
			}
			return view('users/item_edit', $data);
		} else {
			return redirect()->to(base_url('item'));
		}
	}

	public function delete($id)
	{
		$item = $this->item_sell->getUserItem($id, $this->user_id);
		if($item) {
			$this->item_sell->delete($id);
			return redirect()->to(base_url('item'));
		} else {
			return redirect()->to(base_url('item'));
		}
	}
}
