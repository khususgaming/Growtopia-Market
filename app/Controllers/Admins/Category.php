<?php namespace App\Controllers\Admins;

use CodeIgniter\Controller;
use App\Models\ItemCategoriesModel;
use App\Models\WorldCategoriesModel;

class Category extends Controller
{
	public function __construct()
	{
		$this->world_categories = new WorldCategoriesModel();
		$this->item_categories = new ItemCategoriesModel();
	}

	public function index()
	{
		helper(['form']);
		$data['item_categories'] = $this->item_categories->findAll();
		$data['world_categories'] = $this->world_categories->findAll();
		return view('admins/category', $data);
	}

	public function create()
	{
		helper(['form']);
		if(isset($_POST['submit_item'])) {
			// Category Item
			$rules = [
				'category_title'	=>	'required|is_unique[item_categories.category_title]',
			];
			if($this->validate($rules)) {
				$data = [
					'category_title'	=>	$this->request->getPost('category_title'),
				];
				$this->item_categories->save($data);
				return redirect()->to(base_url('admin/category'));
			} else {
				$data['item_categories'] = $this->item_categories->findAll();
				$data['world_categories'] = $this->world_categories->findAll();
				$data['validation_item'] = $this->validator;
				return view('admins/category', $data);
			}
		} else {
			// Category World
			$rules = [
				'category_title'	=>	'required|is_unique[world_categories.category_title]',
			];
			if($this->validate($rules)) {
				$data = [
					'category_title'	=>	$this->request->getPost('category_title'),
				];
				$this->world_categories->save($data);
				return redirect()->to(base_url('admin/category'));
			} else {
				$data['item_categories'] = $this->item_categories->findAll();
				$data['world_categories'] = $this->world_categories->findAll();
				$data['validation_world'] = $this->validator;
				return view('admins/category', $data);
			}
		}
	}

	public function update($id)
	{
		if($_GET['p'] == "item") {
			// Category Item
			$data['category'] = $this->item_categories->getCategoryByID($id);
			if($data['category']) {
				if(isset($_POST['category_title'])) {
					$rules = [
						'category_title'	=>	'required|is_unique[item_categories.category_title]',
					];
					if($this->validate($rules)) {
						$update = [
							'category_title'	=>	$this->request->getPost('category_title'),
						];
						$this->item_categories->update($id, $update);
						return redirect()->to(base_url('admin/category'));
					}
					$data['validation'] = $this->validator;
				}
				$data['page'] = "Item";
				return view('admins/category_edit', $data);
			} else {
				return redirect()->to(base_url('admin/category'));
			}
		} elseif($_GET['p'] == "world") {
			// Category World
			$data['category'] = $this->world_categories->getCategoryByID($id);
			if($data['category']) {
				if(isset($_POST['category_title'])) {
					$rules = [
						'category_title'	=>	'required|is_unique[world_categories.category_title]',
					];
					if($this->validate($rules)) {
						$update = [
							'category_title'	=>	$this->request->getPost('category_title'),
						];
						$this->world_categories->update($id, $update);
						return redirect()->to(base_url('admin/category'));
					}
					$data['validation'] = $this->validator;
				}
				$data['page'] = "World";
				return view('admins/category_edit', $data);
			} else {
				return redirect()->to(base_url('admin/category'));
			}
		} else {
			return redirect()->to(base_url('admin/category'));
		}
	}

	public function delete($id)
	{
		if($_GET['p'] == "item") {
			// Category Item
			$category = $this->item_categories->getCategoryByID($id);
			if($category) {
				$this->item_categories->delete($id);
				return redirect()->to(base_url('admin/dashboard'));
			} else {
				return redirect()->to(base_url('admin/dashboard'));
			}
		} elseif($_GET['p'] == "world") {
			// Category World
			$category = $this->world_categories->getCategoryByID($id);
			if($category) {
				$this->world_categories->delete($id);
				return redirect()->to(base_url('admin/dashboard'));
			} else {
				return redirect()->to(base_url('admin/dashboard'));
			}
		} else {
			return redirect()->to(base_url('admin/category'));
		}
	}
}
