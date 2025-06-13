<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GambarProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_gambar'  => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_produk'  => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'gambar'     => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id_gambar', true);
        $this->forge->createTable('gambar_produk');
    }

    public function down()
    {
        $this->forge->dropTable('gambar_produk');
    }
}
