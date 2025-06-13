<?php

namespace App\Controllers;

class Statis extends BaseController
{
    public function tentang_kami()
    {
        $data = [
            'title' => 'Tentang Kami - Alrison Interior',
        ];

        return view('tentang/tentang_kami', $data);
    }

    public function penjualan_perusahaan()
    {
        $data = [
            'title' => 'Penjualan Perusahaan - Alrison Interior',
        ];

        return view('tentang/penjualan_perusahaan', $data);
    }

    public function syarat_kebijakan()
    {
        $data = [
            'title' => 'Syarat & Kebijakan - Alrison Interior',
        ];

        return view('tentang/syarat_kebijakan', $data);
    }

    public function komunitas()
    {
        $data = [
            'title' => 'Komunitas - Alrison Interior',
        ];

        return view('tentang/komunitas', $data);
    }

    public function bantuan()
    {
        $data = [
            'title' => 'Bantuan - Alrison Interior',
        ];

        return view('dukungan/bantuan', $data);
    }

    public function dukungan()
    {
        $data = [
            'title' => 'Dukungan - Alrison Interior',
        ];

        return view('dukungan/dukungan', $data);
    }

    public function kebijakan_privasi()
    {
        $data = [
            'title' => 'Kebijakan Privasi - Alrison Interior',
        ];

        return view('dukungan/kebijakan_privasi', $data);
    }

    public function bantuan_dukungan()
    {
        $data = [
            'title' => 'Bantuan & Dukungan - Alrison Interior',
        ];

        return view('dukungan/bantuan_dukungan', $data);
    }

    public function pusat_panggilan()
    {
        $data = [
            'title' => 'Pusat Panggilan - Alrison Interior',
        ];

        return view('kontak/pusat_panggilan', $data);
    }
    
    public function syarat_ketentuan()
    {
        $data = [
            'title' => 'Syarat & Ketentuan - Alrison Interior',
        ];

        return view('kontak/syarat_ketentuan', $data);
    }

    public function pusat_bantuan()
    {
        $data = [
            'title' => 'Pusat Bantuan - Alrison Interior',
        ];

        return view('kontak/pusat_bantuan', $data);
    }
}