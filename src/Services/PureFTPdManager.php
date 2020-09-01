<?php
namespace Lextira\PureFTPdManager\Services;

use GuzzleHttp\Client;
use Lextira\PureFTPdManager\Models\Account;
use Lextira\PureFTPdManager\Models\Domain;
use Lextira\PureFTPdManager\Models\Health;
use Lextira\PureFTPdManager\Providers\PureFTPdServiceProvider;

class PureFTPdManager {
    protected $client;
    protected $authKey;

    public function __construct()
    {
        $baseURL = config(PureFTPdServiceProvider::CONFIG_PREFIX . '.host');
        $baseURL .= config(PureFTPdServiceProvider::CONFIG_PREFIX . '.api_path');

        $this->client = new Client([
            'base_uri' => $baseURL,
        ]);
        $this->authKey = config(PureFTPdServiceProvider::CONFIG_PREFIX . '.auth_token');
    }

    public function accounts()
    {
        return new Account($this->client, $this->authKey);
    }

    public function domains()
    {
        return new Domain($this->client, $this->authKey);
    }

    public function health()
    {
        return new Health($this->client, $this->authKey);
    }
}