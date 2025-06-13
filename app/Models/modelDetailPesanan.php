<?php

namespace App\Models;

use CodeIgniter\Model;

class modelDetailPesanan extends Model
{
    protected $table            = 'pesanan_detail';
    protected $primaryKey       = 'id_detail';
    protected $allowedFields    = ['id_pesanan', 'id_produk', 'nama_produk', 'gambar', 'kategori', 'jumlah', 'harga', 'total_harga'];
    protected $useTimestamps    = true;

    // Method untuk mengambil detail pesanan berdasarkan ID pesanan
    public function getDetailByPesanan($id_pesanan)
    {
        return $this->where('id_pesanan', $id_pesanan)->findAll();
    }
}
