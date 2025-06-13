<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\ModelAuth;

class UpdateActivity implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if ($session->has('id_user')) {
            $userModel = new ModelAuth();
            $userModel->update($session->get('id_user'), [
                'last_activity' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // kosongkan kalau gak dipakai
    }
}
