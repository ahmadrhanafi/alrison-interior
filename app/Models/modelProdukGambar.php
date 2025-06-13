<?php

namespace App\Models;
use CodeIgniter\Model;

class ModelProdukGambar extends Model
{
    protected $table = 'produk_gambar';
    protected $primaryKey = 'id_gambar';
    protected $allowedFields = ['id_produk', 'gambar'];
}
