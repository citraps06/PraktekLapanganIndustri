<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
// $routes->get('/admin/index', 'Admin::index');
// $routes->post('/admin/index', 'Admin::save');
// $routes->delete('/admin/index(:num)', 'Admin::delete_informasi/$1');
// $routes->get('/admin/update/(:num)', 'Admin::ubah/$1');
// $routes->patch('/admin/index', 'Admin::edit');
//Controller ADMIN
//controller::class
//$routes->get('/dashboard/admin', 'Admin::index');
//$routes->get('/informasi/admin', 'Admin::info');
//$routes->get('/informasi/save', 'Admin::save');
//$routes->get('/data/coaching', 'Admin::data');
//$routes->get('/absen/mhs/coaching', 'Admin::absensi');
//$routes->get('/status/coaching', 'Admin::status');
//$routes->get('/update/coaching', 'Admin::update');
//$routes->get('/data_/pli', 'Admin::data_');
//$routes->get('/status_/pli', 'Admin::status_');
//$routes->get('/dosen_/pembimbing', 'Admin::dpl');
//$routes->get('/nilai_/mahasiswa', 'Admin::nilai');

//Controller MAHASISWA
//controller::class
//$routes->get('/dashboard/mhs', 'Mahasiswa::index');
//$routes->get('/daftar/coaching/mhs', 'Mahasiswa::daftar');
//$routes->get('/daftar/coaching/success', 'Mahasiswa::succesberkas');
//$routes->get('/status/coaching/mhs', 'Mahasiswa::status');
//$routes->get('/ajukan/pli/mhs', 'Mahasiswa::ajukan');
//$routes->get('/daftar/pli/success', 'Mahasiswa::succespli');
//$routes->get('/status/pli/mhs', 'Mahasiswa::statusPli');
//$routes->get('/berkas/mhs', 'Mahasiswa::berkas');
//$routes->get('/berkas/mhs/success', 'Mahasiswa::succesberkas');
//$routes->get('/nilai/mhs', 'Mahasiswa::nilai');

//Controller DPL
//controller::class
//$routes->get('/dashboard/dpl', 'Dpl::index');
//$routes->get('/datamhs/dpl', 'Dpl::data');
//$routes->get('/nilaimhs/dpl', 'Dpl::nilai');
//$routes->get('/update/nilaiMhs/dpl', 'Dpl::update');

//Controller KOORDINATOR
//controller::class
//$routes->get('/dashboard/koor', 'Koordinator::index');
//$routes->get('/data/mhs/koor', 'Koordinator::data');
//$routes->get('/status/mhs/koor', 'Koordinator::status');
//$routes->get('/update/statusPLI/koor', 'Koordinator::update');
//$routes->get('/dosen/pembimbing/koor', 'Koordinator::dosen');
//$routes->get('/dospem/mhs/koor', 'Koordinator::dospem');
//$routes->get('/nilai/mhs/koor', 'Koordinator::nilai');
//$routes->get('/update/nilai/mhs/koor', 'Koordinator::updateNilai');

/*
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
