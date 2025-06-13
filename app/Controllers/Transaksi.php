<?php

namespace App\Controllers;

use App\Models\ModelTransaksi;
use App\Models\ModelProduk;
use App\Models\ModelPesanan;

class Transaksi extends BaseController
{
    protected $modelTransaksi;
    protected $modelProduk;
    protected $modelPesanan;
    protected $modelDetailPesanan;

    public function __construct()
    {
        $this->modelTransaksi = new ModelTransaksi();
        $this->modelProduk = new ModelProduk();
        $this->modelPesanan = new ModelPesanan();
        $this->modelDetailPesanan = new \App\Models\ModelDetailPesanan();
        date_default_timezone_set('Asia/Jakarta');

        $transaksi = new ModelTransaksi();
        $data['transaksi'] = $transaksi->findAll();
    }

    public function index()
    {
        if (session()->get('level') <> 1) {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }

        $currentPage = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $trans = $this->modelTransaksi->searchTransaksi($keyword);
        } else {
            $trans = $this->modelTransaksi;
        }
        // d($this->request->getVar('keyword'));

        $data = [
            'title'       => 'Transaksi Manual - Dashboard Alrison Interior',
            'transaksi'   => $trans->paginate(10, 'transaksi'),
            'pager'       => $this->modelTransaksi->pager,
            'currentPage' => $currentPage,
            'keyword'     => $keyword
        ];

        return view('transaksi/transaksi_manual', $data);
    }

    public function transaksiWebsite()
    {
        if (session()->get('level') <> 1) {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }
        
        $currentPage = $this->request->getVar('page_pesanan') ?? 1;
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $pesananQuery = $this->modelPesanan->searchPesanan($keyword);
            $pesananSelesai = $pesananQuery->paginate(10, 'transaksi');
            $pager = $this->modelPesanan->pager;
        } else {
            $pesananSelesai = $this->modelPesanan
                ->where('status', 'Selesai')
                ->orderBy('updated_at', 'DESC')
                ->paginate(8, 'transaksi');
            $pager = $this->modelPesanan->pager;
        }

        $data = [
            'title'               => 'Transaksi dari Website',
            'pesananSelesai'      => $pesananSelesai,
            'modelDetailPesanan'  => $this->modelDetailPesanan,
            'modelProduk'         => $this->modelProduk,
            'pager'               => $pager,
            'currentPage'         => $currentPage,
            'keyword'             => $keyword
        ];

        return view('transaksi/transaksi_website', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah transaksi - Dashboard Alrison Interior'
        ];

        return view('transaksi/tambah_transaksi', $data);
    }

    public function simpan()
    {
        $kodeTransaksi = 'TRX-AR' . date('YmdHis') . strtoupper(substr(md5(uniqid(rand(), true)), 0, 5));
        $harga  = str_replace('.', '', $this->request->getVar('harga'));
        $jumlah = $this->request->getVar('jumlah');
        $total = $harga * $jumlah;

        $this->modelTransaksi->save([
            'kode_transaksi'  => $kodeTransaksi,
            'jenis_transaksi' => $this->request->getVar('jenis_transaksi'),
            'nama'            => $this->request->getVar('nama'),
            'no_hp'           => $this->request->getVar('no_hp'),
            'alamat'          => $this->request->getVar('alamat'),
            'produk'          => $this->request->getVar('produk'),
            'jumlah'          => $jumlah,
            'harga'           => $harga,
            'total'           => $total,
            'status'          => $this->request->getVar('status'),
            'keterangan'      => $this->request->getVar('keterangan'),
        ]);

        session()->setFlashdata('pesan', 'Data transaksi berhasil ditambahkan!');
        return redirect()->to(base_url('/transaksi'));
    }

    public function detail($id_transaksi)
    {
        $transaksi = $this->modelTransaksi->getIdTransaksi($id_transaksi);
        $data = [
            'title'     => 'Detail Transaksi - Dashboard Alrison Interior',
            'transaksi' => $transaksi,
            'detailTransaksi' => $this->modelTransaksi->where('id_transaksi', $id_transaksi)->findAll()
        ];

        return view('transaksi/detail_transaksi', $data);
    }

    public function hapus($id_transaksi)
    {
        $this->modelTransaksi->delete($id_transaksi);

        session()->setFlashdata('pesan', 'Data transaksi berhasil dihapus!');
        return redirect()->to(base_url('/transaksi'));
    }

    public function ubah($id_transaksi)
    {
        $transaksi = $this->modelTransaksi->getIdTransaksi($id_transaksi);
        $data = [
            'title'     => 'Edit transaksi - Dashboard Alrison Interior',
            'transaksi' => $transaksi
        ];

        return view('transaksi/edit_transaksi', $data);
    }

    public function update()
    {
        // $kodeTransaksi   = 'TRX-AR' . date('YmdHis') . strtoupper(substr(md5(uniqid(rand(), true)), 0, 5));
        $id_transaksi    = $this->request->getVar('id_transaksi');
        $nama            = $this->request->getVar('nama');
        $no_hp           = $this->request->getVar('no_hp');
        $alamat          = $this->request->getVar('alamat');
        $produk          = $this->request->getVar('produk');
        $jumlah          = $this->request->getVar('jumlah');
        $harga           = $this->request->getVar('harga');
        $jenis_transaksi = $this->request->getVar('jenis_transaksi');
        $keterangan      = $this->request->getVar('keterangan');
        $status          = $this->request->getVar('status');
        // $created_at      = $this->request->getVar('created_at');

        $transaksiLama = $this->modelTransaksi->find($id_transaksi);

        $this->modelTransaksi->update($id_transaksi, [
            'id_transaksi'    => $id_transaksi,
            // 'kode_transaksi'  => $kodeTransaksi,
            'nama'            => $nama,
            'jenis_transaksi' => $jenis_transaksi,
            'alamat'          => $alamat,
            'no_hp'           => $no_hp,
            'produk'          => $produk,
            'jumlah'          => $jumlah,
            'harga'           => $harga,
            'status'          => $status,
            'keterangan'      => $keterangan,
            'created_at'      => $transaksiLama['created_at']
        ]);

        // $data = ([
        //     'id_transaksi'    => $id_transaksi,
        //     'kode_transaksi'  => $kodeTransaksi,
        //     'nama'            => $nama,
        //     'jenis_transaksi' => $jenis_transaksi,
        //     'alamat'          => $alamat,
        //     'no_hp'           => $no_hp,
        //     'produk'          => $produk,
        //     'jumlah'          => $jumlah,
        //     'harga'           => $harga,
        //     'status'          => $status,
        //     'keterangan'      => $keterangan,
        // ]);

        // $this->modelTransaksi->replace($data);

        session()->setFlashdata('pesan', 'Data transaksi berhasil diperbarui!');
        return redirect()->to(base_url('/transaksi'));
    }
}
