<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class modelKonsumen extends Model
{
    protected $table            = 'konsumen';
    protected $primaryKey       = 'id_konsumen';
    protected $allowedFields    = ['nama_konsumen', 'no_hp', 'alamat', 'created_at'];
    protected $dateFormat       = 'datetime';
    protected $useTimestamps    = true;

    public function getKonsumen($id_konsumen = false)
    {
        // if($id_konsumen == false) {
        //     return $this->findAll();
        // }     
        // return $this->where(['id_konsumen' => $id_konsumen])->first();
        return $this->findAll();
    }

    public function getTotalKonsumen()
    {
        return $this->countAllResults();
    }

    public function getIdKonsumen($id_konsumen)
    {
        return $this->where(['id_konsumen' => $id_konsumen])->first();
    }

    public function getPageKonsumen()
    {
        return $this->findAll();
    }

    public function searchKonsumen($keyword)
    {
        $builder = $this->table('konsumen');
        $builder->like('nama_konsumen', $keyword);
        $builder->orLike('transaksi', $keyword);
        $builder->orLike('no_hp', $keyword);
        $builder->orLike('created_at', $keyword);
        return $builder;

    }
}
