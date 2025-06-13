<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Midtrans extends BaseConfig
{
    public $serverKey    = '';
    public $clientKey    = '';
    public $isProduction = false;

    public function __construct()
    {
        $this->serverKey    = getenv('MIDTRANS_SERVER_KEY');
        $this->clientKey    = getenv('MIDTRANS_CLIENT_KEY');
        $this->isProduction = getenv('MIDTRANS_IS_PRODUCTION') === 'true' ? true : false;
    }
}
