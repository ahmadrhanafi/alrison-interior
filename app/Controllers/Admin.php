<?php

namespace App\Controllers;

use App\Models\ModelProduk;
use App\Models\ModelKonsumen;
use App\Models\ModelPesanan;
use App\Models\ModelDetailPesanan;
use App\Models\ModelAuth;

class Admin extends BaseController
{
    protected $modelProduk;
    protected $modelKonsumen;
    protected $modelPesanan;
    // protected $modelDetailPesanan;
    protected $modelAuth;

    public function __construct()
    {
        $this->modelProduk   = new ModelProduk();
        $this->modelKonsumen = new ModelKonsumen();
        $this->modelPesanan  = new ModelPesanan();
        // $this->modelPesanan  = new ModelDetailPesanan();
        $this->modelAuth     = new ModelAuth();
    }

    public function pesanan()
    {
        if (session()->get('level') <> 1) {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }

        $pesanan = $this->modelPesanan->orderBy('created_at', 'DESC')->findAll();
        // dd($this->modelPesanan->findAll());
        // echo '<pre>';
        // print_r($pesanan);
        // die();

        $currentPage = $this->request->getVar('page_pesanan') ? $this->request->getVar('page_pesanan') : 1;
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $pesanan = $this->modelPesanan->searchPesanan($keyword)
                ->orderBy('created_at', 'DESC')
                ->paginate(8, 'pesanan');
        } else {
            $pesanan = $this->modelPesanan
                ->orderBy('created_at', 'DESC')
                ->paginate(8, 'pesanan');
        }

        $data = [
            'title'        => 'Kelola Pesanan - Dashboard Alrison Interior',
            'pesanan'      => $pesanan,
            'pager'        => $this->modelPesanan->pager,
            'currentPage'  => $currentPage,
            'keyword'      => $keyword
        ];

        return view('admin/kelola_pesanan', $data);
    }

    public function updateStatus($id_pesanan)
    {
        $status = $this->request->getPost('status');

        $this->modelPesanan->update($id_pesanan, ['status' => $status]);

        return redirect()->to(base_url('kelola-pesanan'))->with('sukses', 'Status pesanan berhasil diperbarui.');
    }

    public function detail($id_pesanan)
    {
        if (session()->get('level') <> 1) {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }

        // Load model detail pesanan
        $modelDetailPesanan = new \App\Models\ModelDetailPesanan();

        // Ambil data pesanan utama
        $pesanan = $this->modelPesanan->find($id_pesanan);

        // Kalau pesanan tidak ditemukan, tampilkan error 404
        if (!$pesanan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pesanan tidak ditemukan.');
        }

        // Ambil data detail pesanan (list barang yang dipesan)
        $detailPesanan = $modelDetailPesanan
            ->select('pesanan_detail.*, produk.nama_produk, produk.harga, produk.gambar')
            ->join('produk', 'produk.id_produk = pesanan_detail.id_produk')
            ->where('pesanan_detail.id_pesanan', $id_pesanan)
            ->findAll();

        // Kirim data ke view
        $data = [
            'title'         => 'Detail Pesanan - Dashboard Alrison Interior',
            'pesanan'       => $pesanan,
            'detailPesanan' => $detailPesanan
        ];

        // Tampilkan view-nya
        return view('admin/detail_pesanan', $data);
    }

    public function hapus($id_pesanan)
    {
        // Load model detail pesanan
        $modelDetailPesanan = new \App\Models\ModelDetailPesanan();
        $modelProduk = new \App\Models\ModelProduk();

        // Cek apakah pesanan ada
        $pesanan = $this->modelPesanan->find($id_pesanan);
        if (!$pesanan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pesanan tidak ditemukan.');
        }

        // Ambil semua detail pesanan berdasarkan id_pesanan
        $detailPesanan = $modelDetailPesanan->where('id_pesanan', $id_pesanan)->findAll();

        // Kembalikan stok produk
        foreach ($detailPesanan as $detail) {
            // Ambil data produk-nya
            $produk = $modelProduk->find($detail['id_produk']);

            if ($produk) {
                // Update stok produk dengan menambahkan kembali jumlah yang dipesan
                $modelProduk->update($produk['id_produk'], [
                    'stok' => $produk['stok'] + $detail['jumlah']
                ]);
            }
        }

        // Hapus detail pesanan-nya
        $modelDetailPesanan->where('id_pesanan', $id_pesanan)->delete();

        // Hapus pesanan utamanya
        $this->modelPesanan->delete($id_pesanan);

        // Redirect dengan pesan sukses
        return redirect()->to(base_url('kelola-pesanan'))->with('sukses', 'Pesanan berhasil dihapus dan stok produk dikembalikan.');
    }

    // Konsumen website
    public function dataKonsumen()
    {
        if (session()->get('level') <> 1) {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }
        
        $userModel = new \App\Models\ModelAuth();

        $keyword = $this->request->getGet('keyword');
        if ($keyword) {
            $userModel->like('nama_user', $keyword)
                ->orLike('email', $keyword)
                ->orLike('username', $keyword)
                ->orLike('alamat', $keyword)
                ->orLike('no_hp', $keyword);
        }

        // ambil data konsumen dengan paginate
        $dataKonsumen = $userModel->where('level', 2)->paginate(10, 'konsumen');

        $data = [
            'title'        => 'Daftar Konsumen Website - Dashboard Alrison Interior',
            'konsumen'     => $dataKonsumen,
            'pager'        => $userModel->pager,
            'currentPage'  => $this->request->getVar('page_konsumen') ? $this->request->getVar('page_konsumen') : 1,
            'keyword'      => $keyword,
        ];

        return view('admin/konsumen', $data);
    }
}
