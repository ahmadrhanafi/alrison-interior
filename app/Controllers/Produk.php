<?php

namespace App\Controllers;

use App\Models\ModelProduk;
use App\Models\ModelProdukGambar;

class Produk extends BaseController
{
    protected $modelProduk;
    protected $modelProdukGambar;

    public function __construct()
    {
        $this->modelProduk         = new ModelProduk();
        $this->modelProdukGambar   = new ModelProdukGambar();
    }

    public function index()
    {
        if (session()->get('level') <> 1) {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login.');
            return redirect()->to(base_url('auth/login'));
        }

        $currentPage = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;
        $keyword     = $this->request->getVar('keyword');

        $produkQuery = $this->modelProduk
            ->select('produk.*, GROUP_CONCAT(produk_gambar.gambar) AS gambar_tambahan')
            ->join('produk_gambar', 'produk_gambar.id_produk = produk.id_produk', 'left')
            ->groupBy('produk.id_produk');

        if ($keyword) {
            $produkQuery->like('nama_produk', $keyword)->orLike('kategori', $keyword);
        }

        $produk = $produkQuery->paginate(8, 'produk');

        $data = [
            'title'       => 'Daftar Produk - Alrison Interior',
            'produk'      => $produk,
            'pager'       => $this->modelProduk->pager,
            'currentPage' => $currentPage,
            'keyword'     => $keyword,
        ];

        return view('produk/daftar_produk', $data);
    }

    public function detail($slug)
    {
        $produk = $this->modelProduk->where('slug', $slug)->first();

        if (empty($produk)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk tidak ditemukan.');
        }

        // Gambar tambahan
        $gambarTambahan = $this->modelProdukGambar
            ->where('id_produk', $produk['id_produk'])
            ->findAll();

        // Produk terkait
        $produkTerkait = $this->modelProduk
            ->where('kategori', $produk['kategori'])
            ->where('id_produk !=', $produk['id_produk'])
            ->orderBy('created_at', 'DESC')
            ->findAll(8);

        $data = [
            // 'title'          => 'Detail Produk - Alrison Interior',
            'title'          => $produk['nama_produk'] . ' - Alrison Interior',
            // 'description'    => word_limiter(strip_tags($produk['deskripsi']), 20),
            'image'          => base_url('uploads/' . $produk['gambar']),
            'url'            => current_url(),
            'produk'         => $produk,
            'gambarTambahan' => $gambarTambahan,
            'produkTerkait'  => $produkTerkait
        ];

        return view('produk/detail_produk', $data);
    }

    public function tambah()
    {
        $validation = \Config\Services::validation();
        // $modelKategori = new ModelKategori();
        $data = [
            'title'      => 'Tambah produk - Daftar produk Alrison Interior',
            'validation' => $validation,
            // 'kategori'   => $modelKategori->findAll(),
        ];

        return view('/produk/tambah_produk', $data);
    }

    public function simpan()
    {
        $validationRules = [
            'nama_produk' => [
                'label' => 'Nama produk',
                'rules' => 'required|is_unique[produk.nama_produk]',
                'errors' => [
                    'required' => '{field} harus diberi nama',
                    'is_unique' => '{field} sudah ada, ganti yang lain',
                ]
            ],
            'gambar' => [
                'label' => 'Gambar',
                'rules' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,2048]|is_image[gambar]',
                'errors' => [
                    'uploaded' => 'Gambar wajib diunggah.',
                    'mime_in'  => 'Tipe file tidak diizinkan. Hanya JPG, JPEG, dan PNG.',
                    'max_size' => 'Ukuran file maksimal 2MB.',
                    'is_image' => 'Anda bukan menginput {field}',
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        $gambarFiles = $this->request->getFiles()['gambar'];

        // Validasi rasio gambar
        foreach ($gambarFiles as $gambar) {
            if (!$gambar->isValid()) continue;

            $imageInfo = getimagesize($gambar->getTempName());
            $width = $imageInfo[0];
            $height = $imageInfo[1];

            if ($width != $height) {
                return redirect()->back()->withInput()->with('errors', ['Semua gambar harus memiliki rasio 1:1.']);
            }
        }

        // Ambil gambar utama (gambar pertama)
        $gambarUtama = $gambarFiles[0];
        $namaGambarUtama = $gambarUtama->getRandomName();
        $gambarUtama->move('uploads', $namaGambarUtama);

        // Buat slug dan proses harga
        $slug = url_title($this->request->getVar('nama_produk'), '-', true);
        $harga = str_replace('.', '', $this->request->getVar('harga'));

        // Simpan ke tabel produk
        $this->modelProduk->save([
            'nama_produk' => $this->request->getVar('nama_produk'),
            'kategori'    => $this->request->getVar('kategori'),
            'slug'        => $slug,
            'deskripsi'   => $this->request->getVar('deskripsi'),
            'harga'       => $harga,
            'stok'        => $this->request->getVar('stok'),
            'gambar'      => $namaGambarUtama, // nama random yang sudah dipindah ke folder uploads
        ]);

        // Ambil ID produk terakhir
        $id_produk = $this->modelProduk->getInsertID();

        // Simpan gambar tambahan ke tabel produk_gambar (termasuk gambar utama agar konsisten)
        foreach ($gambarFiles as $index => $gambar) {
            if (!$gambar->isValid()) continue;

            if ($index == 0) {
                // Gambar utama sudah dipindah, tinggal masukkan ke tabel produk_gambar
                $this->modelProdukGambar->save([
                    'id_produk' => $id_produk,
                    'gambar'    => $namaGambarUtama,
                ]);
            } else {
                // Gambar tambahan
                // $files = $this->request->getFileMultiple('gambar');
                // if (count($files) > 5) {
                //     return redirect()->back()->with('error', 'Maksimal upload 5 gambar.');
                // }
                $namaGambar = $gambar->getRandomName();
                $gambar->move('uploads', $namaGambar);

                $this->modelProdukGambar->save([
                    'id_produk' => $id_produk,
                    'gambar'    => $namaGambar,
                ]);
            }
        }

        session()->setFlashdata('pesan', 'Produk berhasil ditambah!');
        return redirect()->to(base_url('/produk'));
    }

    public function hapus($id_produk)
    {

        $this->modelProduk->delete($id_produk);
        session()->setFlashdata('pesan', 'Produk berhasil dihapus!');
        return redirect()->to(base_url('/produk'));
    }

    public function hapus_gambar($id_gambar)
    {
        // Ambil data gambar dari model berdasarkan id gambar tambahan
        $gambar = $this->modelProdukGambar->find($id_gambar);

        if (!$gambar) {
            session()->setFlashdata('error', 'Gambar tidak ditemukan.');
            return redirect()->back();
        }

        // Hapus file gambar fisik jika ada
        $filePath = WRITEPATH . '../uploads/' . $gambar['gambar'];
        if (is_file($filePath)) {
            unlink($filePath);
        }

        // Hapus data gambar dari database
        $this->modelProdukGambar->delete($id_gambar);

        session()->setFlashdata('pesan', 'Gambar tambahan berhasil dihapus.');
        return redirect()->back();
    }

    public function ubah($id_produk)
    {
        $produk = $this->modelProduk->getIdProduk($id_produk);
        $gambar_tambahan = $this->modelProdukGambar
            ->where('id_produk', $id_produk)
            ->findAll();

        $data = [
            'title'           => 'Edit produk - Daftar produk Alrison Interior',
            'produk'          => $produk,
            'gambar_tambahan' => $gambar_tambahan
        ];

        return view('produk/edit_produk', $data);
    }

    public function update()
    {
        $id_produk = $this->request->getVar('id_produk');
        $slug      = url_title($this->request->getVar('nama_produk'), '-', true);

        $nama_produk = $this->request->getVar('nama_produk');
        $kategori    = $this->request->getVar('kategori');
        $deskripsi   = $this->request->getVar('deskripsi');
        $harga       = str_replace('.', '', $this->request->getVar('harga'));
        $stok        = $this->request->getVar('stok');

        // Handle semua_gambar[] input
        $semuaGambar = $this->request->getFiles()['semua_gambar'];
        $gambarUtamaBaru = null;

        if ($semuaGambar && count($semuaGambar) > 0 && $semuaGambar[0]->isValid()) {
            // Gambar utama: file pertama
            $gambarUtamaBaru = $semuaGambar[0]->getRandomName();
            $semuaGambar[0]->move('uploads', $gambarUtamaBaru);

            // Hapus gambar lama jika ada
            $gambarLama = $this->request->getVar('gambar_lama');
            if ($gambarLama && file_exists('uploads/' . $gambarLama)) {
                unlink('uploads/' . $gambarLama);
            }

            // Gambar tambahan: sisanya
            for ($i = 1; $i < count($semuaGambar); $i++) {
                if ($semuaGambar[$i]->isValid()) {
                    $namaGambarTambahan = $semuaGambar[$i]->getRandomName();
                    $semuaGambar[$i]->move('uploads', $namaGambarTambahan);

                    // Simpan ke tabel produk_gambar
                    $this->modelProdukGambar->save([
                        'id_produk' => $id_produk,
                        'gambar'    => $namaGambarTambahan,
                    ]);
                }
            }
        } else {
            // Jika tidak upload baru, pakai gambar lama
            $gambarUtamaBaru = $this->request->getVar('gambar_lama');
        }

        // Update produk utama
        $this->modelProduk->save([
            'id_produk'     => $id_produk,
            'nama_produk'   => $nama_produk,
            'kategori'      => $kategori,
            'deskripsi'     => $deskripsi,
            'slug'          => $slug,
            'harga'         => $harga,
            'stok'          => $stok,
            'gambar'        => $gambarUtamaBaru
        ]);

        session()->setFlashdata('pesan', 'Produk berhasil diperbarui!');
        return redirect()->to(base_url('/produk'));
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');

        $produk = $this->modelProduk->like('nama_produk', $keyword)
            ->orLike('deskripsi', $keyword)
            ->findAll();

        $data = [
            'title' => 'Hasil Pencarian - Alrison Interior',
            'produk' => $produk,
            'keyword' => $keyword
        ];

        return view('produk/hasil_pencarian', $data);
    }
}
