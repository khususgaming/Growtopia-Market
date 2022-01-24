<?php namespace App\Controllers\Admins;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\WorldModel;
use App\Models\WorldCategoriesModel;

class Item extends Controller
{
	public function __construct()
	{
		$this->world = new WorldModel();
		$this->world_categories = new WorldCategoriesModel();
	}

	public function index()
	{
		helper(['form']);
		$data['worlds'] = $this->world->findAll();
		$data['world_categories'] = $this->world_categories->findAll();
		return view('admins/item', $data);
	}

	public function create()
	{
		helper(['form']);
		$rules = [
			'world_name'		=>	'required|is_unique[worlds.world_name]',
			'world_category'	=>	'required',
			'world_info'		=>	'required',
		];
		if($this->validate($rules)) {
			$save = [
				'category_id'	=>	$this->request->getPost('world_category'),
				'user_id'		=>	session()->get('user_id'),
				'world_name'	=>	$this->request->getPost('world_name'),
				'world_info'	=>	$this->request->getPost('world_info'),
			];
			$this->world->save($save);
			return redirect()->to(base_url('admin/item'));
		} else {
			$data['worlds'] = $this->world->findAll();
			$data['world_categories'] = $this->world_categories->findAll();
			$data['validation'] = $this->validator;
			return view('admins/item', $data);
		}
	}

	public function update($id)
	{
		$data['world'] = $this->world->getWorldByID($id);
		if($data['world']) {
			$data['world_categories'] = $this->world_categories->findAll();
			if(isset($_POST['world_name'])) {
				$rules = [
					'world_name'		=>	'required|is_unique[worlds.world_name]',
					'world_category'	=>	'required',
					'world_info'		=>	'required',
				];
				if($this->validate($rules)) {
					$update = [
						'category_id'	=>	$this->request->getPost('world_category'),
						'world_name'	=>	$this->request->getPost('world_name'),
						'world_info'	=>	$this->request->getPost('world_info'),
					];
					$this->world->update($id, $update);
					return redirect()->to(base_url('admin/item'));
					
				}
				$data['validation'] = $this->validator;
			}
			return view('admins/world_edit', $data);
		} else {
			return redirect()->to(base_url('admin/item'));
		}
	}

	public function delete($id)
	{
		$data['world'] = $this->world->getWorldByID($id);
		if($data['world']) {
			$this->world->delete($id);
			return redirect()->to(base_url('admin/item'));
		} else {
			return redirect()->to(base_url('admin/item'));
		}
	}
}
