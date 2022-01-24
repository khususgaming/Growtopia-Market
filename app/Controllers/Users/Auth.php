<?php namespace App\Controllers\Users;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller
{
	public function index()
	{
		$session = session();
		$username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
		$user = new UserModel();
		$data = $user->getUserByName($username);
		if($data) {
			$password_db = $data['user_password'];
			$password_verify = password_verify($password, $password_db);
			if($password_verify) {
				$session_data = [
					'user_id'		=> $data['user_id'],
					'user_name'		=> $data['user_name'],
					'user_email'	=> $data['user_email'],
					'u_logged_in'		=> TRUE
				];
				$session->set($session_data);
				return redirect()->to(base_url('auth/login'));
			}else{
                $session->setFlashdata('msg', 'The password field is wrong.');
                return redirect()->to(base_url('auth/login'));
            }
        }else{
            $session->setFlashdata('msg', 'The username field is not found.');
            return redirect()->to(base_url('auth/login'));
        }
	}

	public function login()
	{
		if(session()->get('u_logged_in')) {
            return redirect()->to(base_url('dashboard'));
		}else{
			helper(['form']);
			$data = [];
			return view('users/login', $data);
		}
	}

	public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('auth/login'));
    }

	public function register()
	{
		if(session()->get('u_logged_in')) {
            return redirect()->to(base_url('dashboard'));
		}else{
			helper(['form']);
			$data = [];
			return view('users/register', $data);
		}
	}

	public function save()
	{
		helper(['form']);
		$rules = [
			'username'			=>	'required|min_length[6]|max_length[18]',
			'email'				=>	'required|min_length[6]|max_length[52]|valid_email|is_unique[users.user_email]',
			'password'			=>	'required|min_length[6]|max_length[64]',
			'confirm_password'	=>	'matches[password]',
		];
		if($this->validate($rules)) {
			$user = new UserModel();
			$data = [
				'user_name'		=>	$this->request->getPost('username'),
				'user_email'	=>	$this->request->getPost('email'),
				'user_password'	=>	password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
			];
			$user->save($data);
			return redirect()->to(base_url('auth/login'));
		}else{
			$data['validation'] = $this->validator;
			return view('users/register', $data);
		}
	}
}
