<?php namespace App\Controllers\Admins;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;

class Auth extends Controller
{
	public function index()
	{
		$session = session();
		$username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
		$u_model = new UserModel();
		$u_data = $u_model->getUserByName($username);
		if($u_data) {
			$a_model = new AdminModel();
			$a_data = $a_model->getUserByID($u_data['user_id']);
			if($a_data) {
				$password_db = $u_data['user_password'];
				$password_verify = password_verify($password, $password_db);
				if($password_verify) {
					$session_data = [
						'admin_id'		=> $a_data['admin_id'],
						'admin_name'	=> $u_data['user_name'],
						'admin_role'	=> $a_data['admin_role'],
						'a_logged_in'		=> TRUE,
					];
					$session->set($session_data);
					return redirect()->to(base_url('admin/auth/login'));
				}else{
					$session->setFlashdata('msg', 'The password field is wrong.');
					return redirect()->to(base_url('admin/auth/login'));
				}
			}else{
				$session->setFlashdata('msg', 'The username field is not found.');
				return redirect()->to(base_url('admin/auth/login'));
			}
        }else{
            $session->setFlashdata('msg', 'The username field is not found.');
            return redirect()->to(base_url('admin/auth/login'));
        }
	}

	public function login()
	{
		if(session()->get('a_logged_in')) {
            return redirect()->to(base_url('admin/dashboard'));
		}else{
			helper(['form']);
			$data = [];
			return view('admins/login', $data);
		}
	}
	
	public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('admin/auth/login'));
    }
}
