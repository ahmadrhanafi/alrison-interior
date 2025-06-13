<?php

namespace App\Controllers;

use App\Models\ModelPesanan;
use CodeIgniter\RESTful\ResourceController;

class MidtransCallback extends ResourceController
{
    protected $modelPesanan;

    public function __construct()
    {
        $this->modelPesanan = new ModelPesanan();
    }

    public function notification()
    {
        // Baca notif JSON dari Midtrans
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        // Cek kalau ada data order_id
        if (isset($result->order_id)) {
            $kode_pesanan = $result->order_id;
            $transaction_status = $result->transaction_status;

            // Map status dari Midtrans ke status pesanan di sistem
            $status_pesanan = 'Menunggu Pembayaran';

            if ($transaction_status == 'settlement' || $transaction_status == 'capture') {
                $status_pesanan = 'Diproses';
            } elseif ($transaction_status == 'cancel' || $transaction_status == 'deny' || $transaction_status == 'expire') {
                $status_pesanan = 'Dibatalkan';
            }

            // Update status pesanan di database
            $this->modelPesanan->updateStatusByKode($kode_pesanan, $status_pesanan);

            // Kirim response ke Midtrans
            return $this->respond(['message' => 'Callback received. Status updated.'], 200);
        }

        return $this->fail('No order_id provided.', 400);
    }
}
