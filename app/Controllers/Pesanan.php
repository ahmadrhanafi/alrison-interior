<?php

namespace App\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\ModelProduk;
use App\Models\ModelKeranjang;
use App\Models\ModelPesanan;
use App\Models\ModelDetailPesanan;
use App\Models\ModelAuth;

class Pesanan extends BaseController
{
    protected $modelProduk;
    protected $modelKeranjang;
    protected $modelPesanan;
    protected $modelDetailPesanan;
    protected $modelAuth;

    public function __construct()
    {
        $this->modelProduk = new ModelProduk();
        $this->modelKeranjang = new ModelKeranjang();
        $this->modelPesanan = new ModelPesanan();
        $this->modelDetailPesanan = new ModelDetailPesanan();
        $this->modelAuth = new ModelAuth();
        date_default_timezone_set('Asia/Jakarta');

        // Konfigurasi Midtrans
        Config::$serverKey    = getenv('MIDTRANS_SERVER_KEY');
        Config::$isProduction = getenv('MIDTRANS_IS_PRODUCTION') === 'true' ? true : false;
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    public function riwayat()
    {
        if (session()->get('level') <> 2) {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }

        $id_user = session()->get('id_user');

        $pesanan = $this->modelPesanan->getPesananUser($id_user);

        foreach ($pesanan as &$p) {
            $detail = $this->modelDetailPesanan
                ->where('id_pesanan', $p['id_pesanan'])
                ->first();

            $p['nama_produk'] = $detail['nama_produk'] ?? 'Produk tidak ditemukan';
            $p['gambar']      = $detail['gambar'] ?? 'default.jpg';
        }

        $success = $this->request->getGet('success');

        $data = [
            'title'   => 'Riwayat Pesanan - Alrison Interior',
            'pesanan' => $pesanan,
            'success' => $success
        ];

        return view('pesanan/pesanan', $data);
    }

    public function order($slug)
    {
        if (session()->get('level') <> 2) {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }

        $data = [
            'title'     => 'Buat Pesanan - Alrison Interior',
            'produk'    => $this->modelProduk->getProduk($slug),
        ];

        if (empty($data['produk'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk' . $slug . 'tidak ditemukan.');
        }

        return view('pesanan/tambah_pesanan', $data);
    }

    public function fromCart()
    {
        if (session()->get('level') <> 2) {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }

        // Ambil keranjang dari database berdasarkan user login
        $keranjang = $this->modelKeranjang
            ->where('id_user', session()->get('id_user'))
            ->findAll();

        if (!$keranjang) {
            return redirect()->to(base_url('keranjang'))->with('gagal', 'Keranjang kamu masih kosong.');
        }

        $data = [
            'title'     => 'Buat Pesanan dari Keranjang - Alrison Interior',
            'keranjang' => $keranjang,
        ];

        return view('pesanan/tambah_pesanan', $data);
    }

    public function simpan()
    {
        $tipe = $this->request->getPost('tipe_pesanan');

        // Generate kode pesanan unik
        $kodePesanan = 'AR' . date('YmdHis') . strtoupper(substr(md5(rand()), 0, 5));

        // Data umum pesanan
        $dataPesanan = [
            'id_user'           => session()->get('id_user'),
            'kode_pesanan'      => $kodePesanan,
            'nama_pemesan'      => $this->request->getPost('nama_pemesan'),
            'no_hp'             => $this->request->getPost('no_hp'),
            'alamat_pengiriman' => $this->request->getPost('alamat_pengiriman'),
            'status'            => 'Menunggu Pembayaran',
            'created_at'        => date('Y-m-d H:i:s')
        ];

        $totalHarga = 0;
        $detailPesanan = [];

        if ($tipe === 'keranjang') {
            $keranjang = $this->modelKeranjang->getKeranjangByUser(session()->get('id_user'));
            if (!$keranjang) {
                return redirect()->to('keranjang')->with('gagal', 'Keranjang Anda kosong.');
            }

            foreach ($keranjang as $item) {
                $produk = $this->modelProduk->find($item['id_produk']);
                if (!$produk || $produk['stok'] < $item['jumlah']) {
                    return redirect()->to('keranjang')->with('gagal', 'Stok tidak cukup atau produk tidak ditemukan: ' . $item['nama_produk']);
                }

                $subtotal = $item['harga'] * $item['jumlah'];
                $totalHarga += $subtotal;

                $detailPesanan[] = [
                    'id_produk'   => $produk['id_produk'],
                    'nama_produk' => $produk['nama_produk'],
                    'kategori'    => $produk['kategori'],
                    'gambar'      => $produk['gambar'],
                    'jumlah'      => $item['jumlah'],
                    'harga'       => $item['harga'],
                    'total_harga' => $subtotal,
                ];
            }
        } else {
            // Pesanan 1 produk langsung
            $id_produk = $this->request->getPost('id_produk');
            $jumlah    = (int)$this->request->getPost('jumlah') ?? 1;

            $produk = $this->modelProduk->find($id_produk);
            if (!$produk || $produk['stok'] < $jumlah) {
                return redirect()->to('toko')->with('gagal', 'Produk tidak ditemukan atau stok tidak cukup.');
            }

            $subtotal = $produk['harga'] * $jumlah;
            $totalHarga = $subtotal;

            $detailPesanan[] = [
                'id_produk'   => $produk['id_produk'],
                'nama_produk' => $produk['nama_produk'],
                'kategori'    => $produk['kategori'],
                'gambar'      => $produk['gambar'],
                'jumlah'      => $jumlah,
                'harga'       => $produk['harga'],
                'total_harga' => $subtotal,
            ];
        }

        // Simpan pesanan utama
        $dataPesanan['total_harga'] = $totalHarga;
        $this->modelPesanan->save($dataPesanan);
        $id_pesanan = $this->modelPesanan->getInsertID();

        // Simpan detail pesanan
        foreach ($detailPesanan as $item) {
            $this->modelDetailPesanan->save(array_merge($item, [
                'id_pesanan' => $id_pesanan
            ]));

            // Kurangi stok
            $this->modelProduk->update($item['id_produk'], [
                'stok' => $this->modelProduk->find($item['id_produk'])['stok'] - $item['jumlah']
            ]);
        }

        // Hapus keranjang user jika tipe keranjang
        if ($tipe === 'keranjang') {
            $this->modelKeranjang->where('id_user', session()->get('id_user'))->delete();
        }

        return redirect()->to('pesanan/detail-pesanan/' . $id_pesanan);
    }

    public function detail($id_pesanan)
    {
        // Ambil data pesanan
        $pesanan = $this->modelPesanan->find($id_pesanan);

        // Cek apakah pesanan ditemukan
        if (!$pesanan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pesanan tidak ditemukan');
        }

        // Pastikan pesanan milik user yang sedang login
        if (session('id_user') != $pesanan['id_user']) {
            return redirect()->to('/pesanan')->with('gagal', 'Anda tidak memiliki akses ke pesanan ini.');
        }

        // Cek apakah pesanan dibatalkan
        if ($pesanan['status'] === 'Dibatalkan') {
            return redirect()->to('/pesanan')->with('gagal', 'Pesanan ini telah dibatalkan.');
        }

        // Ambil detail produk dalam pesanan
        $detail = $this->modelDetailPesanan->getDetailByPesanan($id_pesanan);

        // Ambil data keranjang user untuk info tambahan (jika perlu)
        $keranjang = $this->modelKeranjang->getKeranjangByUser($pesanan['id_user']);

        // (Opsional) Gabungkan data produk jika perlu detail tambahan per item
        foreach ($detail as &$item) {
            $produk = $this->modelProduk->find($item['id_produk']);
            if ($produk) {
                $item['nama_produk'] = $produk['nama_produk'];
                $item['gambar']      = $produk['gambar'];
                $item['kategori']    = $produk['kategori'];
                $item['harga']       = $produk['harga'];
            }
        }

        return view('pesanan/detail_pesanan', [
            'title'     => 'Detail Pesanan - Alrison Interior',
            'pesanan'   => $pesanan,
            'detail'    => $detail,
            'keranjang' => $keranjang,
        ]);
    }

    public function edit($id_pesanan)
    {
        // Ambil pesanan
        $pesanan = $this->modelPesanan->find($id_pesanan);
        if (!$pesanan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pesanan tidak ditemukan');
        }

        // Ambil detail pesanan (karena id_produk-nya di sini)
        $detailPesanan = $this->modelDetailPesanan->where('id_pesanan', $id_pesanan)->first();
        if (!$detailPesanan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Detail pesanan tidak ditemukan');
        }

        // Ambil produk dari detail pesanan
        $produk = $this->modelProduk->find($detailPesanan['id_produk']);

        $data = [
            'title'         => 'Edit Pesanan - Alrison Interior',
            'pesanan'       => $pesanan,
            'detailPesanan' => $detailPesanan,
            'produk'        => $produk
        ];

        return view('pesanan/edit_pesanan', $data);
    }

    public function update($id_pesanan)
    {
        $data = [
            'nama_pemesan'       => $this->request->getPost('nama_pemesan'),
            'no_hp'              => $this->request->getPost('no_hp'),
            'alamat_pengiriman'  => $this->request->getPost('alamat_pengiriman'),
            'jumlah'             => $this->request->getPost('jumlah'),
        ];

        $this->modelPesanan->update($id_pesanan, $data);

        return redirect()->to(base_url('pesanan'))->with('sukses', 'Pesanan berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $modelPesanan = new ModelPesanan();
        $modelDetailPesanan = new \App\Models\ModelDetailPesanan();
        $modelProduk = new \App\Models\ModelProduk();

        // Cek apakah pesanan ada
        $pesanan = $modelPesanan->find($id);
        if (!$pesanan) {
            return redirect()->back()->with('gagal', 'Pesanan tidak ditemukan.');
        }
        
        // Cek status pesanan
        if (!in_array($pesanan['status'], ['Menunggu Pembayaran', 'Dibatalkan'])) {
            return redirect()->to('/pesanan')->with('gagal', 'Pesanan yang sudah dibayar tidak bisa dihapus.');
        }

        // Ambil detail pesanan
        $detailPesanan = $modelDetailPesanan->where('id_pesanan', $id)->findAll();

        // Balikin stok produk
        foreach ($detailPesanan as $detail) {
            $produk = $modelProduk->find($detail['id_produk']);
            if ($produk) {
                $stokBaru = $produk['stok'] + $detail['jumlah'];
                $modelProduk->update($detail['id_produk'], ['stok' => $stokBaru]);
            }
        }

        // Hapus detail pesanan
        $modelDetailPesanan->where('id_pesanan', $id)->delete();

        // Hapus pesanan
        $modelPesanan->delete($id);

        return redirect()->to(base_url('pesanan'))->with('sukses', 'Pesanan berhasil dihapus.');
    }


    public function updateStatus()
    {
        $id_pesanan = $this->request->getPost('id_pesanan');
        $status     = $this->request->getPost('status');

        // Daftar status yang diperbolehkan
        $allowedStatus = ['Menunggu Pembayaran', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];

        if (!in_array($status, $allowedStatus)) {
            return redirect()->back()->with('gagal', 'Status tidak valid');
        }

        // Update status
        $this->modelPesanan->update($id_pesanan, [
            'status' => $status
        ]);

        return redirect()->to('/pesanan/detail_pesanan' . $id_pesanan)->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function token($id_pesanan)
    {
        // Ambil data pesanan
        $pesanan = $this->modelPesanan->find($id_pesanan);

        if (!$pesanan) {
            // Kalau pesanan tidak ditemukan, kembalikan response error
            return $this->response->setStatusCode(404)->setJSON(['gagal' => 'Pesanan tidak ditemukan']);
        }

        // Ambil detail pesanan
        $detail = $this->modelDetailPesanan->getDetailByPesanan($id_pesanan);

        // Hitung total harga dari detail pesanan
        $total = 0;
        foreach ($detail as $d) {
            $total += $d['harga'] * $d['jumlah'];
        }

        $id_user = session()->get('id_user');
        $user = $this->modelAuth->find($id_user);

        // Data Snap
        $params = [
            'transaction_details' => [
                'order_id' => $pesanan['kode_pesanan'],
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $pesanan['nama_pemesan'],
                'phone'      => $pesanan['no_hp'],
                'email'      => $user['email'],
                'shipping_address' => [
                    'first_name' => $pesanan['nama_pemesan'],
                    'phone'      => $pesanan['no_hp'],
                    'address'    => $pesanan['alamat_pengiriman']
                ],
                'billing_address' => [
                    'first_name' => $pesanan['nama_pemesan'],
                    'phone'      => $pesanan['no_hp'],
                    'address'    => $pesanan['alamat_pengiriman']
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        return $this->response->setJSON(['token' => $snapToken]);
    }
}
