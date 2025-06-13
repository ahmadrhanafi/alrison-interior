<?php

namespace App\Models;

use CodeIgniter\Model;

class modelTransaksi extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $allowedFields    = ['jenis_transaksi', 'kode_transaksi', 'nama', 'no_hp', 'alamat', 'produk', 'jumlah', 'harga', 'total', 'keterangan', 'status', 'created_at', 'updated_at'];
    protected $dateFormat       = 'datetime';
    protected $useTimestamps    = true;

    public function getIdTransaksi($id_transaksi)
    {
        return $this->where(['id_transaksi' => $id_transaksi])->first();
    }

    public function searchTransaksi($keyword)
    {
        $builder = $this->table('transaksi');
        $builder->like('nama', $keyword);
        $builder->orLike('jenis_transaksi', $keyword);
        $builder->orLike('alamat', $keyword);
        $builder->orLike('status', $keyword);
        $builder->orLike('created_at', $keyword);

        return $builder;
    }

    public function getTotalPengeluaran()
    {
        return $this->selectSum('total')
            ->where('jenis_transaksi', 'Pembelian')
            ->get()
            ->getRow()
            ->total;
    }

    // Ringkasan saldo
    public function getTotalPenjualan()
    {
        return $this->selectSum('total')
            ->where('jenis_transaksi', 'Penjualan')
            ->where('status', 'Selesai')
            ->get()
            ->getRow()
            ->total;
    }

    public function getTotalPembelian()
    {
        return $this->selectSum('total')
            ->where('jenis_transaksi', 'Pembelian')
            ->get()
            ->getRow()
            ->total;
    }
}
