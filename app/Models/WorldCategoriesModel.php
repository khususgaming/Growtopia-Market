<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class WorldCategoriesModel extends Model{
    protected $table = 'world_categories';
    protected $primaryKey = 'category_id';
    protected $allowedFields = ['category_title'];

    private function categoryByTitle($category_title)
    {
        return $this->where('category_title LIKE BINARY', $category_title);
    }

    private function categoryByID($category_id)
    {
        return $this->where('category_id', $category_id);
    }

    public function getCategoryByTitle($category_title)
    {
        return $this->categoryByTitle($category_title)->first();
    }

    public function getCategoryByID($category_id)
    {
        return $this->categoryByID($category_id)->first();
    }
}