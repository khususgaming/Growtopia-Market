<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Users\Home::index');
$routes->get('about', 'Users\Home::about');
$routes->get('farming-calculator', 'Users\Home::farming');
$routes->group('auth', function($routes) {
	$routes->add('/', 'Users\Auth::index');
	$routes->get('login', 'Users\Auth::login');
	$routes->get('logout', 'Users\Auth::logout');
	$routes->get('register', 'Users\Auth::register');
	$routes->add('save', 'Users\Auth::save');
});
$routes->group('api', function($routes) {
	$routes->get('item/(:segment)', 'Resources\Suggestion::itemTitle/$1');
});
$routes->group('dashboard', ['filter' => 'u_auth'], function($routes) {
	$routes->get('/', 'Users\Dashboard::index');
	$routes->add('create', 'Users\Dashboard::create');
	$routes->add('(:segment)/edit', 'Users\Dashboard::update/$1');
	$routes->add('(:segment)/delete', 'Users\Dashboard::delete/$1');
});
$routes->group('item', ['filter' => 'u_auth'], function($routes) {
	$routes->get('/', 'Users\ItemSell::index');
	$routes->add('create', 'Users\ItemSell::create');
	$routes->add('(:segment)/edit', 'Users\ItemSell::update/$1');
	$routes->add('(:segment)/delete', 'Users\ItemSell::delete/$1');
});
$routes->group('category', function($routes) {
	$routes->get('item/(:segment)', 'Users\Category::item/$1');
	$routes->get('world/(:segment)', 'Users\Category::world/$1');
});
$routes->group('world', function($routes) {
	$routes->get('(:segment)', 'Users\World::world/$1');
});
$routes->group('admin', function($routes) {
	$routes->get('/', 'Admins\Auth::login');
	$routes->group('auth', function($routes) {
		$routes->add('/', 'Admins\Auth::index');
		$routes->get('login', 'Admins\Auth::login');
		$routes->get('logout', 'Admins\Auth::logout');
	});
	$routes->group('dashboard', ['filter' => 'a_auth'], function($routes) {
		$routes->get('/', 'Admins\Dashboard::index');
		$routes->add('create', 'Admins\Dashboard::create');
		$routes->add('(:segment)/edit', 'Admins\Dashboard::update/$1');
		$routes->add('(:segment)/delete', 'Admins\Dashboard::delete/$1');
	});
	$routes->group('item', ['filter' => 'a_auth'], function($routes) {
		$routes->get('/', 'Admins\Item::index');
		$routes->add('create', 'Admins\Item::create');
		$routes->add('(:segment)/edit', 'Admins\Item::update/$1');
		$routes->add('(:segment)/delete', 'Admins\Item::delete/$1');
	});
	$routes->group('category', ['filter' => 'a_auth'], function($routes) {
		$routes->get('/', 'Admins\Category::index');
		$routes->add('create', 'Admins\Category::create');
		$routes->add('(:segment)/edit', 'Admins\Category::update/$1');
		$routes->add('(:segment)/delete', 'Admins\Category::delete/$1');
	});
	$routes->group('user', ['filter' => 'a_auth'], function($routes) {
		$routes->get('/', 'Admins\User::index');
		$routes->add('create', 'Admins\User::create');
		$routes->add('(:segment)/edit', 'Admins\User::update/$1');
		$routes->add('(:segment)/delete', 'Admins\User::delete/$1');
	});
	$routes->group('scrape', ['filter' => 'a_auth'], function($routes) {
		$routes->get('/', 'Admins\Scrape::index');
		$routes->get('item', 'Admins\Scrape::item');
		$routes->get('category', 'Admins\Scrape::category');
		$routes->get('mixed', 'Admins\Scrape::mixed');
		$routes->get('brand', 'Admins\Scrape::get_all_brand');
		$routes->get('type', 'Admins\Scrape::get_brand_type');
		$routes->get('specs', 'Admins\Scrape::get_tipe_specs');
	});
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
