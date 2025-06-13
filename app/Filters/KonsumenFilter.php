<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class KonsumenFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if (session()->get('level') == " ") {
            session()->setFlashdata('gagal', 'Maaf, Anda belum login');
            return redirect()->to('auth/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        if (session()->get('level') == 2) {
            $model = new \App\Models\ModelAuth();
            $model->update(session()->get('id_user'), [
                'last_activity' => date('Y-m-d H:i:s')
            ]);

            return redirect()->to(base_url('toko'));
        }
    }
}
