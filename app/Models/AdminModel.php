<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class AdminModel extends Model{
    protected $table = 'admins';
    protected $allowedFields = [
        'user_id',
        'admin_role',
        'admin_created_at'
    ];

    private function userByName($user_name)
    {
        return $this->where('user_name', $user_name);
    }

    private function userByID($user_id)
    {
        return $this->where('user_id', $user_id);
    }

    public function getUserByName($user_name)
    {
        return $this->userByName($user_name)->first();
    }

    public function getUserByID($user_id)
    {
        return $this->userByID($user_id)->first();
    }
}