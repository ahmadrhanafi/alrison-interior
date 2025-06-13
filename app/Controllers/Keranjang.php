<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKeranjang;
use App\Models\ModelProduk;

class Keranjang extends BaseController
{
    protected $modelKeranjang;
    protected $modelProduk;

    public function __construct()
    {
        $this->modelKeranjang = new ModelKeranjang();
        $this->modelProduk = new ModelProduk();
    }

    public function index()
    {
        if (session()->get('level') <> 2) {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }

        $id_user = session()->get('id_user');
        $totalItem = $this->modelKeranjang->getTotalKeranjang($id_user);

        $data = [
            'title'      => 'Keranjang Belanja - Alrison  Interior',
            'keranjang'  => $this->modelKeranjang->getKeranjangByUser($id_user),
            'totalItem' => $totalItem,
        ];

        return view('keranjang/keranjang', $data);
    }

    public function tambah($id_produk)
    {
        if (session()->get('level') <> 2) {
            session()->setFlashdata('gagal', 'Maaf, Anda harus login terlebih dahulu untuk menambahkan produk ke keranjang.');
            return redirect()->to(base_url('auth/login'));
        }

        $id_user = session()->get('id_user');
        $produk = $this->modelProduk->find($id_produk);

        // Cek apakah produk sudah ada di keranjang
        $cek = $this->modelKeranjang
            ->where('id_user', $id_user)
            ->where('id_produk', $id_produk)
            ->first();

        if ($cek) {
            // kalau ada, tinggal tambah jumlah & total
            $this->modelKeranjang->update($cek['id_keranjang'], [
                'jumlah' => $cek['jumlah'] + 1,
                'total_harga' => ($cek['jumlah'] + 1) * $cek['harga']
            ]);
        } else {
            // kalau belum ada, insert baru
            $this->modelKeranjang->insert([
                'id_user'     => $id_user,
                'id_produk'   => $produk['id_produk'],
                'nama_produk' => $produk['nama_produk'],
                'harga'       => $produk['harga'],
                'jumlah'      => 1,
                'total_harga' => $produk['harga'],
                'gambar'      => $produk['gambar']
            ]);
        }

        // session()->setFlashdata('sukses', 'Berhasil, produk telah ditambahkan ke keranjang!.');
        return redirect()->back()->with('sukses', 'Produk berhasil ditambahkan ke keranjang.');
        // return  $this->response->setStatusCode(200)->setBody('ok');
    }

    public function hapus($id_keranjang)
    {
        $this->modelKeranjang->delete($id_keranjang);
        return redirect()->to('/keranjang')->with('pesan', 'Item berhasil dihapus.');
    }

    public function kosongkan()
    {
        $id_user = session()->get('id_user');
        $this->modelKeranjang->where('id_user', $id_user)->delete();
        return redirect()->to('/keranjang')->with('pesan', 'Keranjang berhasil dikosongkan.');
    }

    public function order($id_user)
    {
        if (session()->get('level') <> 2) {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }

        $data = [
            'title'     => 'Buat Pesanan - Alrison Interior',
            'produk'    => $this->modelProduk->findAll(),
            'user'      => $this->modelKeranjang->getKeranjangByUser($id_user)
        ];

        return view('pesanan/tambah_pesanan', $data);
    }
}
