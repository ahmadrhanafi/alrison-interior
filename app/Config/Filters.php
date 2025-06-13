<?php

namespace Config;

use App\Filters\AuthFilter;
use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>>
     *
     * [filter_name => classname]
     * or [filter_name => [classname1, classname2, ...]]
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'adminfilter'    => \App\Filters\AdminFilter::class,
        'konsumenfilter' => \App\Filters\KonsumenFilter::class,
        'pengunjung'     => \App\Filters\Pengunjung::class,
        'auth'           => \App\Filters\Auth::class,
        'activity'       => \App\Filters\UpdateActivity::class,

    ];

    /**
     * List of special required filters.
     *
     * The filters listed here are special. They are applied before and after
     * other kinds of filters, and always applied even if a route does not exist.
     *
     * Filters set by default provide framework functionality. If removed,
     * those functions will no longer work.
     *
     * @see https://codeigniter.com/user_guide/incoming/filters.html#provided-filters
     *
     * @var array{before: list<string>, after: list<string>}
     */
    public array $required = [
        'before' => [
            'forcehttps', // Force Global Secure Requests
            'pagecache',  // Web Page Caching
        ],
        'after' => [
            'pagecache',   // Web Page Caching
            'performance', // Performance Metrics
            'toolbar',     // Debug Toolbar
        ],
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, list<string>>
     */
    public array $globals = [
        'before' => [
            'adminfilter' => ['except' => [
                'Auth',
                'Auth/*',
                'Web',
                'Web/*',
                '/'
            ]],
            'konsumenfilter' => ['except' => [
                'Auth',
                'Auth/*',
                'Web',
                'Web/*',
                '/'
            ]],

            'pengunjung' => ['except' => [
                'Auth/*',
                '/auth/login',
                '/auth/register',
                '/auth/simpan_register',
                '/auth/cek_login',
                '/auth/logout',
                'Web',
                'Web/*',
                '/',
                'Pages/*',
                '/tentang/tentang-kami',
                '/tentang/penjualan-perusahaan',
                '/tentang/syarat-kebijakan',
                '/tentang/komunitas',
                '/dukungan/bantuan',
                '/dukungan/dukungan',
                '/dukungan/kebijakan-privasi',
                '/dukungan/bantuan-dukungan',
                '/kontak/pusat-panggilan',
                '/email-kami',
                '/kontak/syarat-ketentuan',
                '/kontak/pusat-bantuan',
                '/kontak-kami',
                '/dukungan',
                '/tentang-kami',
                '/faqs',
            ]],

            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'adminfilter' => ['except' => [
                'Auth',
                'Auth/login',
                'Auth/register',
                'Auth/simpan_register',
                'Auth/cek_login',
                'Auth/logout',
                'change-password',
                'Profile/*',
                '/profil-saya',
                '/profil-saya/update',
                'Dashboard',
                'Dashboard/uploadBanner',
                'dashboard',
                '/banner',
                // menu produk
                'Produk',
                'Produk/*',
                '/daftar-produk',
                '/tambah-produk',
                '/simpan_produk',
                '/edit-produk/*',
                '/edit_produk/update_produk',
                '/detail_produk/*',
                // menu konsumen
                'Konsumen',
                'Konsumen/*',
                '/daftar-konsumen',
                '/tambah-konsumen',
                '/simpan_konsumen',
                '/edit-konsumen/*',
                '/edit_konsumen/update_konsumen',
                // menu transaksi
                'Transaksi',
                'Transaksi/*',
                '/transaksi-manual',
                '/transaksi-website',
                '/tambah-transaksi',
                '/simpan_transaksi',
                '/edit_transaksi/*',
                '/edit_transaksi/update_transaksi',
                '/detail_transaksi/*',
                'Admin/*',
                '/admin/konsumen',
                '/kelola-pesanan',
            ]],
            'konsumenfilter' => ['except' => [
                'Auth/cek_login',
                'Auth/welcome',
                'auth/logout',
                'change-password',
                'toko/selamat-datang',
                'simpan-foto',
                'Toko',
                'Toko/*',
                '/cari-produk',
                '/detail-produk/*',
                'Profile/*',
                '/profil-saya',
                '/profil-saya/update',
                'Keranjang/*',
                '/keranjang',
                '/tambah-keranjang/*',
                '/kosongkan-keranjang',
                '/keranjang/hapus/*',
                'Pesanan',
                'Pesanan/*',
                '/order/*',
                '/order/tambah_pesanan',
                '/order-keranjang',
                '/order/simpan_pesanan',
                '/simpan_pesanan',
                '/pesanan/detail-pesanan*',
                '/pesanan/edit/*',
                '/pesanan/hapus/*',
                '/pesanan/token/*',
                'Pages/*',
                '/tentang/tentang-kami',
                '/tentang/penjualan-perusahaan',
                '/tentang/syarat-kebijakan',
                '/tentang/komunitas',
                '/dukungan/bantuan',
                '/dukungan/dukungan',
                '/dukungan/kebijakan-privasi',
                '/dukungan/bantuan-dukungan',
                '/kontak/pusat-panggilan',
                '/email-kami',
                '/kontak/syarat-ketentuan',
                '/kontak/pusat-bantuan',
                '/kontak-kami',
                '/dukungan',
                '/tentang-kami',
                '/faqs',
            ]],

            'pengunjung' => ['except' => [
                'Auth',
                'Auth/*',
                'Toko',
                'Toko/*',
                '/detail_produk/*',
                'Pages/*',
                '/tentang/tentang-kami',
                '/tentang/penjualan-perusahaan',
                '/tentang/syarat-kebijakan',
                '/tentang/komunitas',
                '/dukungan/bantuan',
                '/dukungan/dukungan',
                '/dukungan/kebijakan-privasi',
                '/dukungan/bantuan-dukungan',
                '/kontak/pusat-panggilan',
                '/email-kami',
                '/kontak/syarat-ketentuan',
                '/kontak/pusat-bantuan',
                '/kontak-kami',
                '/dukungan',
                '/tentang-kami',
                '/faqs',
            ]],

            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'POST' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     *
     * @var array<string, list<string>>
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array<string, array<string, list<string>>>
     */
    public array $filters = [];
}
