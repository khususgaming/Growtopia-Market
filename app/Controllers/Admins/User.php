<?php namespace App\Controllers\Admins;

use CodeIgniter\Controller;
use App\Models\UserModel;

class User extends Controller
{
	public function __construct()
	{
		$this->user = new UserModel();
		// Cek admin sudah login
		if(session()->get('a_logged_in')) {

		}
	}

	public function index()
	{
		helper(['form']);
		$data['users'] = $this->user->findAll();
		return view('admins/user', $data);
	}

	public function create()
	{
		helper(['form']);
		$rules = [
			'username'			=>	'required|min_length[6]|max_length[18]|is_unique[users.user_name]',
			'email'				=>	'required|min_length[6]|max_length[52]|valid_email|is_unique[users.user_email]',
			'password'			=>	'required|min_length[6]|max_length[64]',
			'confirm_password'	=>	'matches[password]',
		];
		if($this->validate($rules)) {
			$data = [
				'user_name'		=>	$this->request->getPost('username'),
				'user_email'	=>	$this->request->getPost('email'),
				'user_password'	=>	password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
			];
			$this->user->save($data);
			return redirect()->to(base_url('admin/user'));
		} else {
			$data['users'] = $this->user->findAll();
			$data['validation'] = $this->validator;
			return view('admins/user', $data);
		}
	}

	public function update($id)
	{
		$data['user'] = $this->user->getUserByID($id);
		if($data['user']) {
			if(isset($_POST['username'])) {
				$rules = [
					'email'				=>	'required|min_length[6]|max_length[52]|valid_email|is_unique[users.user_email]',
					'password'			=>	'required|min_length[6]|max_length[64]',
					'confirm_password'	=>	'matches[password]',
				];
				if($this->validate($rules)) {
					$data = [
						'user_email'	=>	$this->request->getPost('email'),
						'user_password'	=>	password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
					];
					$this->user->update($id, $data);
					return redirect()->to(base_url('admin/user'));
				}
				$data['validation'] = $this->validator;
			}
			return view('admins/user_edit', $data);
		} else {
			return redirect()->to(base_url('admin/user'));
		}
	}

	public function delete($id)
	{
		$user = $this->user->getUserByID($id);
		if($user) {
			$this->user->delete($id);
			return redirect()->to(base_url('admin/user'));
		} else {
			return redirect()->to(base_url('admin/user'));
		}
	}
}
