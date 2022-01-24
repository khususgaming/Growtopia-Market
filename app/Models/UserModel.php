<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'user_name',
        'user_email',
        'user_password',
        'user_created_at'
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