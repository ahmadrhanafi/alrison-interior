<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Pengunjung implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if (session()->get('level') == " ") {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login');
            return redirect()->to('auth/login');
        }
        // if (session()->get('level') <> 1) {
        //     session()->setFlashdata('pesan', 'Maaf Anda belum login, silahkan login terlebih dahulu');
        //     return redirect()->to(base_url('login_page'));
        // }
        // if (session()->get('level') <> 2) {
        //     session()->setFlashdata('pesan', 'Maaf Anda belum login, silahkan login terlebih dahulu');
        //     return redirect()->to(base_url('login_page'));
        // }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        if (session()->get('level') == " ") {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login');
            return redirect()->to('auth/login');
        }
    }
    
}