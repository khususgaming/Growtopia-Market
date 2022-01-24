<?php namespace App\Controllers\Admins;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\WorldModel;
use App\Models\WorldCategoriesModel;

class Dashboard extends Controller
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
		return view('admins/dashboard', $data);
	}

	public function create()
	{
		helper(['form']);
		$rules = [
			'world_name'		=>	'required|alpha_numeric[world_name]|is_unique[worlds.world_name]',
			'world_category'	=>	'required',
			'world_info'		=>	'required',
		];
		if($this->validate($rules)) {
			$save = [
				'category_id'	=>	$this->request->getPost('world_category'),
				'user_id'		=>	session()->get('user_id'),
				'world_name'	=>	strtoupper($this->request->getPost('world_name')),
				'world_info'	=>	$this->request->getPost('world_info'),
			];
			$this->world->save($save);
			return redirect()->to(base_url('admin/dashboard'));
		} else {
			$data['worlds'] = $this->world->findAll();
			$data['world_categories'] = $this->world_categories->findAll();
			$data['validation'] = $this->validator;
			return view('admins/dashboard', $data);
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
					return redirect()->to(base_url('admin/dashboard'));
					
				}
				$data['validation'] = $this->validator;
			}
			return view('admins/world_edit', $data);
		} else {
			return redirect()->to(base_url('admin/dashboard'));
		}
	}

	public function delete($id)
	{
		$world = $this->world->getWorldByID($id);
		if($world) {
			$this->world->delete($id);
			return redirect()->to(base_url('admin/dashboard'));
		} else {
			return redirect()->to(base_url('admin/dashboard'));
		}
	}
}
