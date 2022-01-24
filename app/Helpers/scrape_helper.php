<?php

use App\Models\ItemModel;
use App\Models\ItemCategoriesModel;
use App\Models\CategoryItemModel;

function scrape_item($cmtitle) {
	$start_time = microtime(true);
	$item_model = new ItemModel();
	// Ambil data berdasarkan kategori item
	$url_category = file_get_contents("https://growtopia.fandom.com/api.php?action=query&list=categorymembers&cmtitle=".$cmtitle."&cmlimit=100&format=json");
	$json_category = json_decode($url_category, true);
	foreach($json_category['query']['categorymembers'] as $item) {
		// Cek jika ada selain title item
		if(strpos($item['title'], "User:") !== false
		|| strpos($item['title'], "Category:") !== false
		|| strpos($item['title'], "Special:") !== false) continue;
		// Cek jika item sudah terdapat pada database
		$item_exist = $item_model->getItemByTitle($item['title']);
		if($item_exist) continue;

		$data = [
			'item_title'	=>	$item['title']
		];
		$item_model->save($data);
		$item_total++;
	}
	// Cek jika terdapat halaman selanjutnya
	if(isset($json_category['continue']['cmcontinue'])) {
		$cmcontinue = $json_category['continue']['cmcontinue'];
		// Kembali ke sini jika terdapat halaman selanjutnya
		repeat_continue:
		$url_continue = file_get_contents("https://growtopia.fandom.com/api.php?action=query&list=categorymembers&cmtitle=".$cmtitle."&cmlimit=100&cmcontinue=".$cmcontinue."&format=json");
		$json_continue = json_decode($url_continue, true);
		foreach($json_continue['query']['categorymembers'] as $item) {
			// Cek jika ada selain title item
			if(strpos($item['title'], "User:") !== false
			|| strpos($item['title'], "Category:") !== false
			|| strpos($item['title'], "Special:") !== false) continue;
			// Cek jika item sudah terdapat pada database
			$item_exist = $item_model->getItemByTitle($item['title']);
			if($item_exist) continue;

			$data = [
				'item_title'	=>	$item['title']
			];
			$item_model->save($data);
			$item_total++;
		}
		if(isset($json_continue['continue']['cmcontinue'])) {
			$cmcontinue = $json_continue['continue']['cmcontinue'];
			// Jika terdapat halaman selanjutnya akan kembali ke atas
			goto repeat_continue;
		}
	}
	$end_time = microtime(true);
	$seconds = $end_time - $start_time;
	$seconds = round($seconds, 2);
	if($item_total == NULL) $item_total = 0;
	$data = [
		'item_total'		=>	$item_total,
		'scrape_duration'	=>	$seconds
	];
	return $data;
}

function scrape_category() {
	$start_time = microtime(true);
	$item_categories = new ItemCategoriesModel();
	// Ambil data semua kategori
	$url_category = file_get_contents("https://growtopia.fandom.com/api.php?action=query&list=allcategories&acprop=size&aclimit=100&format=json");
	$json_category = json_decode($url_category, true);
	foreach($json_category['query']['allcategories'] as $category) {
		// Cek jika kategori sudah terdapat pada database
		$category_exist = $item_categories->getCategoryByTitle($category['*']);
		if($category_exist) continue;

		$data = [
			'category_title'	=>	$category['*']
		];
		$item_categories->save($data);
		$category_total++;
	}
	// Cek jika terdapat halaman selanjutnya
	if(isset($json_category['continue']['accontinue'])) {
		$accontinue = $json_category['continue']['accontinue'];
		// Kembali ke sini jika terdapat halaman selanjutnya
		repeat_continue:
		$url_continue = file_get_contents("https://growtopia.fandom.com/api.php?action=query&list=allcategories&acprop=size&aclimit=100&accontinue=".$accontinue."&format=json");
		$json_continue = json_decode($url_continue, true);
		foreach($json_continue['query']['allcategories'] as $category) {
			// Cek jika kategori sudah terdapat pada database
			$category_exist = $item_categories->getCategoryByTitle($category['*']);
			if($category_exist) continue;

			$data = [
				'category_title'	=>	$category['*']
			];
			$item_categories->save($data);
			$category_total++;
		}
		if(isset($json_continue['continue']['accontinue'])) {
			$accontinue = $json_continue['continue']['accontinue'];
			// Jika terdapat halaman selanjutnya akan kembali ke atas
			goto repeat_continue;
		}
	}
	$end_time = microtime(true);
	$seconds = $end_time - $start_time;
	$seconds = round($seconds, 2);
	if($category_total == NULL) $category_total = 0;
	$data = [
		'category_total'	=>	$category_total,
		'scrape_duration'	=>	$seconds
	];
	return $data;
}

function scrape_mixed() {
	$start_time = microtime(true);
	$item_categories = new ItemCategoriesModel();
	$item_model = new ItemModel();
	$category_item = new CategoryItemModel();
	// Ambil data kategori pada database
	$category_all = $item_categories->findAll();
	foreach($category_all as $category) {
		// Ambil data berdasarkan kategori item
		$url_category = file_get_contents("https://growtopia.fandom.com/api.php?action=query&list=categorymembers&cmtitle=Category:".urlencode($category['category_title'])."&cmlimit=100&format=json");
		$json_category = json_decode($url_category, true);
		foreach($json_category['query']['categorymembers'] as $item) {
			// Cek jika selain title item
			if(strpos($item['title'], "User:") !== false
			|| strpos($item['title'], "Category:") !== false
			|| strpos($item['title'], "Special:") !== false) continue;
			// Cek jika item terdapat pada database
			$item_exist = $item_model->getItemByTitle($item['title']);
			if($item_exist) {
				// Cek jika item dan kategori sudah ada
				$category_item_exist = $category_item->getCategoryItem($category['category_id'], $item_exist['item_id']);
				if($category_item_exist) {
					continue;
				} else {
					$data = [
						'category_id'	=>	$category['category_id'],
						'item_id'		=>	$item_exist['item_id']
					];
					$category_item->save($data);
					$mixed_total++;
				}
			} else {
				continue;
			}
		}
		// Cek jika terdapat halaman selanjutnya
		if(isset($json_category['continue']['cmcontinue'])) {
			$cmcontinue = $json_category['continue']['cmcontinue'];
			// Kembali ke sini jika terdapat halaman selanjutnya
			repeat_continue:
			$url_continue = file_get_contents("https://growtopia.fandom.com/api.php?action=query&list=categorymembers&cmtitle=Category:".urlencode($category['category_title'])."&cmlimit=100&cmcontinue=".$cmcontinue."&format=json");
			$json_continue = json_decode($url_continue, true);
			foreach($json_continue['query']['categorymembers'] as $item) {
				// Cek jika selain title item
				if(strpos($item['title'], "User:") !== false
				|| strpos($item['title'], "Category:") !== false
				|| strpos($item['title'], "Special:") !== false) continue;
				// Cek jika item terdapat pada database
				$item_exist = $item_model->getItemByTitle($item['title']);
				if($item_exist) {
					$category_item_exist = $category_item->getCategoryItem($category['category_id'], $item_exist['item_id']);
					if($category_item_exist) {
						continue;
					} else {
						$data = [
							'category_id'	=>	$category['category_id'],
							'item_id'		=>	$item_exist['item_id']
						];
						$category_item->save($data);
						$mixed_total++;
					}
				} else {
					continue;
				}
			}
			if(isset($json_continue['continue']['cmcontinue'])) {
				$cmcontinue = $json_continue['continue']['cmcontinue'];
				// Jika terdapat halaman selanjutnya akan kembali ke atas
				goto repeat_continue;
			}
		}
	}
	$end_time = microtime(true);
	$seconds = $end_time - $start_time;
	$seconds = round($seconds, 2);
	if($mixed_total == NULL) $mixed_total = 0;
	$data = [
		'mixed_total'		=>	$mixed_total,
		'scrape_duration'	=>	$seconds
	];
	return $data;
}