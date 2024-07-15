<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('/truck', 'Admin::truck');
// $routes->get('/delete-truck/(:num)', 'Admin::deletetruck/$1');
$routes->post('/tambah-truck', 'Admin::tambahtruck');
$routes->post('/simpan-truck', 'Admin::simpantruck');

// $routes->get('/surat-jalan', 'Admin::suratjalan');
// $routes->get('/print-surat-jalan/(:num)', 'Admin::printsurat/$1');
$routes->post('/tambah-surat-jalan', 'Admin::tambahsuratjalan');

// $routes->get('/get-truck','DataTable::truck');
// $routes->get('/get-surat','DataTable::surat');
// $routes->get('/get-truck-by-id/(:num)','Admin::getTruckById/$1');


// $routes->get('/rekap-data', 'Admin::rekapdata');

// $routes->get('/users', 'Admin::users');

$routes->post('/auth/login','Auth::login');
$routes->post('/auth/register','Auth::createuser');

$routes->group('', ['filter' => 'authCheck'], function($routes){
    $routes->get('/truck', 'Admin::truck');
    $routes->get('/delete-truck/(:num)', 'Admin::deletetruck/$1');

    $routes->get('/surat-jalan', 'Admin::suratjalan');
    $routes->get('/delete-surat/(:num)', 'Admin::deletesurat/$1');
    $routes->get('/print-surat-jalan/(:num)', 'Admin::printsurat/$1');

    $routes->get('/get-truck','DataTable::truck');
    $routes->get('/get-surat','DataTable::surat');
    $routes->get('/get-surat-checker','DataTable::suratChecker');
    // $routes->get('/get-surat/(:num)','DataTable::surat');
    $routes->get('/get-users','DataTable::users');
    $routes->get('/get-truck-by-id/(:num)','Admin::getTruckById/$1');

    $routes->get('/rekap-data', 'Admin::rekapdata');

    $routes->get('/users', 'Admin::users'); 
    $routes->post('/update-users', 'Auth::updateUsers'); 
    $routes->get('/delete-users/(:num)', 'Admin::deleteUser/$1'); 
    $routes->get('/get-user-by-id/(:num)', 'Admin::getUserById/$1'); 

    $routes->get('/checker', 'Admin::checker'); 
    $routes->post('/checker', 'Admin::checker'); 
    $routes->post('/checker-submit', 'Admin::updatesurat'); 
    $routes->post('/get-rekap-data-api', 'Admin::getRekapData');
    $routes->get('/get-rekap-data-by-id/(:num)', 'Admin::getRekapById/$1'); 
    $routes->get('/keluar', 'Auth::logout'); 
});