<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class CategoryItemModel extends Model{
    protected $table = 'category_item';
    protected $allowedFields = [
        'category_id',
        'item_id'
    ];

    private function categoryByID($category_id)
    {
        return $this->where('category_id', $category_id);
    }

    private function categoryByItem($item_id)
    {
        return $this->where('item_id', $item_id);
    }

    public function getCategoryItem($category_id, $item_id)
    {
        return $this->categoryByID($category_id)->categoryByItem($item_id)->first();
    }
}