<?php

namespace App\Controllers;

use App\Models\modelKonsumen;
use App\Models\modelAuth;

class Konsumen extends BaseController
{
    protected $modelKonsumen;
    protected $modelAuth;
    public function __construct()
    {
        $this->modelKonsumen = new modelKonsumen();

        $konsumen = new modelKonsumen();
        $data['konsumen'] = $konsumen->findAll();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_konsumen') ? $this->request->getVar('page_konsumen') : 1;
   
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $consumer = $this->modelKonsumen->searchKonsumen($keyword);
        } else {
            $consumer = $this->modelKonsumen;
        }
        // d($this->request->getVar('keyword'));

        $data = [
            'title'             => 'Daftar konsumen - Dashboard',
            'konsumen'          => $consumer->paginate(10, 'konsumen'),
            'pager'       => $this->modelKonsumen->pager,
            'currentPage' => $currentPage,
            'keyword'     => $keyword
        ];

        return view('konsumen/daftar_konsumen', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah konsumen - Daftar konsumen Alrison Interior'
        ];

        return view('konsumen/tambah_konsumen', $data);
    }

    public function simpan()
    {
        $this->modelKonsumen->save([
            'nama_konsumen' => $this->request->getVar('nama_konsumen'),
            'no_hp'         => $this->request->getVar('no_hp'),
            'alamat'        => $this->request->getVar('alamat'),
        ]);

        session()->setFlashdata('pesan', 'Data konsumen berhasil ditambahkan!');
        return redirect()->to(base_url('/konsumen'));
    }

    public function hapus($id_konsumen)
    {
        $this->modelKonsumen->delete($id_konsumen);

        session()->setFlashdata('pesan', 'Data konsumen berhasil dihapus!');
        return redirect()->to(base_url('/konsumen'));
    }

    public function ubah($id_konsumen)
    {
        $konsumen = $this->modelKonsumen->getIdKonsumen($id_konsumen);
        $data = [
            'title' => 'Edit konsumen - Daftar konsumen Alrison Interior',
            'konsumen' => $konsumen
        ];

        return view('konsumen/edit_konsumen', $data);
    }

    public function update()
    {
        $id_konsumen    = $this->request->getVar('id_konsumen');
        $nama_konsumen  = $this->request->getVar('nama_konsumen');
        $no_hp          = $this->request->getVar('no_hp');
        $alamat         = $this->request->getVar('alamat');

        $data = ([
            'id_konsumen'   => $id_konsumen,
            'nama_konsumen' => $nama_konsumen,
            'alamat'        => $alamat,
            'no_hp'         => $no_hp,
        ]);

        $this->modelKonsumen->replace($data);

        session()->setFlashdata('pesan', 'Data konsumen berhasil diperbarui!');
        return redirect()->to(base_url('/konsumen'));
    }
}
