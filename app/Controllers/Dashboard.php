<?php

namespace App\Controllers;

use App\Models\ModelProduk;
use App\Models\ModelKonsumen;
use App\Models\ModelPesanan;
use App\Models\ModelTransaksi;
use App\Models\ModelAuth;

class Dashboard extends BaseController
{
    protected $modelProduk;
    protected $modelKonsumen;
    protected $modelPesanan;
    protected $modelTransaksi;
    protected $modelAuth;
    protected $db;

    public function __construct()
    {
        $this->modelProduk    = new ModelProduk();
        $this->modelKonsumen  = new ModelKonsumen();
        $this->modelPesanan   = new ModelPesanan();
        $this->modelTransaksi = new ModelTransaksi();
        $this->modelAuth      = new ModelAuth();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (session()->get('level') <> 1) {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }

        $modelKonsumen  = new ModelKonsumen();
        $modelProduk    = new ModelProduk();
        $modelPesanan   = new ModelPesanan();
        $modelTransaksi = new ModelTransaksi();
        $modelAuth      = new ModelAuth();

        // Ambil bulan & tahun dari query string kalau ada, kalau tidak pakai bulan & tahun sekarang
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        // Total dari pesanan selesai (per bulan & tahun)
        $totalPesananSelesai = $modelPesanan
            ->selectSum('total_harga')
            ->where('status', 'Selesai')
            ->where('MONTH(created_at)', $bulan)
            ->where('YEAR(created_at)', $tahun)
            ->get()
            ->getRow()
            ->total_harga;

        // Total transaksi penjualan (per bulan & tahun)
        $totalTransaksiPenjualan = $modelTransaksi
            ->selectSum('total')
            ->where('jenis_transaksi', 'Penjualan')
            ->where('status', 'Selesai')
            ->where('MONTH(created_at)', $bulan)
            ->where('YEAR(created_at)', $tahun)
            ->get()
            ->getRow()
            ->total;

        // Total pembelian (pengeluaran biaya) (per bulan & tahun)
        $totalPembelian = $modelTransaksi
            ->selectSum('total')
            ->where('jenis_transaksi', 'Pembelian')
            ->where('MONTH(created_at)', $bulan)
            ->where('YEAR(created_at)', $tahun)
            ->get()
            ->getRow()
            ->total;

        // Total penjualan = pesanan selesai + transaksi penjualan
        $totalPenjualan = $totalPesananSelesai + $totalTransaksiPenjualan;

        // Ringkasan saldo
        $saldo = $totalPenjualan - $totalPembelian;

        // Total pengeluaran (per bulan & tahun)
        $totalPengeluaran = $modelTransaksi
            ->selectSum('total')
            ->where('jenis_transaksi', 'Pembelian')
            ->where('MONTH(created_at)', $bulan)
            ->where('YEAR(created_at)', $tahun)
            ->get()
            ->getRow()
            ->total;

        // Total pesanan (per bulan & tahun)
        $totalPesanan = $modelPesanan
            ->where('MONTH(created_at)', $bulan)
            ->where('YEAR(created_at)', $tahun)
            ->countAllResults();

        // Total stok barang (stok itu sifatnya real-time, nggak pake bulan & tahun)
        $totalStok = $modelProduk->getTotalStok();

        // Total konsumen online (level 2) (per bulan & tahun)
        $totalLevel2 = $modelAuth
            ->where('level', 2)
            ->where('MONTH(created_at)', $bulan)
            ->where('YEAR(created_at)', $tahun)
            ->countAllResults();

        // Fitur pencarian produk
        $keyword = $this->request->getVar('keyword');
        $produkQuery = new ModelProduk();
        if ($keyword) {
            $produkQuery->like('nama_produk', $keyword);
        }

        // Banner Promo (cek folder dan ambil file)
        $dir = FCPATH . 'uploads/banner/';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $files = array_diff(scandir($dir), array('.', '..'));

        // Data ke view
        $data = [
            'title'         => 'Dashboard Administrator - Alrison Interior',
            'saldo'         => $saldo ?? 0,
            'konsumen'      => $totalLevel2 ?? 0,
            'penjualan'     => $totalPenjualan ?? 0,
            'pengeluaran'   => $totalPengeluaran ?? 0,
            'pesanan'       => $totalPesanan ?? 0,
            'stok'          => $totalStok ?? 0,
            'produk'        => $produkQuery->paginate(12, 'produk'),
            'pager'         => $produkQuery->pager,
            'banner'        => $files,
            'bulan'         => $bulan,
            'tahun'         => $tahun,
        ];

        return view('dashboard/dashboard', $data);
    }


    public function uploadBanner()
    {
        $file = $this->request->getFile('banner');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/banner/', $newName);
            return redirect()->to(base_url('dashboard'))->with('sukses', 'Banner promo berhasil dipasang.');
        } else {
            return redirect()->to(base_url('dashboard'))->with('gagal', 'Upload gagal.');
        }
    }


    public function deleteBanner($filename)
    {
        $path = FCPATH . 'uploads/banner/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return redirect()->to(base_url('dashboard'))->with('sukses', 'Banner promo berhasil dihapus.');
    }
}
