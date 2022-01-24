<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class WorldModel extends Model{
    protected $table = 'worlds';
    protected $primaryKey = 'world_id';
    protected $allowedFields = [
        'category_id',
        'user_id',
        'world_name',
        'world_info'
    ];

    private function worldByID($world_id)
    {
        return $this->where('world_id', $world_id);
    }

    private function worldByUser($user_id)
    {
        return $this->where('user_id', $user_id);
    }

    private function worldByCategory($category_id)
    {
        return $this->where('category_id', $category_id);
    }

    private function worldByName($world_name)
    {
        return $this->where('world_name LIKE BINARY', $world_name);
    }

    public function getUserWorld($world_id, $user_id)
    {
        return $this->worldByID($world_id)->worldByUser($user_id)->first();
    }

    public function getAllWorldByUser($user_id)
    {
        return $this->worldByUser($user_id)->findAll();
    }

    public function getAllWorldByCategory($category_id)
    {
        return $this->worldByCategory($category_id)->findAll();
    }

    public function getWorldByName($world_name)
    {
        return $this->worldByName($world_name)->first();
    }

    public function getWorldByID($world_id)
    {
        return $this->worldByID($world_id)->first();
    }
}