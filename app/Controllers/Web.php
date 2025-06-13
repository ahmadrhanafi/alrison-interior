<?php

namespace App\Controllers;

use App\Models\modelProduk;
use App\Models\modelAuth;

class Web extends BaseController
{
    protected $modelProduk;
    protected $modelAuth;
    public function __construct()
    {
        $this->modelProduk  = new ModelProduk();
        $this->modelAuth    = new ModelAuth();
    }

    public function index()
    {
        // fitur kategori
        $kategoriDipilih = $this->request->getGet('kategori');

        if ($kategoriDipilih) {
            $produk = $this->modelProduk->where('kategori', $kategoriDipilih)->findAll();
        } else {
            $produk = $this->modelProduk->findAll();
        }

        // ambil semua kategori unik buat select option
        $kategori = $this->modelProduk->select('kategori')->distinct()->findAll();

        // banner promo
        $dir = FCPATH . 'uploads/banner/';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $files = array_diff(scandir($dir), array('.', '..'));

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
            'banner'          => $files
        ];

        return view('web', $data);
    }

    public function detail($slug)
    {
        $produk = $this->modelProduk->where('slug', $slug)->first();

        if (!empty($data['produk'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk' . $slug . 'tidak ditemukan.');
        }

        // Ambil produk terkait (kategori sama, kecuali dirinya sendiri)
        $produkTerkait = $this->modelProduk
            ->where('kategori', $produk['kategori'])
            ->where('id_produk !=', $produk['id_produk'])
            ->orderBy('created_at', 'DESC')
            ->findAll(8);

        $data = [
            'title'         => 'Detail Produk - Alrison Interior',
            'produk'        => $this->modelProduk->getProduk($slug),
            'produkTerkait' => $produkTerkait,
        ];

        return view('/detail', $data);
    }
}
