<?php namespace App\Controllers\Admins;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Scrape extends Controller
{
	use ResponseTrait;

	public function index()
	{
		return view('admins/scrape');
	}
	
	public function item()
	{
		helper('scrape_helper');
		$response = scrape_item("Category:Item");
		$session = session();
		$session->setFlashdata('item_response', 'Item was successfully updated with a duration of '.$response['scrape_duration'].' seconds, a total of '.$response['item_total'].' items were added.');
		return redirect()->to(base_url('admin/scrape'));
	}

	public function category()
	{
		helper('scrape_helper');
		$response = scrape_category();
		$session = session();
		$session->setFlashdata('category_response', 'Category was successfully updated with a duration of '.$response['scrape_duration'].' seconds, a total of '.$response['category_total'].' categories were added.');
		return redirect()->to(base_url('admin/scrape'));
	}

	public function mixed()
	{
		helper('scrape_helper');
		$response = scrape_mixed();
		$session = session();
		$session->setFlashdata('mixed_response', 'Item-Category was successfully updated with a duration of '.$response['scrape_duration'].' seconds, a total of '.$response['mixed_total'].' were added.');
		return redirect()->to(base_url('admin/scrape'));
	}
}
