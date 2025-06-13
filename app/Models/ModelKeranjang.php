<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKeranjang extends Model
{
    protected $table            = 'keranjang';
    protected $primaryKey       = 'id_keranjang';
    protected $allowedFields    = [
        'id_user', 'id_produk', 'nama_produk', 'harga', 'jumlah', 'total_harga', 'gambar', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;

    public function getKeranjangByUser($id_user)
    {
        return $this->db->table('keranjang')
        ->select('keranjang.*, produk.nama_produk, produk.gambar, produk.kategori, produk.harga')
        ->join('produk', 'produk.id_produk = keranjang. id_produk')
        ->where('keranjang.id_user', $id_user)
        ->get()->getResultArray();
    }

    public function getTotalKeranjang($id_user)
    {
        return $this->db->table('keranjang')
        ->selectSum('jumlah', 'total_item')
        ->where('id_user', $id_user)
        ->get()->getRow()->total_item ?? 0;
    }
}
