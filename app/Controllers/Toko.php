<?php

namespace App\Controllers;

use App\Models\modelAuth;
use App\Models\modelProduk;
use App\Models\ModelKeranjang;

class Toko extends BaseController
{
    protected $modelAuth;
    protected $modelProduk;
    public function __construct()
    {
        $this->modelAuth       = new ModelAuth();
        $this->modelProduk     = new ModelProduk();
        $this->modelKeranjang  = new ModelKeranjang();
        helper('form');
    }

    public function index()
    {
        if (session()->get('level') <> 2) {
            $model = new \App\Models\ModelAuth();
            $model->update(session()->get('id_user'), [
                'last_activity' => date('Y-m-d H:i:s')
            ]);
            
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }

        // fitur kategori
        $kategoriDipilih = $this->request->getGet('kategori');

        if ($kategoriDipilih) {
            $produk = $this->modelProduk->where('kategori', $kategoriDipilih)->findAll();
        } else {
            $produk = $this->modelProduk->findAll();
        }

        // ambil semua kategori unik buat select option
        $kategori = $this->modelProduk->select('kategori')->distinct()->findAll();

        // ambil filter dari request
        $kategoriDipilih = $this->request->getGet('kategori');
        $keyword         = $this->request->getGet('keyword');
        $minHarga        = $this->request->getGet('min_harga');
        $maxHarga        = $this->request->getGet('max_harga');

        // mulai query builder
        $produkQuery = $this->modelProduk;

        // filter kategori kalau ada
        if ($kategoriDipilih && $kategoriDipilih !== '#') {
            $produkQuery = $produkQuery->where('kategori', $kategoriDipilih);
        }

        // filter keyword kalau ada
        if ($keyword) {
            $produkQuery = $produkQuery->like('nama_produk', $keyword);
        }

        // filter harga kalau ada
        if ($minHarga) {
            $produkQuery = $produkQuery->where('harga >=', $minHarga);
        }
        if ($maxHarga) {
            $produkQuery = $produkQuery->where('harga <=', $maxHarga);
        }

        // ambil data produk paginate
        $produk = $produkQuery->orderBy('created_at', 'DESC')->paginate(18, 'produk');

        // fitur pencarian
        $keyword = $this->request->getVar('keyword');
        $modelProduk = new modelProduk();
        if ($keyword) {
            $modelProduk->like('nama_produk', $keyword);
        } else {
            $modelProduk = $this->modelProduk;
        }

        date_default_timezone_set('Asia/Jakarta');
        $jam = date('H');
        if ($jam >= 5 && $jam < 10) {
            $ucapan = 'Selamat Pagi';
        } elseif ($jam >= 10 && $jam < 15) {
            $ucapan = 'Selamat Siang';
        } elseif ($jam >= 15 && $jam < 18) {
            $ucapan = 'Selamat Sore';
        } else {
            $ucapan = 'Selamat Malam';
        }

        // fitur banner promo
        $dir = FCPATH . 'uploads/banner/';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $files = array_diff(scandir($dir), array('.', '..'));

        // total item di keranjang
        $id_user = session()->get('id_user');
        $totalItem = $this->modelKeranjang->getTotalKeranjang($id_user);

        $data = [
            'title'           => 'Belanja Furniture di Alrison Interior',
            'brand'           => 'Alrison Interior',
            'produk'          => $produk,
            'pager'           => $produkQuery->pager,
            'kategori'        => $kategori,
            'kategoriDipilih' => $kategoriDipilih,
            'minHarga'        => $minHarga,
            'maxHarga'        => $maxHarga,
            'keyword'         => $keyword,
            'ucapan'          => $ucapan,
            'banner'          => $files,
            'totalItem'       => $totalItem,
        ];

        return view('toko', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title'     => 'Detail Produk',
            'pdk'    => $this->modelProduk->getProduk($slug)
        ];

        return view('produk/detail_produk', $data);

        if (empty($data['produk'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk' . $slug . 'tidak ditemukan.');
        }
    }

    public function tambah_pesanan()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      => $this->request->getPost('id'),
            'qty'     => 1,
            'price'   => $this->request->getPost('price'),
            'name'    => $this->request->getPost('name'),
            'gambar'  => $this->request->getPost('gambar'),
        ));
        return redirect()->to('tes');
    }

    public function welcome()
    {
        $data = [
            'title' => 'Selamat Datang di Alrison Interior'
        ];

        return view('welcome', $data);
    }
}
