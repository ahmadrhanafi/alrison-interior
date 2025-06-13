<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPesanan extends Model
{
    protected $table            = 'pesanan';
    protected $primaryKey       = 'id_pesanan';
    protected $allowedFields    = ['id_user', 'kode_pesanan', 'nama_pemesan', 'no_hp', 'alamat_pengiriman', 'total_harga', 'status'];
    protected $useTimestamps    = true;

    public function getPesananUser($id_user)
    {
        return $this->where('id_user', $id_user)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    public function getPesananDetail($id_pesanan)
    {
        return $this->select('pesanan.*, pesanan_detail.*, produk.nama_produk, produk.gambar, produk.harga')
            ->join('pesanan_detail', 'pesanan_detail.id_pesanan = pesanan.id_pesanan')
            ->join('produk', 'produk.id_produk = pesanan_detail.id_produk')
            ->where('pesanan.id_pesanan', $id_pesanan)
            ->findAll();
    }

    public function getPesananByKode($kode_pesanan)
    {
        return $this->where('kode_pesanan', $kode_pesanan)->first();
    }

    // callback
    public function updateStatusByKode($kode_pesanan, $status)
    {
        return $this->where('kode_pesanan', $kode_pesanan)
            ->set([
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ])
            ->update();
    }

    public function getTotalPesananSelesai()
    {
        return $this->selectSum('total_harga')
            ->where('status', 'Selesai')
            ->get()
            ->getRow()
            ->total_harga;
    }

    public function searchPesanan($keyword)
    {
        $builder = $this->table('pesanan');
        $builder->select("pesanan.*, GROUP_CONCAT(produk.nama_produk SEPARATOR ', ') as nama_produk")
            ->join('pesanan_detail', 'pesanan_detail.id_pesanan = pesanan.id_pesanan', 'left')
            ->join('produk', 'produk.id_produk = pesanan_detail.id_produk', 'left')
            ->groupStart()
            ->like('pesanan.kode_pesanan', $keyword)
            ->orLike('pesanan.nama_pemesan', $keyword)
            ->orLike('pesanan.alamat_pengiriman', $keyword)
            ->orLike('pesanan.no_hp', $keyword)
            ->orLike('produk.nama_produk', $keyword)
            ->groupEnd()
            ->where('pesanan.status', 'Selesai')
            ->groupBy('pesanan.id_pesanan');

        return $builder;
    }
}
