<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ItemModel extends Model{
    protected $table = 'items';
    protected $allowedFields = [
        'item_title',
        'item_price',
        'price_unit'
    ];

    private function itemBytitle($item_title)
    {
        return $this->where('item_title LIKE BINARY', $item_title);
    }

    public function titleByOrder($item_title)
    {
        return $this->like('item_title', $item_title)->orderBy("item_title", "ASC");
    }

    public function getItemByTitle($item_title)
    {
        return $this->itemBytitle($item_title)->first();
    }
}