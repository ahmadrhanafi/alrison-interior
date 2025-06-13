<?php

namespace App\Models;

use CodeIgniter\Model;

class modelAuth extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $allowedFields    = [
        'gambar_user',
        'nama_user',
        'username',
        'email',
        'no_hp',
        'alamat',
        'password',
        'level',
        'last_activity',
        'reset_token',
        'reset_token_expired',
        'created_at',
        'updated_at'
    ];
    protected $dateFormat       = 'datetime';
    protected $useTimestamps    = true;

    // protected $beforeInsert = ['hashPassword'];
    // protected $beforeUpdate = ['hashPassword'];

    public function simpan_register($data)
    {
        $this->db->table('users')->insert($data);
    }

    public function login($email, $password)
    {
        $mail = $this->where('email', $email)->first();
        return $this->db->table('users')->where([
            'email'     => $email,
            'password'  => $password,
        ])->get()->getRowArray();
    }

    public function Logout()
    {
        return $this->findAll();
    }

    public function countUserLevel2()
    {
        return $this->where('level', 2)->countAllResults();
    }
}
