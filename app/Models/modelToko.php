<?php

namespace App\Models;

use CodeIgniter\Model;

class modelToko extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $allowedFields    = [ 'gambar', 'nama_produk', 'kategori', 'deskripsi', 'slug', 'harga', 'stok', ];
    protected $useTimestamps    = true;

}