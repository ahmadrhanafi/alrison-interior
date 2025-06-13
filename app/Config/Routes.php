<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --> PENGUNJUNG <-- //
$routes->get('/', 'Web::index');
$routes->get('/web', 'Web::index');
$routes->get('/detail/(:any)', 'Web::detail/$1');


// --> GATES OF ALRISON INTERIOR <-- //
$routes->get('/auth/web', 'Web::index');
// register
$routes->get('/auth/register', 'Auth::register');
// simpan register
$routes->post('/auth/simpan_register', 'Auth::simpan_register');
// cek login
$routes->post('/auth/cek_login', 'Auth::cek_login');
// login
$routes->get('/auth/login', 'Auth::login');
// logout
$routes->get('/auth/logout', 'Auth::logout');
// lupa password
$routes->get('/forgot-password', 'Auth::forgotPassword');
$routes->post('/forgot-password', 'Auth::sendResetLink');
// reset password
$routes->get('/reset-password/(:any)', 'Auth::resetPassword/$1');
$routes->post('/reset-password/(:any)', 'Auth::processResetPassword/$1');
// ganti password
$routes->get('/change-password', 'Auth::changePassword', ['filter' => 'auth']);
$routes->post('/change-password', 'Auth::processChangePassword', ['filter' => 'auth']);


// --> CONSUMER <-- //
$routes->get('/toko/selamat-datang', 'Toko::welcome');
$routes->post('/simpan-foto', 'Auth::simpan_foto');
// halaman toko
$routes->get('/toko', 'Toko::index', ['filter' => 'activity']);
// akses pencarian
$routes->get('/cari-produk', 'Produk::search');
// akses produk
$routes->get('/detail-produk/(:any)', 'Produk::detail/$1');
// akses profil
$routes->get('/profil-saya', 'Profile::index');
$routes->post('/profil-saya/update', 'Profile::update');
// akses pesanan
$routes->get('/pesanan', 'Pesanan::riwayat');

// menu keranjang
$routes->get('/keranjang', 'Keranjang::index');
$routes->get('/tambah-keranjang/(:num)', 'Keranjang::tambah/$1');
$routes->post('/keranjang/hapus/(:num)', 'Keranjang::hapus/$1');
$routes->get('/kosongkan-keranjang', 'Keranjang::kosongkan');

// CRUD pesanan
// tambah pesanan
$routes->get('/order/(:any)', 'Pesanan::order/$1');
$routes->get('/order/buat-pesanan', 'Pesanan::tambah');
$routes->get('/order-keranjang', 'Pesanan::fromCart'); 
// simpan pesanan
$routes->post('/simpan_pesanan', 'Pesanan::simpan');
// detail pesanan
$routes->get('/pesanan/detail-pesanan/(:num)', 'Pesanan::detail/$1');
// edit pesanan
$routes->get('/pesanan/edit/(:num)', 'Pesanan::edit/$1');
$routes->get('/pesanan/edit_pesanan(:num)', 'Pesanan::edit/$1');
$routes->post('/pesanan/update/(:num)', 'Pesanan::update/$1');
// hapus pesanan
$routes->get('/pesanan/hapus/(:num)', 'Pesanan::hapus/$1');

// pembayaran
$routes->get('/pesanan/token/(:num)', 'Pesanan::token/$1');
// callback
$routes->post('/midtrans/callback', 'MidtransCallback::notification');


// cek indikator aktivitas online/offline
$routes->group('toko', ['filter' => 'activity'], function($routes) {
    $routes->get('', 'Toko::index');
    $routes->get('detail-produk/(:any)', 'Produk::detail/$1');
    $routes->get('keranjang', 'Keranjang::index');
    $routes->get('tambah-keranjang/(:num)', 'Keranjang::tambah/$1');
    $routes->get('pesanan', 'Pesanan::pesananUser');
    $routes->get('profil-saya', 'Profile::index');
    $routes->post('profil-saya/update', 'Profile::update');
    $routes->get('tambah_pesanan', 'Pesanan::tambah');
    $routes->get('pesanan/detail-pesanan/(:num)', 'Pesanan::detail/$1');
    $routes->get('pesanan/edit/(:num)', 'Pesanan::edit/$1');
    $routes->get('pesanan/token/(:num)', 'Pesanan::token/$1');
});

// --> ADMINISTRATOR <-- //
// halaman dashboard admin
$routes->get('/dashboard', 'Dashboard::index');
// akses konsumen website
$routes->get('admin/konsumen', 'Admin::dataKonsumen');
$routes->get('admin/edit-konsumen/(:num)', 'Admin::editKonsumen/$1');
$routes->delete('admin/delete-konsumen/(:num)', 'Admin::deleteKonsumen/$1');

// ganti banner promo
$routes->post('/banner', 'Dashboard::uploadBanner');
// hapus banner promo
$routes->get('/dashboard/deleteBanner/(:any)', 'Dashboard::deleteBanner/$1');

// ---> menu produk <--- //
$routes->get('/daftar-produk', 'Produk::index');
$routes->get('/produk/(:any)', 'Produk::detail/$1');

// CRUD produk
$routes->get('/tambah-produk', 'Produk::tambah');
$routes->post('/simpan_produk', 'Produk::simpan');
$routes->post('/produk', 'Produk::index');
$routes->post('/hapus_gambar/(:num)', 'Produk::hapus_gambar/$1');
$routes->delete('/produk/(:num)', 'Produk::hapus/$1');
// $routes->delete('/produk(:num)', 'Produk::hapus/$1');
$routes->get('/edit-produk/(:num)', 'Produk::ubah/$1');
$routes->post('/edit_produk/update_produk', 'Produk::update');

// ---> menu konsumen <--- //
$routes->get('/daftar-konsumen', 'Konsumen::index');
// CRUD konsumen
$routes->get('/tambah-konsumen', 'Konsumen::tambah');
$routes->post('/simpan_konsumen', 'Konsumen::simpan');
$routes->post('/konsumen', 'Konsumen::index');
$routes->delete('/konsumen/(:num)', 'Konsumen::hapus/$1');
// $routes->delete('/(:num)', 'Konsumen::hapus/$1');
$routes->get('/edit-konsumen/(:num)', 'Konsumen::ubah/$1');
$routes->post('/edit_konsumen/update_konsumen', 'Konsumen::update');

// ---> menu transaksi <--- //
// manual
$routes->get('/transaksi-manual', 'Transaksi::index');
// website
$routes->get('/transaksi-website', 'Transaksi::transaksiWebsite');


// CRUD transaksi
$routes->get('/tambah-transaksi', 'Transaksi::tambah');
$routes->post('/simpan_transaksi', 'Transaksi::simpan');
$routes->delete('/transaksi/(:num)', 'Transaksi::hapus/$1');
$routes->get('/edit_transaksi/(:num)', 'Transaksi::ubah/$1');
$routes->post('/edit_transaksi/update_transaksi', 'Transaksi::update');
$routes->get('/detail_transaksi/(:any)', 'Transaksi::detail/$1');

// ---> menu pesanan dashboard <--- //
$routes->get('/kelola-pesanan', 'Admin::pesanan');
// admin kelola pesanan konsumen
$routes->post('/admin/updateStatus/(:num)', 'Admin::updateStatus/$1');
// admin melihat detail pesanan konsumen
$routes->get('/admin/detail-pesanan/(:num)', 'Admin::detail/$1');
// admin menghapus pesanan konsumen
$routes->get('/admin/kelola-pesanan/hapus/(:num)', 'Admin::hapus/$1');


// ---> halaman statis <--- //
// tentang
$routes->get('/tentang/tentang-kami', 'Pages::tentang_kami');
$routes->get('/tentang-kami', 'Pages::tentang_kami');
$routes->get('/tentang/penjualan-perusahaan', 'Pages::penjualan_perusahaan');
$routes->get('/tentang/syarat-kebijakan', 'Pages::syarat_kebijakan');
$routes->get('/tentang/komunitas', 'Pages::komunitas');

// dukungan
$routes->get('/dukungan/bantuan', 'Pages::bantuan');
$routes->get('/dukungan/dukungan', 'Pages::dukungan');
$routes->get('/dukungan', 'Pages::dukungan');
$routes->get('/dukungan/kebijakan-privasi', 'Pages::kebijakan_privasi');
$routes->get('/dukungan/bantuan-dukungan', 'Pages::bantuan_dukungan');

// kontak
$routes->get('/pusat-panggilan', 'Pages::pusat_panggilan');
$routes->get('/kontak/pusat-panggilan', 'Pages::pusat_panggilan');
$routes->get('/kontak-kami', 'Pages::pusat_panggilan');
$routes->get('/kontak', 'Pages::pusat_panggilan');
$routes->get('/kontak/syarat-ketentuan', 'Pages::syarat_ketentuan');
$routes->get('/kontak/pusat-bantuan', 'Pages::pusat_bantuan');

// tambahan
$routes->get('/faqs', 'Pages::faq');