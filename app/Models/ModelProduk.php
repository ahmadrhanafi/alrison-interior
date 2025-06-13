<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProduk extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $allowedFields    = [ 'gambar', 'nama_produk', 'kategori', 'deskripsi', 'slug', 'harga', 'stok', ];
    protected $useTimestamps    = true;
    
    public function getProduk($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    // Relasi ke kategori
    // public function getProdukWithKategori()
    // {
    //     return $this->db->table('produk')
    //                 ->select('produk.*, kategori.nama_kategori')
    //                 ->join('kategori', 'kategori.nama_kategori = produk.nama_kategori')
    //                 ->get()
    //                 ->getResultArray();
    // }

    public function getTotalProduk()
    {
        return $this->countAllResults();
    }

    public function getTotalStok()
    {
        return $this->selectSum('stok')->get()->getRow()->stok;
    }

    public function getIdProduk($id_produk)
    {
        return $this->where(['id_produk' => $id_produk])->first();
    }

    public function getPageProduk()
    {
        return $this->findAll();
    }

    public function searchProduk($keyword)
    {
        $builder = $this->table('produk');
        $builder->like('nama_produk', $keyword);
        $builder->orLike('kategori', $keyword);
        $builder->orLike('harga', $keyword);

        return $builder;
    }
}