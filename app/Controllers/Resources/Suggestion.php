<?php namespace App\Controllers\Resources;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ItemModel;

class Suggestion extends ResourceController
{
	use ResponseTrait;

    public function itemTitle($title = null)
    {
        $item = new ItemModel();
        $data = $item->titleByOrder($title)->paginate(10);
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with title '.$title);
        }
    }
}
