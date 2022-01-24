<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ItemSellModel extends Model{
    protected $table = 'item_sell';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'item_id',
        'world_id',
        'user_id',
        'item_price',
        'item_amount'
    ];

    private function itemByID($id)
    {
        return $this->where('id', $id);
    }

    private function itemByItem($item_id)
    {
        return $this->where('item_id', $item_id);
    }

    private function itemByUser($user_id)
    {
        return $this->where('user_id', $user_id);
    }
    
    private function itemByPrice($item_price)
    {
        return $this->where('item_price', $item_price);
    }

    public function getItemByID($id)
    {
        return $this->itemByID($id)->first();
    }

    public function getUserItem($item_id, $user_id)
    {
        return $this->itemByItem($item_id)->itemByUser($user_id)->first();
    }

    public function getAllItemByUser($user_id)
    {
        return $this->itemByUser($user_id)->findAll();
    }
}